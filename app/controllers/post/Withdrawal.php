<?php


class Withdrawal extends PostController
{
    public function index(){

        $rs = new RestApi();

        $requiredfieldnames = ['telephone', 'name', 'amount', 'transactioncode','withdrawaldate'];

        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $transactioncode = isset($_POST['transactioncode']) ? $_POST['transactioncode'] : '';
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
        $withdrawaldate = isset($_POST['withdrawaldate']) ? $_POST['withdrawaldate'] : '';

        // Verify Apikey
        $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);

        $wt = new Withdrawaldata();
        $wt->recordObject->name = $name;
        $wt->recordObject->amount = $amount;
        $wt->recordObject->transactioncode = $transactioncode;
        $wt->recordObject->telephone = $telephone;
        $wt->recordObject->withdrawaldate = $withdrawaldate;

        if($wt->store()){
            $data = ['transactioncode'=>$transactioncode, 'amount'=>$amount, 'name'=>$name,
                    'withdrawaldate'=>$withdrawaldate];
            $rs->returnResponse($data);
        }

    }
}