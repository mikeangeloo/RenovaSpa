<?php
class ClaAgencia extends Model
{
    public function obtenerListado(){
        $slq = "select * from agencias where 1";
        return $this->db->query($slq);
    }

    public function obtenerPorId($id){
        $id = (int)$id;
        $slq = "select * from agencias where id = '{$id}' limit 1";
        $resultado=$this->db->query($slq);
        return isset($resultado[0]) ? $resultado[0]:null;
    }

    public function guardar($data, $id=null){
//        if (!isset($data['razon_social'])||!isset($data['ubicacion'])){
//            return false;
//        }

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

    public function borrarRegistro($id){
        $id = (int)$id;
        $sql = "delete from agencias where id = {$id}";
        return $this->db->query($sql);
    }
}
?>