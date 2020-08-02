<?php

declare(strict_types=1);

namespace express_php;

define("DS", DIRECTORY_SEPARATOR);

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
        $Controler_Method = explode("@", $controller_function);

        $namespace = "\\" . str_replace(DS, "\\", $this->controllers_path) . "\\" . $Controler_Method[0];

        if (file_exists("$this->controllers_path" . DS . $Controler_Method[0] . ".php")) {
            call_user_func(array(new $namespace, $Controler_Method[1]));
        } else {
            echo "Essa classe não existe ou seu diretorio informado está incorreto";
        }
    }

}
