<?php
declare (strict_types=1);

//Creamos clase abstracta
abstract class Empleado{
    protected string $nombre;
    protected float $salarioBase;

    public function __construct(string $nombre, float $salarioBase){
        $this->nombre = $nombre;
        $this->salarioBase = $salarioBase;
    }
    //Metodo abstracto- cada tipo de empleado se calcula diferente
    abstract public function calcularSalario(): float;
    //La funcion no contiene logica 

    //Metodo concreto -  compartido por todos
    public function getNombre(): string{
        return $this->nombre;
    }

    //Metodo concreto con logica compartida
    public function generarReporte(): string {
        return "Empleado: {$this->nombre} | Salario final: $" . $this->calcularSalario();
    }
}

class EmpleadoFijo extends Empleado{
    private float $bonoMensual;

    public function __construct(string $nombre, float $salarioBase, float $bonoMensual){
        parent::__construct($nombre, $salarioBase);
        $this->bonoMensual = $bonoMensual;
    }

    public function  calcularSalario(): float{
        return $this->salarioBase + $this->bonoMensual;
    }
}


class EmpleadoPorHoras extends Empleado {
    private int $horasTrabajadas;
    private float $precioPorHora;

    public function __construct(string $nombre, float $salarioBase, int $horas, float $precioPorHora){
        parent::__construct($nombre, $salarioBase);
        $this->horasTrabajadas = $horas;
        $this->precioPorHora = $precioPorHora;
    }

    public function calcularSalario(): float{
        return $this->salarioBase + ($this->horasTrabajadas * $this->precioPorHora);
    }
}


//Reto: Agrega una clase EmpleadoComisiones que extiende Empleado

class EmpleadoComisiones extends Empleado{
    private int $ventasRealizadas;
    private int $porcentajeComision;

    public function __construct (string $nombre, int $salarioBase, int $ventasRealizadas, int $porcentajeComision){
        parent::__construct($nombre,$salarioBase);
        $this->ventasRealizadas = $ventasRealizadas;
        $this->porcentajeComision = $porcentajeComision;
    }

    public function calcularSalario(): float{
        return $this->salarioBase + ($this->ventasRealizadas * $this->porcentajeComision / 100);
    }

}


$empleados = [
    new EmpleadoFijo("Carlos",2000,500),
    new EmpleadoPorHoras("Ana",1000,15,15),
    new EmpleadoComisiones("Jose",1000,2,10),
];

foreach ($empleados as $empleado){
    echo $empleado->generarReporte() . "<br>";
}