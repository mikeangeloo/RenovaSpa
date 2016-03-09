<?php
/**
 * Clase Padre de todos lo controladores
 * Su objetivo es heredar los métodos para obtener datos, parametros y métodos de los modelos
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
class Controller{

    protected $data;

    protected $model;

    protected $params;

    /**
     * @return mixed
     */
    public function getData(){
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getModel(){
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getParams(){
        return $this->params;
    }

    public function __construct($data = array()){
        $this->data = $data;
        $this->params = App::getRouter()->getParams();
    }

}