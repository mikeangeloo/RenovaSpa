<?php

/**
 * Class SesionesController
 * Su objetivo es controlar las peticiones del usuario, enviar y recibir parametros al modelo: ClaSessiones.php
 * @author Miguel �ngel Ram�rez L�pez <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class SesionesController extends Controller
{   /**
     * Contructor del controlador 
     * @param array $data [recibe el path de la ruta de la vista]
     */
    public  function __construct($data = array()){
        parent::__construct($data);
        $this->model = new ClaSesiones();
    }
    /**
     * M�todo para que solicita el listado de parametros de la vista
     * @return [arreglo] [Arreglo con listado de parametros]
     */
    public function admin_index(){
        $this->data['sesiones'] = $this->model->obtenerListado();
    }
    /**
     * [admin_Agregar M�todo para invocar agregar nuevos elementos a traves del modelo]
     * @return [true:false] [Envia mensaje de exito o error de registro de parametros]
     * @param $_POST recibe parametros del formulario
     * 
     */
    public function admin_Agregar(){

        $this->data['opiniones']=$this->model->obtenerOpiniones();
        $this->data['clientes']=$this->model->obtenerClientes();
        $this->data['terapeutas']=$this->model->obtenerTerapeutas();
        $this->data['tratamientos']=$this->model->obtenerTratamientos();

        if($_POST){
            $resultado=$this->model->guardar($_POST);
            if($resultado){
                ?>
                <script>alert("Registro exitoso");
                    location.href= "/renovaSpa/admin/sesiones";
                </script>
                <?php
            }else{
                ?>
                <script>alert("Error al registrar");
                    location.href= "/renovaSpa/admin/sesiones";
                </script>
                <?php
            }

        }
    }
    /**
     * [admin_Editar M�todo para editar elementos a traves del modelo ]
     * @return [true:false] [Envia mensaje de exito o error]
     * @param $_POST recibe parametros del formulario
     * Se comunica con el modelo para ejecutar sus m�todos de modifaci�n
     */
    public function admin_Editar(){
        if($_POST){
            $id=isset($_POST['id'])?$_POST['id']:null;
            $resultado = $this->model->guardar($_POST,$id);
            if($resultado){
                ?> <script>alert("Modificacion exitosa");
                    location.href= "/renovaSpa/admin/sesiones";
                </script>
                <?php
            }else{
                ?> <script>alert("Error al registrar");
                    location.href= "/renovaSpa/admin/sesiones";
                </script>
                <?php
            }
        }
        if(isset($this->params[0])){
            $this->data['sesiones']=$this->model->obtenerPorIdSencillo($this->params[0]);
            $this->data['sesiones2']=$this->model->obtenerPorId($this->params[0]);
            $this->data['opiniones']=$this->model->obtenerOpiniones($this->params[0]);
            $this->data['clientes']=$this->model->obtenerClientes($this->params[0]);
            $this->data['terapeutas']=$this->model->obtenerTerapeutas($this->params[0]);
            $this->data['tratamientos']=$this->model->obtenerTratamientos($this->params[0]);
        }else{
            ?> <script>alert("Id circunstancia Incorrecto");
                location.href= "/renovaSpa/admin/sesiones";
            </script>
            <?php
        }
    }
    /**
     * [admin_BorrarRegistro Invoca los m�todos del modelo para borrar registros]
     * @return [true:false] [Muestra mensaje de exito o error]
     */
    public function admin_BorrarRegistro(){
        if(isset($this->params[0])){
            $resultado = $this->model->borrarRegistro($this->params[0]);
            if($resultado){
                ?>
                <script>alert("Registro Eliminado");
                    location.href= "/renovaSpa/admin/sesiones";
                </script>
                <?php
            }else{
                ?>
                <script>alert("Error al eliminar");
                    location.href= "/renovaSpa/admin/sesiones";
                </script>
                <?php
            }
        }

    }

}


?>