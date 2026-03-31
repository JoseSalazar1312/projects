<?php
declare(strict_types= 1);

//Clase: Molde para crear objetos
class Persona{
    //atributos o propiedades
    public string $nombre;
    public int $edad;
    public string $email;
    
    //consturctor es un metodo que se ejecuta al crear un objetos
    public function __construct(string $nombre, int $edad, string $email) {
    $this->nombre = $nombre;
    $this->edad = $edad;
    $this->email = $email;
    }

    public function saludar(): string{
        return "Hola, me llamo {$this->nombre} y tengo {$this->edad}.";
    }

    public function esMayorDeEdad(): bool{
        return $this->edad >= 18;
    }

    public function presentarse(): string{
        return "Hola, soy {$this->nombre} y tengo {$this->edad} mi correo es {$this->email}";
    }
}


//Crear objetos
$persona1 = new Persona("Carlos", 13, "carlos@gmail.com");
$persona2 = new Persona("Karla", 15,"Karla@gmail.com");
$persona3 = new Persona("Adriana",23,"Adri@gmail.com");

echo $persona1->presentarse() . "<br>";
echo $persona2->saludar() . "<br>";
echo $persona3->presentarse() . "<br>";

echo $persona1->nombre . " Es mayor de edad. ";
echo $persona1->esMayorDeEdad() ? "Si" : "No " . "<br>";
echo $persona3->nombre . " Es mayor de edad. ";
echo $persona3->esMayorDeEdad() ? "Si" : "No";
echo "<br>";