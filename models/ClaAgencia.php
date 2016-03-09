<?php
/**
 * ClaAgencia clase que hereda de la clase padre Modelo
 * Su objetivo es manejar las peticiones del controlador
 */
class ClaAgencia extends Model
{
    /**
     * Método que obtiene el listado solicitado por el controlador
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function obtenerListado(){
        $slq = "select * from agencias where 1";
        return $this->db->query($slq);
    }
    /**
     * Método que obtiene el listado filtrado por id
     * @param  [int] $id [id solicidado]
     * @return [arreglo] [Devuelve arreglo con los elementos solicitados]
     */
    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select * from agencias where id = '{$id}' limit 1";
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

        $id = (int)$id;
        $razon_social = $this->db->escape($data['razon_social']);
        $nombre_comercial = $this->db->escape($data['nombre_comercial']);
        $telefono = $this->db->escape($data['telefono']);
        $correo_electronico = $this->db->escape($data['correo_electronico']);

        if(!$id){
            $slq = "
                insert into agencias
                set razon_social = '{$razon_social}',
                    nombre_comercial = '{$nombre_comercial}',
                    telefono = '{$telefono}',
                    correo_electronico = '{$correo_electronico}'
            ";
        }else{
            $slq = "
                update  agencias
                set razon_social = '{$razon_social}',
                    nombre_comercial = '{$nombre_comercial}',
                    telefono = '{$telefono}',
                    correo_electronico = '{$correo_electronico}'
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
        $sql = "delete from agencias where id = {$id}";
        return $this->db->query($sql);
    }
}
?>