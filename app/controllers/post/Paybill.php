<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 9/5/2019
 * Time: 7:20 AM
 */

class Paybill extends PostController
{
    public function index(){

        $jwt = new JwtToken();
        $rs  =  new RestApi();

        $handler = fopen('php://input',  'r');
        $data  = stream_get_contents($handler);
        $data = json_decode($data);

        print_r($data);

        exit;

    }
}