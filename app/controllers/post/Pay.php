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
        $payeename = isset($_POST['payeename']) ? $_POST['payeename'] : '';
        $payeetelephone = isset($_POST['payeetelephone']) ? $_POST['payeetelephone'] : '';
        $payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';

//        $invcount = Invoices::getInvoiceCodeCount($invoiceid);
//        if($invcount  == 0){
//            $rs->throwErrror('INV_404', 'Invoice ID does not exist', 'Invoice ID');
//        }

        if($invoiceid == '' ||  $invoiceid == null ) {
            $invoiceid = 'NULL';
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


        //Store Number Analysis

        $storedata = Storenumbers::getStoreDetailsbyStoreNumber($storenumber);
        $storetype = isset($storedata->storetype) ? $storedata->storetype : null;
        $cid = isset($storedata->cid) ? $storedata->cid : null;
        $location = isset($storedata->location) ? $storedata->location : null;



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
        $py->recordObject->location = $location;
        $py->recordObject->bank  = 'Fidelity Bank';

        if($py->store()){
            if($storetype != null){
                $this->updatetenants($storetype,$storenumber,$cid, $location);
            }

            $data =  ['message'=> 'Payment Data Received'];
            $rs->returnResponse($data);
        }

    }


    public function updatetenants($storetype, $storenumber, $cid, $location){

        $rates = Rates::getratebyStoreType($storetype);
        $premiumrent = isset($rates->premiumrent) ? $rates->premiumrent : '' ;
        $rent = isset($rates->rent) ? $rates->rent : '' ;
        $amount = premiumCalculation($premiumrent);
        $amountpaid = PaymentData::getTotalPaymentbyStore($storenumber);

        $paypercent = $amount == 0  ? 0 :  ( $amountpaid / $amount ) * 100;
        $count = Tenants::tenantCount($storenumber);
        if($count == 0) {
            if ($paypercent >= 20) {
                $ten = new Tenants();
                $ten->recordObject->storenumber = $storenumber;
                $ten->recordObject->cid = $cid;
                $ten->recordObject->location = $location;
                $ten->store();
            }
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

        $reverseamount = -1 * $amount;
        $py  = new Payments();
        $py->recordObject->invoiceid = null;
        $py->recordObject->amount = $reverseamount;
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


    public function transportcollection(){

        $rs = new RestApi();
        $requiredfieldnames = ['regnumber', 'type', 'telephone', 'amount', 'currency', 'userid'];
        $regnumber  = isset($_POST['regnumber']) ? $_POST['regnumber'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
        $currency = isset($_POST['currency']) ? $_POST['currency'] : '';
        $userid  = isset($_POST['userid']) ? $_POST['userid'] : '';
        $postfields = (array_keys($_POST));

        //Validating the fieldnames in the method
        $rs->validateFieldNames($requiredfieldnames, $postfields);

        // Verify Apikey
        $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);

        $py  = new Vehicle();
        $py->recordObject->regnumber = $regnumber;
        $py->recordObject->amount = $amount;
        $py->recordObject->telephone = $telephone;
        $py->recordObject->type = $type;
        $py->recordObject->currency = $currency;
        $py->recordObject->dateprocessed = date('Y-m-d H:i:s');
        $py->recordObject->userid = $userid;

        if($py->store()){
            $vid = $py->recordObject->vid;
            $vh  = new Vehicle($vid);
            $data = $vh->recordObject;
            $rs->returnResponse($data);
        }

    }



}