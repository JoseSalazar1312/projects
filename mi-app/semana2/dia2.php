<?php
declare(strict_types = 1);

// --- MATCH ---
//Como se hace un switch tradicional
$estado = "activo";

switch ($estado){
    case "activo":
        $mensaje = "Usuario activo";
        break;
    case "inactivo":
        $mensaje = "Usuario inactivo";
        break;
    default:
        $mensaje = "Estado desconocido";
}

// Match moderno
$mensaje = match($estado){
    "activo" => "Usuario activo",
    "inactivo" => "Usuario inactivo",
    default => "Estado desconocido"
};

//echo $mensaje . "<br>";

// Match con multiples condiciones por caso
$codigo = 202;
$descripcion = match($codigo){
    200,201 => "Exito",
    400 => "Solicitud Incorrecta",
    401,403 => "Sin autorizacion",
    404 => "No encontrado",
    500 => "Error del servidor",
    default => "Codigo desconocido"
};

//echo "HTTP {$codigo}: {$descripcion}" . "<br>";

// NULLSAFE OPERATOR

class Direccion {
    public string $ciudad;
    public string $pais;

    public function __construct(string $ciudad, string $pais){
        $this->ciudad = $ciudad;
        $this->pais = $pais;
    }
}

class Usuario {
    public string $nombre;
    public ?Direccion $direccion;

    public function __construct(string $nombre, ?Direccion $direccion = null){
        $this->nombre = $nombre;
        $this->direccion = $direccion;
    }

    public function getDireccion(): ?Direccion{
        return $this->direccion;
    }
}

$usuarioConDireccion = new Usuario("Carlos", new Direccion("CDMX" , "México"));
$usuarioSinDireccion = new Usuario("Ana");

if ($usuarioSinDireccion->getDireccion() !== null){
    //echo $usuarioSinDireccion->getDireccion()->ciudad . "<br>";
} else{
    //echo "Sin ciudad" . "<br>";
}

// ✅ Con nullsafe — limpio y seguro
//echo ($usuarioConDireccion->getDireccion()?->ciudad ?? "Sin ciudad") . "<br>";
//echo ($usuarioSinDireccion->getDireccion()?->ciudad ?? "Sin ciudad") . PHP_EOL;

//RETO

class Orden{
    public ?Usuario $usuario;
    public function __construct(?Usuario $usuario){
        $this->usuario = $usuario;
    }
}

class Tienda{
    public ?Orden $ordenActiva;
    public function __construct(?Orden $ordenActiva){
        $this->ordenActiva = $ordenActiva;
    }
}

$tienda1 = new Tienda(new Orden(new Usuario("Jose", new Direccion("CDMX", "Mexico"))));
$tienda2 = new Tienda(new Orden(new Usuario("Ana")));
$tienda3 = new Tienda(null);

$ciudad = $tienda1->ordenActiva?->usuario?->getDireccion()?->ciudad ?? "Sin ciudad";
echo $ciudad . "<br>"; 

$ciudad = $tienda2->ordenActiva?->usuario?->getDireccion()?->ciudad ?? "Sin ciudad";
echo $ciudad . "<br>"; 

$orden = $tienda3->ordenActiva?->usuario?->getDireccion()?->ciudad ?? "Sin orden Activa";
echo $orden . "<br>";


