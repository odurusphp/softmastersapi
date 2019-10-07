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

        $requiredfieldnames = ['telephone', 'invoiceid', 'amount', 'transactioncode',
                                'paymentdate', 'storenumber', 'payeename', 'payeetelephone', 'payment_type'];

        $paymentdate= isset($_POST['paymentdate']) ? $_POST['paymentdate'] : '';
        $invoiceid = isset($_POST['invoiceid']) ? $_POST['invoiceid'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $transactioncode = isset($_POST['transactioncode']) ? $_POST['transactioncode'] : '';
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
        $storenumber = isset($_POST['storenumber']) ? $_POST['storenumber'] : '';
        $payeename = isset($_POST['payesname']) ? $_POST['payeename'] : '';
        $payeetelephone = isset($_POST['payeetelephone']) ? $_POST['payeetelephone'] : '';
        $payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';

        $invcount = Invoices::getInvoiceCodeCount($invoiceid);
        if($invcount  == 0){
            $rs->throwErrror('INV_404', 'Invoice ID does not exist', 'Invoice ID');
        }

        $postfields = (array_keys($_POST));

        //Validating the fieldnames in the method
        $rs->validateFieldNames($requiredfieldnames, $postfields);

        // Verify Apikey
        $apikey = $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);

        $invdata  = Invoices::getInvoicebyCode($invoiceid);
        $invid  = isset($invdata->invoiceid) ? $invdata->invoiceid : null;

        $py  = new Payments();
        $py->recordObject->invoiceid = $invid;
        $py->recordObject->amount = $amount;
        $py->recordObject->telephone = $telephone;
        $py->recordObject->transactioncode = $transactioncode;
        $py->recordObject->paymentdate = $paymentdate;
        $py->recordObject->invoicecode = $invoiceid;
        $py->recordObject->storenumber = $storenumber;
        $py->recordObject->description = $payment_type;
        $py->recordObject->status = 10;
        $py->recordObject->payeetelephone = $payeetelephone;
        $py->recordObject->payeename = $payeename;

        if($py->store()){
            $data =  ['message'=> 'Payment Data Received'];
            $rs->returnResponse($data);
        }

    }

    public function reversal(){

        $rs = new RestApi();
        $requiredfieldnames = ['telephone', 'amount', 'transactioncode', 'reversaldate', 'storenumber'];
        $reversaldate  = isset($_POST['reversaldate']) ? $_POST['reversaldate'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $transactioncode = isset($_POST['transactioncode']) ? $_POST['transactioncode'] : '';
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
        $storenumber = isset($_POST['storenumber']) ? $_POST['storenumber'] : '';
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
        $py->recordObject->invoiceid = null;
        $py->recordObject->amount = $amount;
        $py->recordObject->telephone = $telephone;
        $py->recordObject->transactioncode = $transactioncode;
        $py->recordObject->paymentdate = $reversaldate;
        $py->recordObject->storenumber = $storenumber;
        $py->recordObject->description = 'Reversal';
        $py->recordObject->status = 10;

        if($py->store()){
            $data =  ['message'=> 'Reversal xuccessfully done'];
            $rs->returnResponse($data);
        }

    }
}