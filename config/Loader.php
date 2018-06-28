<?php


class Loader
{
    public function loadClass($class)
    {
        $arr = explode('\\', $class);
        $prefix = array_shift($arr);
        //echo $prefix;
        //todo add models directory
        if ($prefix == 'controllers') {
            $prefix_file = 'controllers/';
        } elseif ($prefix == 'config') {
            $prefix_file = 'config/';
        }
        $file = $prefix_file . implode('/', $arr) . '.php';
        //echo $file;
        if (is_file($file)) {
            require_once $file;
        }
    }
}