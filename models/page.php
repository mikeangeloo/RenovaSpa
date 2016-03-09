<?php

class Page extends Model
{
    /**
     * Método que obtiene el listado solicitado por el controlador
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function obtenerListado($only_published = false){
        $slq = "select * from hoteles where 1";
        return $this->db->query($slq);
    }

     /**
     * Método que obtiene el listado filtrado por id
     * @param  [int] $id [id solicidado]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select * from hoteles where id = '{$id}' limit 1";
        $resultado=$this->db->query($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    /**
     * Método para insertar parametros a la base de datos
     * @param  [arreglo] $data [arreglo recogidos por el POST]
     * @param  [int] $id   [id solicitado]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
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

    /**
     * Método para borrar registros de la base de datos
     * @param  [int] $id [id a eliminar]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function borrarRegistro($id){
        $id = (int)$id;
        $sql = "delete from hoteles where id = {$id}";
        return $this->db->query($sql);
    }

}






?>