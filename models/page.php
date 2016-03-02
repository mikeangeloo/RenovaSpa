<?php

class Page extends Model
{
    public function getList($only_published = false){
        $slq = "select * from pages where 1";

        if($only_published){
            $slq .= "and is_published=1";
        }
        return $this->db->query($slq);
    }

    public function getByAlias($alias){
        $alias = $this->db->escape($alias);
        $slq = "select * from pages where alias = '{$alias}' limit 1";
        $result=$this->db->query($slq);
        return isset($result[0]) ? $result[0]:null;
    }
}

?>