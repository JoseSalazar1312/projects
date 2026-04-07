<?php
declare(strict_types=1);

// Union types y nulleable types
function dividir(int|float $a, int|float $b): int|float{
    if ($b === 0){
        throw new InvalidArgumentException("No se puede dividir entre cero.");
    }
    return $a / $b;
}


function buscarUsuario(int $id): ?string{
    $usuarios=[
        1 => "Carlos",
        2 => "Ana",
        3 => "Jose"
    ];
    return $usuarios[$id] ?? null;
}

//Typed properties en clase
class producto{
    public int $id;
    public string $nombre;
    public float $precio;
    public ?string $descripcion;


    public function __construct(int $id, string $nombre, float $precio, ?string $descripcion = null){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
    }

    public function getInfo(): string{
        $desc = $this->descripcion ?? "Sin descripcion";
        return "{$this->id} | {$this->nombre} | \${$this->precio} | {$desc}";
    }
}

//Pruebas
echo dividir(10,3) . "<br>";
echo dividir(10.2, 2) . "<br>";

$usuario = buscarUsuario(1);
echo ($usuario ?? "Usuario no encontrado") . "<br>";

$usuario = buscarUsuario(99);
echo ($usuairo ?? "Usuario no encontrado") . "<br>";

$p1 = new Producto(1,"Laptop", 999.99) ;
$p2 = new Producto(2,"Mouse", 29.99,"Inalambrico RGB");

echo $p1->getInfo() . "<br>";
echo $p2->getInfo();
