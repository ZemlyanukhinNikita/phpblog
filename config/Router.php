<?php

namespace config;

class Router
{
    public function start()
    {
        $routes = [
            'news/([0-9]+)' => 'news/show/$1',
            'news' => 'news/index',
        ];

        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = trim($_SERVER['REQUEST_URI'], '/');
        }

        foreach ($routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = 'controllers\\'.ucfirst($controllerName);

                $actionName = array_shift($segments);

                $parameters = $segments;

                $controllerObject = new $controllerName;
                $result = call_user_func_array([$controllerObject, $actionName],$parameters);

                if($result!==null)
                {
                    break;
                }
            }
        }
    }

}