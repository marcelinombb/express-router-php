<?php

namespace App\controllers;

class TestController
{
    public function home()
    {
        echo "HOME";
    }
    public function login()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data, true);
        print_r($data);
        echo json_encode(["LOGIN" => true]);
    }
    public function logout()
    {
        $data = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        echo "logout $data";
    }
}
