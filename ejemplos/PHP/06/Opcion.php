<?php
class Opcion {
    private $titulo;
    private $enlace;
    private $colorFondo;

    public function __construct($title, $link, $bcolor) {
        $this->titulo = $title;
        $this->enlace = $link;
        $this->colorFondo = $bcolor;
    }

    public function graficar() {
        echo "<a href='$this->enlace' style='background-color: $this->colorFondo; padding: 10px; color: white; text-decoration: none;'>$this->titulo</a>";
    }
}
?>
