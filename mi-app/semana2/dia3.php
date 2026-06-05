<?php
declare(strict_types=1);

//Enum puro sin valor asociado
enum DiaSemana{
    case Lunes;
    case Martes;
    case Miercoles;
    case Jueves;
    case Viernes;
    case Sabado;
    case Domingo;

    public function esFinDeSemana(): bool{
        return match($this){
            DiaSemana::Sabado, DiaSemana::Domingo => true,
            default => false
        };
    }
}

// Enum backed - con valor string asociado
enum EstadoPedido: string {
    case Pendiente= "pendiente";
    case Procesando= "procesando";
    case Enviado= "enviando";
    case Entregado= "entregado";
    case Cancelado= "cancelado";

    public function etiqueta(): string{
        return match($this){
            EstadoPedido:: Pendiente => "⌛ Pendiente",
            EstadoPedido:: Procesando => "⚙️ Procesando",
            EstadoPedido:: Enviado => "📦 Enviado",
            EstadoPedido:: Entregado => "✅ Entregado",
            EstadoPedido:: Cancelado => "❌ Cancelado"
        };
    }

    public function puedeSerCancelado(): bool {
        return match($this){
            EstadoPedido::Pendiente, EstadoPedido::Procesando => true,
            default => false
        };
    }
}

// Uso
$dia = DiaSemana::Sabado;
echo $dia->name . " ¿Es fin de semana? " . ($dia->esFinDeSemana() ? "Imon" : "Pipipi") . "<br>";

$estado = EstadoPedido::Procesando;
echo "Estado: " . $estado->etiqueta() . "<br>";
echo "¿Puede cancelarse? " . ($estado->puedeSerCancelado() ? "Si" : "No") . "<br>";

// Obtener enum desde su valor string
$desdeString = EstadoPedido::from("enviando");
echo "Desde string: " . $desdeString->etiqueta() . "<br>";

// tryFom - no lanza error si no existe
$invalido = EstadoPedido::tryFrom("inexistente");
echo ($invalido?->etiqueta() ?? "Estado Invalido") . "<br>";

// Reto : Crear un enum backend llamado rol con valor string
enum Rol: string {
    case Admin = "admin";
    case Editor = "editor";
    case Viewer = "viewer";

    public function permisos(): array{
        return match($this){
            Rol::Admin => ["crear", "editar" ,"eliminar" ,"ver"],
            Rol::Editor => ["crear" , "editar" , "ver"],
            Rol::Viewer => ["ver"]
        };
    }
}

class Usuario{
    public string $nombre;
    public Rol $rol;
    
    public function __construct(string $nombre, Rol $rol){
        $this->nombre = $nombre;
        $this->rol = $rol;
    }

    public function tienePermiso(string $permiso):bool{
       return in_array($permiso, $this->rol->permisos());
    }
}

$usuario = new Usuario("Jose", Rol::Editor);
echo $usuario->tienePermiso("eliminar") ? "Sí" : "No" . "<br>";  
echo $usuario->tienePermiso("editar")   ? "Sí" : "No"; 
