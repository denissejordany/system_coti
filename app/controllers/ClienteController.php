<?php
class ClienteController {

    public function cotizacion()
    {
        // Redirige al controlador correcto
        header("Location: /SYSTEM_COTI/public/cotizacion/realizar");
        exit;
    }

}
?>