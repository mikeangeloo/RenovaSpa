<?php

/**
 * Class ClaSessiones
 * Su objetivo es recibir las peticiones del controlador sessiones.controller.php
 * @author Miguel �ngel Ram�rez L�pez <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class ClaSesiones extends Model
{
    /**
     * M�todo que obtiene el listado solicitado por el controlador
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function obtenerListado(){
        $slq = "select sesiones.id, opiniones.nombre, clientes.nombre,
                clientes.apellidos, terapeutas.nombre, tratamientos.nombre from sesiones
                join clientes on clientes.id=sesiones.cliente_id
                join opiniones on opiniones.id=sesiones.opinion_id
                join terapeutas on sesiones.terapeuta_id=terapeutas.id
                join tratamientos on sesiones.tratamiento_id=tratamientos.id";
        return $this->db->query2($slq);
    }

    public function obtenerPorIdSencillo($id){
        $id = (int)$id;
        $slq = "select * from sesiones where id = '{$id}' limit 1";
        $resultado=$this->db->query($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    /**
     * M�todo que obtiene el listado filtrado por id
     * @param  [int] $id [id solicidado]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select sesiones.id, opiniones.nombre, clientes.nombre,
                clientes.apellidos, terapeutas.nombre, tratamientos.nombre from sesiones
                join clientes on clientes.id=sesiones.cliente_id
                join opiniones on opiniones.id=sesiones.opinion_id
                join terapeutas on sesiones.terapeuta_id=terapeutas.id
                join tratamientos on sesiones.tratamiento_id=tratamientos.id
                where sesiones.id = '{$id}' limit 1";
        $resultado=$this->db->query2($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    public function obtenerOpiniones(){
        $slq = "select * from opiniones";
        return $this->db->query($slq);
    }

    public function obtenerClientes(){
        $slq = "select id,nombre,apellidos from clientes";
        return $this->db->query($slq);
    }

    public function obtenerTerapeutas(){
        $slq = "select * from terapeutas";
        return $this->db->query($slq);
    }

    public function obtenerTratamientos(){
        $slq = "select * from tratamientos";
        return $this->db->query($slq);
    }

    /**
     * M�todo para insertar parametros a la base de datos
     * @param  [arreglo] $data [arreglo recogidos por el POST]
     * @param  [int] $id   [id solicitado]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function guardar($data, $id=null){
        if(isset($data['opinion'])&&($data['id_cliente'])&&($data['terapeuta_id'])&&($data['tratamiento_id'])) {


            $id = (int)$id;
            $opinion_id = $this->db->escape($data['opinion']);
            $cliente_id = $this->db->escape($data['id_cliente']);
            $terapeuta_id = $this->db->escape($data['terapeuta_id']);
            $tratamiento_id = $this->db->escape($data['tratamiento_id']);

            if (!$id) {
                $slq = "
                insert into sesiones
                set opinion_id = '{$opinion_id}',
                    cliente_id = '{$cliente_id}',
                    terapeuta_id = '{$terapeuta_id}',
                    tratamiento_id = '{$tratamiento_id}'
            ";


            } else {
                $slq = "
                update  sesiones
                set opinion_id = '{$opinion_id}',
                    cliente_id = '{$cliente_id}',
                    terapeuta_id = '{$terapeuta_id}',
                    tratamiento_id = '{$tratamiento_id}'
                where id = {$id}
            ";

            }
            return $this->db->query($slq);
        }else{
            return false;
        }



    }

    /**
     * M�todo para borrar registros de la base de datos
     * @param  [int] $id [id a eliminar]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function borrarRegistro($id){
        $id = (int)$id;
        $sql = "delete from sesiones where id = {$id}";
        return $this->db->query($sql);
    }

}





?>