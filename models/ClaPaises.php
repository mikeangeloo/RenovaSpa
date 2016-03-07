<?php

/**
 * Class Paises
 * Su objetivo es recibir las peticiones del controlador paises.controller.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class ClaPaises extends Model
{
    public function obtenerListado(){
        $slq = "select * from paises where 1";
        return $this->db->query($slq);
    }

    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select * from paises where id = '{$id}' limit 1";
        $resultado=$this->db->query($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    public function guardar($data, $id=null){
        $id = (int)$id;
        $nombre = $this->db->escape($data['nombre']);

        if(!$id){
            $slq = "
                insert into paises
                set nombre = '{$nombre}'
            ";
        }else{
            $slq = "
                update  paises
                set nombre = '{$nombre}'
                where id = {$id}
            ";

        }
        return $this->db->query($slq);

    }

    public function borrarRegistro($id){
        $id = (int)$id;
        $sql = "delete from paises where id = {$id}";
        return $this->db->query($sql);
    }
}

?>