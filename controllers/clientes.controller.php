<?php

/**
 * Class ClientesController
 * Su objetivo es controlar las peticiones del usuario, enviar y recibir parametros al modelo: ClaClientes.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class ClientesController extends Controller
{   /**
     * Contructor del controlador 
     * @param array $data [recibe el path de la ruta de la vista]
     */
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new ClaClientes();
    }
    /**
     * Método para que solicita el listado de parametros de la vista
     * @return [arreglo] [Arreglo con listado de parametros]
     */
    public function admin_index()
    {
        $this->data['clientes'] = $this->model->join();

    }
    /**
     * [admin_Agregar Método para invocar agregar nuevos elementos a traves del modelo]
     * @return [true:false] [Envia mensaje de exito o error de registro de parametros]
     * @param $_POST recibe parametros del formulario
     * Crea nuevos objetos para invocar los métodos de los modelos correspondientes
     * 
     */
    public function admin_Agregar()
    {

        $this->data['paises'] = $this->model->obtenerPaises();
        $this->data['idiomas'] = $this->model->obtenerIdiomas();
        $this->data['hoteles'] = $this->model->obtenerHoteles();
        $this->data['agencias'] = $this->model->obtenerAgencias();
        $this->data['circustancias_medicas'] = $this->model->obtenerCircu();
        if ($_POST) {
            $resultado = $this->model->guardar($_POST);
            if ($resultado) {
                ?>
                <script>alert("Registro exitoso");
                    location.href = "/renovaSpa/admin/clientes";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al registrar");
                    location.href = "/renovaSpa/admin/clientes";
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
     * Crea nuevos objetos para invocar los métodos de los modelos correspondientes
     */
    public function admin_Editar()
    {
        if ($_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $resultado = $this->model->guardar($_POST, $id);
            if ($resultado) {
                ?>
                <script>alert("Modificacion exitosa");
                    location.href = "/renovaSpa/admin/clientes";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al registrar");
                    location.href = "/renovaSpa/admin/clientes";
                </script>
                <?php
            }
        }
        if (isset($this->params[0])) {

            $this->data['clientes'] = $this->model->obtenerPorId($this->params[0]);
            $this->data['clientes2'] = $this->model->obtenerIdSencillo($this->params[0]);
            $this->data['paises'] = $this->model->obtenerPaises($this->params[0]);
            $this->data['idiomas'] = $this->model->obtenerIdiomas($this->params[0]);
            $this->data['hoteles'] = $this->model->obtenerHoteles($this->params[0]);
            $this->data['agencias'] = $this->model->obtenerAgencias($this->params[0]);
            $this->data['circustancias_medicas'] = $this->model->obtenerCircu($this->params[0]);
        } else {
            ?>
            <script>alert("Id Agencia Incorrecto");
                location.href = "/renovaSpa/admin/clientes";
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
                    location.href = "/renovaSpa/admin/clientes";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al eliminar");
                    location.href = "/renovaSpa/admin/clientes";
                </script>
                <?php
            }
        }

    }

}


?>