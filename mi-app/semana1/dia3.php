<?php
declare(strict_types=1);

class Vehiculo {
    protected string $marca;
    protected string $modelo;
    protected int $year;

    public function __construct(string $marca, string $modelo, int $year){
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->year = $year;
    }

    public function describir(): string{
        return "{$this->year} {$this->marca} {$this->modelo}";
    }

    public function tipoDeVehiculo(): string{
        return "Vehiculo generico";
    }
}

class Auto extends Vehiculo{
    private int $numeroDePuertas;

    //Se colocan de nuevo los atributos por que son necesarios para construir el objeto
    public function __construct(string $marca, string $modelo, int $year, int $puertas){
        //Se coloca parent por que pasa los atributos a la clase padre
        parent::__construct($marca, $modelo, $year);
        $this->numeroDePuertas = $puertas;
    }

    public function tipoDeVehiculo(): string{
        return "Automovil de {$this->numeroDePuertas} puertas";
    }
}

class Moto extends Vehiculo{
    private string $estilo;

    public function __construct(string $marca, string $modelo, int $year, string $estilo){
        parent:: __construct($marca, $modelo, $year);
        $this->estilo = $estilo;
    }

    public function tipoDeVehiculo(): string{
        return "Motocicleta estilo {$this->estilo}";
    }
}

class Camion extends Vehiculo{
    private int $capacidadToneladas;

    public function __construct(string $marca, string $modelo, int $year, int $capacidadToneladas){
        parent:: __construct($marca, $modelo, $year);
        $this->capacidadToneladas = $capacidadToneladas;
    }

    public function tipoDeVehiculo(): string{
        if($this->capacidadToneladas <= 10){
            return "Vehiculo ligero";
        }elseif($this->capacidadToneladas <= 20){
            return "Vehiculo Mediano";
        }elseif ($this->capacidadToneladas <= 30){
            return "Vehiculo Pesado";
        }
        return "vehiculo extra pesado";
    }
}

$auto = new Auto("Toyota", "Corolla", 2022, 4);
$moto = new Moto("Honda","CBR",2023,"Deportiva");
$camion = new Camion("Mercedes", "AMG" , 2023, 50);
echo $auto->describir() . " - " . $auto->tipoDeVehiculo() . "<br>";
echo $moto->describir() . " - " . $moto->tipoDeVehiculo() . "<br>";
echo $camion->describir() . " - " . $camion->tipoDeVehiculo() . "<br>";
echo "A partir de aqui comienza reto foreach" . "<br>";

$vehiculos = [$auto, $moto, $camion];
foreach ($vehiculos as $v){
    echo $v->describir() . " - " .  $v->tipoDeVehiculo() . "<br>";
}