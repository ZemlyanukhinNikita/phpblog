<?php

namespace config;

class Router
{
    public function start()
    {
        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        //echo $route;
        $routing = [
            '/' => ['controller' => 'News', 'action' => 'index'],
            '/news' => ['controller' => 'News', 'action' => 'getNews'],
        ];

        if (isset($routing[$route])) {
            $controller = 'controllers\\' . $routing[$route]['controller'] . 'Controller';
            $cntrl = new $controller();
            $cntrl->{$routing[$route]['action']}();
        } else {
            //todo return 404 view
            echo '404';
        }
    }

}