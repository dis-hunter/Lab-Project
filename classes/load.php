<?php

function classAutoLoad($classname){
    $directories=["classes"];

    foreach ($directories AS $dir){
        $filename=dirname(__FILE__).DIRECTORY_SEPERATOR.$dir.DIRECTORY_SEPERATOR.$classname.".php";
        if(file_exists($filename) AND is_readable($filename)){
            require_once $filename;
        }
    }
}

spl_autpload_register('classAutoLoad');


?>