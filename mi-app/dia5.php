<?php
declare(strict_types=1);

trait Timestampable{
    private string $creadoEn;
    private string $actualizadoEn;

    public function setCreadoEn(): void{
        $this->creadoEn = date('Y-m-d H:i:s');
    }

    public function setActualizadoEn(): void{
        $this->actualizadoEn = date('Y-m-d H:i:s');
    }

    public function getCreadoEn(): string{
        return $this->creadoEn ?? 'No definido';
    }

    public function getActualizadoEn() : string{
        return $this->actualizadoEn ?? 'No definido';
    }
}

trait Auditable{
    private array $cambios = [];

    public function registrarCambio(string $campo, string $valorAnterior, string $valorNuevo): void{
        $this->cambios[]= "Campo '{$campo}': '{$valorAnterior}' -> '{$valorNuevo}' ";
    }

    public function getCambios(): array {
        return $this->cambios;
    }

}

//Trait generado por mi:
trait Sluggable {
    public function generarSlug(): string {
        return str_replace(' ', '-', strtolower($this->nombre ." " . __CLASS__ . " " .date('Y', strtotime($this->getCreadoEn()))));
    }
}

trait Formateable{

    public function formatearNombre(): void{
        $this->nombre =  ucwords($this->nombre);
        
    }

}

class Producto {
    use Timestampable, Auditable, Sluggable, Formateable;

    private string $nombre;
    private float $precio;

    public function __construct(string $nombre, float $precio){
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->setCreadoEn();
        $this->formatearNombre();
    }

    public function actualizarPrecio(float $nuevoPrecio): void {
        $this->registrarCambio('precio', (string)$this->precio, (string)$nuevoPrecio);
        $this->precio = $nuevoPrecio;
        $this->setActualizadoEn();
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getPrecio(): float{
        return $this->precio;
    }

}

$producto = new Producto("Homelo Chino",2000.00);
$producto->actualizarPrecio(3000.00);
$producto->actualizarPrecio(1000.00);
//$producto->generateUrl();

echo "Producto: " . $producto->getNombre() . "<br>" ;
echo "Precio Actual: $" . $producto->getPrecio() . "<br>";
echo "Creado en: " . $producto->getCreadoEn() . "<br>";
echo "Actualizado en: " . $producto->getActualizadoEn() . "<br>";
echo "URL:" . $producto->generarSlug() . "<br>";
echo "Historial de cambios: " . "<br>";
foreach ($producto->getCambios() as $cambio){
    echo " - {$cambio} " . "<br>";
}

//echo "Nombre Formateado:" . $producto->formatearNombre();