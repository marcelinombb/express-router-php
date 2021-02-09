<?php

declare(strict_types=1);

namespace express_php;

define("DS", DIRECTORY_SEPARATOR);

class ExpressPHP
{
    private static string $controllers_path;

    /**
     * Undocumented function
     *
     * @param string $controllers_path
     */
    public function __construct(string $controllers_path)
    {
        self::$controllers_path = $controllers_path;
    }
    
    private function get_method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    private function get_ReqUri()
    {
        return $_SERVER["REQUEST_URI"];
    }
    /**
     * Undocumented function
     *
     * @param string $route
     * @param string $controller_function
     * @return void
     */
    public static function get(string $route, string $controller_function)
    {
        if ($this->get_method() != "GET") return;
        $reqURL = explode('?', $this->get_ReqUri());
        if ($reqURL[0] === $route) self::handleCallback($controller_function);
    }

    /**
     * Undocumented function
     *
     * @param string $route
     * @param string $controller_function
     * @return void
     */
    public static function post(string $route, string $controller_function)
    {
        if ($this->get_method() != "POST") return;
        $reqURL = $this->get_ReqUri();
        if ($reqURL === $route) self::handleCallback($controller_function);
    }

    /**
     * Undocumented function
     *
     * @param string $controller_function
     * @return void
     */
    private static function handleCallback(string $controller_function)
    {
        $Controler_Method = explode("@", $controller_function);

        $namespace = "\\" . str_replace(DS, "\\", self::$controllers_path) . "\\" . $Controler_Method[0];

        if (file_exists(self::$controllers_path . DS . $Controler_Method[0] . ".php")) {
            call_user_func(array(new $namespace, $Controler_Method[1]));
        } else {
            echo "Essa classe não existe ou seu diretorio informado está incorreto";
        }
    }

}
