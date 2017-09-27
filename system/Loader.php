<?php

namespace System;

class Loader
{
    public $vars;
    
    public function __construct($obj)
    {
        $this->vars = get_object_vars($obj);
    }

    /**
     * Load helper
     * @param string $name
     */
    public function helper($name)
    {
        require_once __DIR__."/helpers/".$name.".php";
    }

    public function view($name, $data = [])
    {
        if(array_keys($data) !== range(0, count($data) - 1)){
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        
        $pagesdir = $GLOBALS['env']['dir']['pages'];

        require $pagesdir.'/'.$name.'.php';
    }

    public function lib($libname)
    {
        $appdir = 'libs/'.$libname.'.php';

        require $appdir;
    }
}
