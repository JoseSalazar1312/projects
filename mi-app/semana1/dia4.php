<?php
declare(strict_types=1);

//Se interpretan interfaces como contratos los cuales definen que metodos necesita la clase que los implementa aunque estos no definen la logica

interface Pagable{
    public function calcularTotal():float;
    public function generarRecibo():String;
    
}

interface Cancelable{
    public function cancelar(): string;
}

interface Notificable{
    public function enviarNotificacion(): string;
}


class NotificacionEmail implements Notificable{
    private string $destinatario;

    public function __construct(string $destinatario){
        $this->destinatario = $destinatario;
    }

    public function enviarNotificacion(): string{
        return "Notificacion enviada por email a: {$this->destinatario}";
    }
}

class NotificacionSMS implements Notificable{
    private string $numero;

    public function __construct(string $numero){
        $this->numero = $numero;
    }

    public function enviarNotificacion() : string{
        if(strlen($this->numero) < 10 ){
            throw new InvalidArgumentException("el numero debe 10 digitos");
        }
        return "SMS enviado al numero {$this->numero}";
    }
}


class Pedido implements Pagable, Cancelable{
    private string $producto;
    private int $cantidad;
    private float $precioUnitario;
    private bool $cancelado = false;

    public function __construct(string $producto, int $cantidad, float $precioUnitario){
        $this->producto=$producto;
        $this->cantidad=$cantidad;
        $this->precioUnitario=$precioUnitario;
    }

    public function calcularTotal(): float{
        return $this->cantidad * $this->precioUnitario;
    }

    public function generarRecibo(): string{
        return "Pedido: {$this->producto} x{$this->cantidad} = $" . $this->calcularTotal();
    }

    public function cancelar(): string{
        if ($this->cancelado){
            return "El pedido ya esta cancelado.";
        }
        $this->cancelado = true;
        return "Pedido de {$this->producto} cancelado.";
    }
}

$pedido = new Pedido("Laptop", 2, 850.00);
echo $pedido->generarRecibo() . "<br>";
echo "Total: $" . $pedido->calcularTotal() . "<br>";
echo $pedido->cancelar() . "<br>";

$notificacionEmail = new NotificacionEmail("js13122002@gmail.com");
$notificacionSMS = new NotificacionSMS("2211959110");

$notificaciones = [$notificacionEmail, $notificacionSMS];

foreach ($notificaciones as $n){
    echo $n->enviarNotificacion() . "<br>";
}