<?php

/**
 * Class TratamientosController
 * Su objetivo es controlar las peticiones del usuario, enviar y recibir parametros al modelo: ClaTratamientos.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class TratamientosController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new ClaTratamientos();
    }

    public function admin_index()
    {
        $this->data['tratamientos'] = $this->model->obtenerListado();
    }

    public function admin_Agregar()
    {
        if ($_POST) {
            $resultado = $this->model->guardar($_POST);
            if ($resultado) {
                ?>
                <script>alert("Registro exitoso");
                    location.href = "/renovaSpa/admin/tratamientos";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al registrar");
                    location.href = "/renovaSpa/admin/tratamientos";
                </script>
                <?php
            }

        }
    }

    public function admin_Editar()
    {
        if ($_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $resultado = $this->model->guardar($_POST, $id);
            if ($resultado) {
                ?>
                <script>alert("Modificacion exitosa");
                    location.href = "/renovaSpa/admin/tratamientos";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al registrar");
                    location.href = "/renovaSpa/admin/tratamientos";
                </script>
                <?php
            }
        }
        if (isset($this->params[0])) {
            $this->data['tratamientos'] = $this->model->obtenerPorId($this->params[0]);
        } else {
            ?>
            <script>alert("Id Agencia Incorrecto");
                location.href = "/renovaSpa/admin/tratamientos";
            </script>
            <?php
        }
    }

    public function admin_BorrarRegistro()
    {
        if (isset($this->params[0])) {
            $resultado = $this->model->borrarRegistro($this->params[0]);
            if ($resultado) {
                ?>
                <script>alert("Registro Eliminado");
                    location.href = "/renovaSpa/admin/tratamientos";
                </script>
                <?php
            } else {
                ?>
                <script>alert("Error al eliminar");
                    location.href = "/renovaSpa/admin/tratamientos";
                </script>
                <?php
            }
        }

    }

}


?>