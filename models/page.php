<?php

class Page extends Model
{
    public function obtenerListado($only_published = false){
        $slq = "select * from hoteles where 1";
        return $this->db->query($slq);
    }

    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select * from hoteles where id = '{$id}' limit 1";
        $resultado=$this->db->query($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    public function guardar($data, $id=null){
        if (!isset($data['nombre'])||!isset($data['ubicacion'])){
            return false;
        }

        $id = (int)$id;
        $nombre = $this->db->escape($data['nombre']);
        $ubicacion = $this->db->escape($data['ubicacion']);

        if(!$id){
            $slq = "
                insert into hoteles
                set nombre = '{$nombre}',
                    ubicacion = '{$ubicacion}'
            ";
        }else{
            $slq = "
                update  hoteles
                set  nombre = '{$nombre}',
                    ubicacion = '{$ubicacion}'
                where id = {$id}
            ";

        }
        return $this->db->query($slq);

    }

    public function borrarRegistro($id){
        $id = (int)$id;
        $sql = "delete from hoteles where id = {$id}";
        return $this->db->query($sql);
    }

}






?>