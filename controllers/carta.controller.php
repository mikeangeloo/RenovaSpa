<?php

/**
 * Class CartaController
 * Su objetivo es controlar las peticiones del usuario, enviar y recibir parametros al modelo: ClaCarta.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */

class CartaController extends Controller
{
    /**
     * Contructor del controlador 
     * @param array $data [recibe el path de la ruta de la vista]
     */
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new ClaCarta();
    }
    /**
     * Método para que solicita el listado de parametros de la vista
     * @return [arreglo] [Arreglo con listado de parametros]
     * Crea nuevos objetos para invocar los métodos de los modelos correspondientes
     */
    public function admin_index()
    {

        $objClientes = new ClaClientes();
        $objTratamientos = new ClaTratamientos();
        $objTerapeuta = new ClaTerapeutas();
        $objOpinion = new ClaOpiniones();
        if($_GET){
            $id=$_GET['id'];
                $this->data['clientes'] = $objClientes->obtenerPorId($id);
        }

        $this->data['tratamientos'] = $objTratamientos->obtenerListado();
        $this->data['terapeutas'] = $objTerapeuta->obtenerListado();
        $this->data['opiniones'] = $objOpinion->obtenerListado();


        if ($_POST) {
            $objinsertSesiones = new ClaSesiones();


            if ($objinsertSesiones->guardar($_POST)) {

                ?>
                <script>alert("Registro exitoso");
                    location.href = "/renovaSpa/admin/carta";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al registrar");
                    location.href = "/renovaSpa/admin/carta";
                </script>
                <?php
            }

        }


    }

    public function admin_Agregar()
    {

    }



}

?>