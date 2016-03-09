<?php
/**
 * Su objetivo es definir las rutas por defecto del entorno de trabajo
 * @author Miguel Ángel Ramírez López <"miguelangelramirez@tecnorrollo.com">
 * @materia Calidad en el desarrollo del software
 * @grupo TI51
 * @programa Glifosoft 1.0
 */
Config::set('site_name', 'Renova Spa');

Config::set('languages', array('en', 'fr'));

// Routes. Route nombre => prefijos de métodos
Config::set('routes', array(
    'default' => '',
    'admin'   => 'admin_',


));

Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');

Config::set('db.host','localhost');
Config::set('db.user','root');
Config::set('db.password','');
Config::set('db.db_name','spa');
