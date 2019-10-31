<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 10/31/2019
 * Time: 1:14 PM
 */

class Customers extends  PostController
{

    public function vehiclesearch(){

        $rs = new RestApi();

        $requiredfieldnames = ['parameter'];

        $parameter = isset($_POST['parameter']) ? trim($_POST['parameter']) : '';

        $postfields = (array_keys($_POST));

        //Validating the fieldnames in the method
        $rs->validateFieldNames($requiredfieldnames, $postfields);

        // Verify Apikey
        $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);


        $searchdata = Customer::searchtransport($parameter);
        $rs->returnResponse($searchdata);


    }


}