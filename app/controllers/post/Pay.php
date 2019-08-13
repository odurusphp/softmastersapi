<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 8/13/2019
 * Time: 10:39 AM
 */

class Pay extends PostController
{

    public function makepayment(){


        $rs = new RestApi();

        $requiredfieldnames = ['telephone', 'invoiceid', 'amount', 'transactioncode', 'paymentdate' ];

        $paymentdate= isset($_POST['paymentdate']) ? $_POST['paymentdate'] : '';
        $invoiceid = isset($_POST['invoiceid']) ? $_POST['invoiceid'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $transactioncode = isset($_POST['transactioncode']) ? $_POST['transactioncode'] : '';
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';

        $postfields = (array_keys($_POST));

        //Validating the fieldnames in the method
        $rs->validateFieldNames($requiredfieldnames, $postfields);

        // Verify Apikey
        $apikey = $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);

        $py  = new Payments();
        $py->recordObject->invoiceid = $invoiceid;
        $py->recordObject->amount = $amount;
        $py->recordObject->telephone = $telephone;
        $py->recordObject->transactioncode = $transactioncode;
        $py->recordObject->paymentdate = $paymentdate;

        if($py->store()){
            $data =  ['message'=> 'Payment Data Received'];
            $rs->returnResponse($data);
        }

    }
}