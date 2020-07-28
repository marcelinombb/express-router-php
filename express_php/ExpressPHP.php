<?php

namespace express_php;

class ExpressPHP
{
    private $controllers_path;

    public function __construct(string $controllers_path)
    {
        $this->controllers_path = $controllers_path;
    }

    public function get(string $route, string $controller_function)
    {
        if ($_SERVER['REQUEST_METHOD'] != "GET") return;
        $reqURL = explode('?', $_SERVER["REQUEST_URI"]);
        if ($reqURL[0] === $route) $this->handleCallback($controller_function);
    }

    public function post(string $route, string $controller_function)
    {
        if ($_SERVER['REQUEST_METHOD'] != "POST") return;
        $reqURL = $_SERVER["REQUEST_URI"];
        if ($reqURL === $route) $this->handleCallback($controller_function);
    }

    private function handleCallback(string $controller_function)
    {
        $ControllerMethod = explode("@", $controller_function);

        $namespace = "\\" . str_replace("/", "\\", $this->controllers_path) . "\\" . $ControllerMethod[0];

        if (file_exists("$this->controllers_path/" . $ControllerMethod[0] . ".php")) {
            call_user_func(array(new $namespace, $ControllerMethod[1]));
        } else {
            echo "Essa classe não existe ou seu diretorio informado está incorreto";
        }
    }
}
