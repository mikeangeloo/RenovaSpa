<?php

/**
 * Class ClaClientes
 * Su objetivo es recibir las peticiones del controlador clientes.controller.php
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class ClaClientes extends Model
{
    public function obtenerListado(){
        $slq = "select * from clientes where 1";
        return $this->db->query($slq);
    }

    public function join(){
        $slq = "select cl.id, pai.nombre, idi.nombre, hot.nombre, age.nombre_comercial, cir.nombre, cl.fecha_alta, cl.nombre, cl.apellidos, cl.edad, cl.correo_electronico, cl.habitacion
                from clientes as cl join hoteles as hot on hot.id = cl.hotel_id
                join agencias as age on age.id = cl.agencia_id
                join idiomas as idi on idi.id = cl.idioma_id
                join circustancias_medicas as cir on cir.id = cl.circustancias_medica_id
                join paises as pai on pai.id = cl.pais_id";

       return $this->db->query2($slq);



    }

    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select cl.id, pai.nombre, idi.nombre, hot.nombre, age.nombre_comercial, cir.nombre, cl.fecha_alta, cl.nombre, cl.apellidos, cl.edad, cl.correo_electronico, cl.habitacion
                from clientes as cl join hoteles as hot on hot.id = cl.hotel_id
                join agencias as age on age.id = cl.agencia_id
                join idiomas as idi on idi.id = cl.idioma_id
                join circustancias_medicas as cir on cir.id = cl.circustancias_medica_id
                join paises as pai on pai.id = cl.pais_id
                where cl.id = '{$id}' limit 1";
        $resultado=$this->db->query2($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    public function obtenerIdSencillo($id){
        $id = (int)$id;
        $slq = "select * from clientes where id = '{$id}' limit 1";
        $resultado=$this->db->query($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    public function obtenerPaises(){
        $slq = "select * from paises";
        return $this->db->query($slq);

    }

    public function obtenerIdiomas(){
        $slq = "select * from idiomas";
        return $this->db->query($slq);

    }
    public function obtenerHoteles(){
        $slq = "select * from hoteles";
        return $this->db->query($slq);

    }

    public function obtenerAgencias(){
        $slq = "select * from agencias";
        return $this->db->query($slq);

    }
    public function obtenerCircu(){
        $slq = "select * from circustancias_medicas";
        return $this->db->query($slq);

    }




    public function guardar($data, $id=null){

        $id = (int)$id;
        $pais_id = $this->db->escape($data['pais_id']);
        $idioma_id = $this->db->escape($data['idioma_id']);
        $hotel_id = $this->db->escape($data['hotel_id']);
        $agencia_id = $this->db->escape($data['agencia_id']);
        $circustancias_medica_id = $this->db->escape($data['circustancias_medica_id']);
        $fecha_alta = $this->db->escape($data['fecha_alta']);
        $nombre = $this->db->escape($data['nombre']);
        $apellidos = $this->db->escape($data['apellidos']);
        $edad = $this->db->escape($data['edad']);
        $correo_electronico = $this->db->escape($data['correo_electronico']);
        $habitacion = $this->db->escape($data['habitacion']);

        if(!$id){
            $slq = "
                insert into clientes
                set pais_id = '{$pais_id}',
                    idioma_id = '{$idioma_id}',
                    hotel_id = '{$hotel_id}',
                    agencia_id = '{$agencia_id}',
                    circustancias_medica_id = '{$circustancias_medica_id}',
                    fecha_alta = '{$fecha_alta}',
                    nombre = '{$nombre}',
                    apellidos = '{$apellidos}',
                    edad = '{$edad}',
                    correo_electronico = '{$correo_electronico}',
                    habitacion = '{$habitacion}'
            ";
        }else{
            $slq = "
                update  clientes
                set pais_id = '{$pais_id}',
                    idioma_id = '{$idioma_id}',
                    hotel_id = '{$hotel_id}',
                    agencia_id = '{$agencia_id}',
                    circustancias_medica_id = '{$circustancias_medica_id}',
                    fecha_alta = '{$fecha_alta}',
                    nombre = '{$nombre}',
                    apellidos = '{$apellidos}',
                    edad = '{$edad}',
                    correo_electronico = '{$correo_electronico}',
                    habitacion = '{$habitacion}'
                where id = {$id}
            ";

        }
        return $this->db->query($slq);

    }

    public function borrarRegistro($id){
        $id = (int)$id;
        $sql = "delete from clientes where id = {$id}";
        return $this->db->query($sql);
    }




}



?>