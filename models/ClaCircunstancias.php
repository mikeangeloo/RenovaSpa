<?php

/**
 * Class ClaCircunstancias
 *Su objetivo es recibir las peticiones del controlador circunstancias.controller.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class ClaCircunstancias extends Model
{
    public function obtenerListado(){
        $slq = "select * from circustancias_medicas where 1";
        return $this->db->query($slq);
    }

    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select * from circustancias_medicas where id = '{$id}' limit 1";
        $resultado=$this->db->query($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    public function guardar($data, $id=null){
        $id = (int)$id;
        $nombre = $this->db->escape($data['nombre']);

        if(!$id){
            $slq = "
                insert into circustancias_medicas
                set nombre = '{$nombre}'
            ";
        }else{
            $slq = "
                update  circustancias_medicas
                set nombre = '{$nombre}'
                where id = {$id}
            ";

        }
        return $this->db->query($slq);

    }

    public function borrarRegistro($id){
        $id = (int)$id;
        $sql = "delete from circustancias_medicas where id = {$id}";
        return $this->db->query($sql);
    }

}



?>