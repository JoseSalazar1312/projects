<?php

declare(strict_types=1);

interface Alimentable
{
    public function alimentar(string $comida): string;
}

interface Entrenable
{
    public function entrenar(string $habilidad): string;
}

trait Registrable
{
    protected string $fechaIngreso;

    public function registrarIngreso(): void
    {
        $this->fechaIngreso = date('Y-m-d H:i:s');
    }

    public function getFechaIngreso(): string
    {
        return "Ingreso: " . $this->fechaIngreso;
    }
}

trait Historial
{
    private array $historial = [];

    public function agregarRegistro(string $evento): void
    {
        $this->historial[] =  $evento;
    }

    public function getHistorial(): array
    {
        return $this->historial;
    }
}

//Clase abstracta
abstract class Animal
{

    protected string $nombre;
    protected int $edad;
    protected string $especie;

    public function __construct(string $nombre, int $edad, string $especie)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->especie = $especie;
    }

    abstract public function hacerSonido(): string;

    public function describir(): string
    {
        return "{$this->especie} | {$this->nombre} | {$this->edad} años <br>";
    }
}

class Leon extends Animal implements Alimentable
{
    use Registrable, Historial;

    protected string $evento;

    public function __construct(string $nombre, int $edad, string $especie)
    {
        parent::__construct($nombre, $edad, $especie);
        $this->registrarIngreso();
    }

    public function hacerSonido(): string
    {
        return "RAWR";
    }

    public function alimentar(string $comida): string
    {
        $this->evento =  "Alimentado con: " . $comida;
        $this->agregarRegistro($this->evento);
        return $comida;
    }
}

class Delfin extends Animal implements Alimentable, Entrenable
{
    use Registrable, Historial;
    private string $evento;

    public function __construct(string $nombre, int $edad, string $especie)
    {
        parent::__construct($nombre, $edad, $especie);
        $this->registrarIngreso();
    }

    public function hacerSonido(): string
    {
        return "Silvido";
    }

    public function alimentar(string $comida): string
    {
        $this->evento = "Alimentado con: " . $comida;
        $this->agregarRegistro($this->evento);
        return $comida;
    }

    public function entrenar(string $habilidad): string
    {
        $this->evento = "Entrenado en: " . $habilidad;
        $this->agregarRegistro($this->evento);
        return $habilidad;
    }
}

class Aguila extends Animal implements Entrenable
{
    use Registrable, Historial;
    private string $evento;

    public function __construct(string $nombre, int $edad, string $especie)
    {
        parent::__construct($nombre, $edad, $especie);
        $this->registrarIngreso();
    }

    public function hacerSonido(): string
    {
        return "silvido";
    }

    public function entrenar(string $habilidad): string
    {
        $this->evento = "Entrenado en: " . $habilidad;
        $this->agregarRegistro($this->evento);
        return $habilidad;
    }


}


$leon = new Leon("Ngon", 12, "Panthera Leo");
$delfin = new Delfin("Espiraculo", 2, "Tursiops Truncatus");
$aguila = new Aguila("Claudio", 4, "Aquila chrysaetos");

$leon->alimentar("Carne de vaca");
$leon->alimentar("Carne de Pescado");
$delfin->alimentar("comida1");
$delfin->alimentar("comida2");
$delfin->entrenar("Salto");
$delfin->entrenar("griro");
$aguila->entrenar("Pararse Sobre Mano");
$aguila->entrenar("Vuelo en Picada");


$animal = [$leon,$delfin,$aguila];
echo "===== Reporte Zoologico =====" . "<br>";
foreach($animal as $an){
    echo "<br>";
    echo $an->describir();
    echo "Ingreso: " . $an->getFechaIngreso() . "<br>";
    foreach($an->getHistorial() as $a){
        echo "-{$a} <br>";
    }
}














