<?php

/**
 * Class CircunstanciasController
 * Su objetivo es controlar las peticiones del usuario, enviar y recibir parametros al modelo: ClaCircunstancias.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class CircunstanciasController extends Controller
{
    public  function __construct($data = array()){
    parent::__construct($data);
    $this->model = new ClaCircunstancias();
    }

    public function admin_index(){
        $this->data['circustancias_medicas'] = $this->model->obtenerListado();
    }

    public function admin_Agregar(){
        if($_POST){
            $resultado=$this->model->guardar($_POST);
            if($resultado){
                ?>
                <script>alert("Registro exitoso");
                    location.href= "/renovaSpa/admin/circunstancias";
                </script>
                <?php
            }else{
                ?>
                <script>alert("Error al registrar");
                    location.href= "/renovaSpa/admin/circunstancias";
                </script>
                <?php
            }

        }
    }

    public function admin_Editar(){
        if($_POST){
            $id=isset($_POST['id'])?$_POST['id']:null;
            $resultado = $this->model->guardar($_POST,$id);
            if($resultado){
                ?> <script>alert("Modificacion exitosa");
                    location.href= "/renovaSpa/admin/circunstancias";
                </script>
                <?php
            }else{
                ?> <script>alert("Error al registrar");
                    location.href= "/renovaSpa/admin/circunstancias";
                </script>
                <?php
            }
        }
        if(isset($this->params[0])){
            $this->data['circustancias_medicas']=$this->model->obtenerPorId($this->params[0]);
        }else{
            ?> <script>alert("Id circunstancia Incorrecto");
                location.href= "/renovaSpa/admin/circunstancias";
            </script>
            <?php
        }
    }

    public function admin_BorrarRegistro(){
        if(isset($this->params[0])){
            $resultado = $this->model->borrarRegistro($this->params[0]);
            if($resultado){
                ?>
                <script>alert("Registro Eliminado");
                    location.href= "/renovaSpa/admin/circunstancias";
                </script>
                <?php
            }else{
                ?>
                <script>alert("Error al eliminar");
                    location.href= "/renovaSpa/admin/circunstancias";
                </script>
                <?php
            }
        }

    }

}
?>