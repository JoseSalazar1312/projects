<?php
declare(strict_types=1);

//Clase tradicional - mucho codigo repetitivo
class ProductoViejo {
    private string $nombre;
    private float $precio;
    private string $sku;

    public function __construct(string $nombre, float $precio, string $sku){
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->sku = $sku;
    }

    public function getNombre(): string{return $this->nombre; }
    public function getPrecio(): float {return $this->precio;}
    public function getSku(): string {return $this->sku;}
}

//Con constructor promotion - exactamente igual con menos lineas
class Producto{
    public function __construct(
        private string $nombre,
        private float $precio,
        private string $sku
    ){}

    public function getNombre(): string {return $this->nombre;}
    public function getPrecio(): float {return $this->precio;}
    public function getSku(): string {return $this->sku;}
}

// Con readonly - inmutable después de crearse
class Coordenada{
    public function __construct(
        public readonly float $latitud,
        public readonly float $longitug
    ){}

    public function distanciaA(Coordenada $otra): float{
        return sqrt(
            pow($this->latitud - $otra->latitud, 2) + 
            pow($this->longitud - $otra->longitud, 2)
        );
    }
}

$producto = new Producto("Laptop", 999, "LAP-001");
echo $producto->getNombre() . " | $" . $producto->getPrecio() . "<br>";

$cdmx = new Coordenada(19.4326, -99.1332);
$guadalajara = new Coordenada(20.6597, -103.3496);
echo "Distancia: " . round($cdmx->distanciaA($guadalajara), 4) . "<br>";

// Esto lanzara un error - readonly no permite modificacion
try{
    $cdmx->latitud = 0.0;
}catch (Error $e){
    echo "Error: " . $e->getMessage() . "<br>";
}

//Reto exta: Crear una clase ConfiguracionApp usando promotion 
enum Entorno{
    case Local;
    case Staging;
    case Produccion;
}

class ConfiguracionApp{
    public function __construct(
        public readonly string $appNombre,
        public readonly string $version,
        public readonly Entorno $entorno,
        public readonly bool $debug
    ){}

    public function esProduccion(): bool{
        //Primera solucion usando if

        // if($this->entorno === Enorno::Produccion){
        //     return true;
        // }else {
        //     return false;
        // }

        //Segunda solucion optimizada
        return  $this->entorno === Entorno::Produccion;
    }

    public function toString():string{
        return "Nombre de la app: {$this->appNombre}" . "<br>" .
        "Version: {$this->version}" . "<br>" .
        "Fase: {$this->entorno->name}" . "<br>";
    }
}

$config = new ConfiguracionApp("AppTest", "1.0.1", Entorno::Produccion, true);
var_dump($config->esProduccion());
echo $config->toString();