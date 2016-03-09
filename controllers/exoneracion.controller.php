<?php
/**
 * Class ExoneracionController
 * Su objetivo es redireccionar todos los parametros del formulario para generar el 
 * formato PDF con ayuda de la clase: claExoneracion.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class ExoneracionController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new ClaExoneracion();
    }

    public function admin_index(){

    }
}

?>