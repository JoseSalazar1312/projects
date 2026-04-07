<?php
declare(strict_types=1);

class CuentaBancaria{
    private string $titular;
    private float $saldo;
    private array $movimientos = [];

    public function __construct(string $titular, float $saldoInicial){
        $this->titular = $titular;
        $this->saldo = $saldoInicial;
    }

    public function getTitular(): string{
        return $this->titular;
    }

    public function getSaldo(): float {
        return $this->saldo;
    }

    public function depositar(float $monto): void{
        if ($monto <= 0){
            throw new InvalidArgumentException("El monto debe ser mayor a 0.");
        }

        $this->saldo += $monto;
        $this->movimientos[] = "+{$monto}";
    }

    public function retirar(float $monto): void{
        if ($monto <= 0){
            throw new InvalidArgumentException("El monto debe ser mayor a 0.");
        }
        if ($monto > $this->saldo){
            throw new InvalidArgumentException("Saldo Insuficiente.");
        }
        
        $this->saldo -= $monto;
        $this->movimientos[] = "-{$monto}";
    }

    public function getMovimientos() : array {
        return $this->movimientos;
    }

    public function setTitular(string $newTitular): void{
        if (strlen($newTitular) <= 3){
            throw new InvalidArgumentException("El nuevo nombre debe contener mas de 3 caracteres");
        }
        $this->titular = $newTitular;
        
    }
}

$cuenta = new CuentaBancaria("Jose", 1000.00);
$cuenta->depositar(500.00);
$cuenta->retirar(200.00);
$cuenta->setTitular("Adriana");

echo "Titular: " . $cuenta->getTitular() . "<br>";
echo "Saldo: " . $cuenta->getSaldo() . "<br>";
echo "Movimientos: " . implode(", ", $cuenta->getMovimientos()) . "<br>";
echo "El nuevo titular es: " . $cuenta->getTitular();