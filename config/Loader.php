<?php


class Loader
{
    public function loadClass($class)
    {
        $arr = explode('\\', $class);
        $prefix = array_shift($arr);

        if ($prefix == 'controllers') {
            $prefix_file = 'controllers/';
        } elseif ($prefix == 'config') {
            $prefix_file = 'config/';
        } elseif ($prefix == 'models') {
            $prefix_file = 'models/';
        }
        $file = '../'.$prefix_file . implode('/', $arr) . '.php';

        if (is_file($file)) {
            require_once $file;
        }
    }
}