<?php

/**
 * Class TerapeutasController
 * Su objetivo es controlar las peticiones del usuario, enviar y recibir parametros al modelo: ClaTerapeutas.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class TerapeutasController extends Controller
{   /**
     * Contructor del controlador 
     * @param array $data [recibe el path de la ruta de la vista]
     */
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new ClaTerapeutas();
    }
    /**
     * Método para que solicita el listado de parametros de la vista
     * @return [arreglo] [Arreglo con listado de parametros]
     */
    public function admin_index()
    {
        $this->data['terapeutas'] = $this->model->obtenerListado();
    }
    /**
     * [admin_Agregar Método para invocar agregar nuevos elementos a traves del modelo]
     * @return [true:false] [Envia mensaje de exito o error de registro de parametros]
     * @param $_POST recibe parametros del formulario
     * 
     */
    public function admin_Agregar()
    {
        if ($_POST) {
            $resultado = $this->model->guardar($_POST);
            if ($resultado) {
                ?>
                <script>alert("Registro exitoso");
                    location.href = "/renovaSpa/admin/terapeutas";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al registrar");
                    location.href = "/renovaSpa/admin/terapeutas";
                </script>
                <?php
            }

        }
    }
    /**
     * [admin_Editar Método para editar elementos a traves del modelo ]
     * @return [true:false] [Envia mensaje de exito o error]
     * @param $_POST recibe parametros del formulario
     * Se comunica con el modelo para ejecutar sus métodos de modifación
     */
    public function admin_Editar()
    {
        if ($_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $resultado = $this->model->guardar($_POST, $id);
            if ($resultado) {
                ?>
                <script>alert("Modificacion exitosa");
                    location.href = "/renovaSpa/admin/terapeutas";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al registrar");
                    location.href = "/renovaSpa/admin/terapeutas";
                </script>
                <?php
            }
        }
        if (isset($this->params[0])) {
            $this->data['terapeutas'] = $this->model->obtenerPorId($this->params[0]);
        } else {
            ?>
            <script>alert("Id Agencia Incorrecto");
                location.href = "/renovaSpa/admin/terapeutas";
            </script>
            <?php
        }
    }
    /**
     * [admin_BorrarRegistro Invoca los métodos del modelo para borrar registros]
     * @return [true:false] [Muestra mensaje de exito o error]
     */
    public function admin_BorrarRegistro()
    {
        if (isset($this->params[0])) {
            $resultado = $this->model->borrarRegistro($this->params[0]);
            if ($resultado) {
                ?>
                <script>alert("Registro Eliminado");
                    location.href = "/renovaSpa/admin/terapeutas";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al eliminar");
                    location.href = "/renovaSpa/admin/terapeutas";
                </script>
                <?php
            }
        }

    }

}

?>