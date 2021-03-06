<?php

/**
 * Class ClaCircunstancias
 *Su objetivo es recibir las peticiones del controlador circunstancias.controller.php
 * @author Miguel �ngel Ram�rez L�pez <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class ClaCircunstancias extends Model
{
    /**
     * M�todo que obtiene el listado solicitado por el controlador
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function obtenerListado(){
        $slq = "select * from circustancias_medicas where 1";
        return $this->db->query($slq);
    }

    /**
     * M�todo que obtiene el listado filtrado por id
     * @param  [int] $id [id solicidado]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select * from circustancias_medicas where id = '{$id}' limit 1";
        $resultado=$this->db->query($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    /**
     * M�todo para insertar parametros a la base de datos
     * @param  [arreglo] $data [arreglo recogidos por el POST]
     * @param  [int] $id   [id solicitado]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
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

    /**
     * M�todo para borrar registros de la base de datos
     * @param  [int] $id [id a eliminar]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function borrarRegistro($id){
        $id = (int)$id;
        $sql = "delete from circustancias_medicas where id = {$id}";
        return $this->db->query($sql);
    }

}



?>