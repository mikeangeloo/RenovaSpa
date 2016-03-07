<?php

/**
 * Class ClaTerapeutas
 * Su objetivo es recibir las peticiones del controlador terapeutas.controller.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class ClaTerapeutas extends Model
{
    public function obtenerListado(){
        $slq = "select * from terapeutas where 1";
        return $this->db->query($slq);
    }

    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select * from terapeutas where id = '{$id}' limit 1";
        $resultado=$this->db->query($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    public function guardar($data, $id=null){
//        if (!isset($data['razon_social'])||!isset($data['ubicacion'])){
//            return false;
//        }

        $id = (int)$id;
        $nombre = $this->db->escape($data['nombre']);

        if(!$id){
            $slq = "
                insert into terapeutas
                set nombre = '{$nombre}'

            ";
        }else{
            $slq = "
                update  terapeutas
                set nombre = '{$nombre}'

                where id = {$id}
            ";

        }
        return $this->db->query($slq);

    }

    public function borrarRegistro($id){
        $id = (int)$id;
        $sql = "delete from terapeutas where id = {$id}";
        return $this->db->query($sql);
    }

}

?>