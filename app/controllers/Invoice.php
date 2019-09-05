<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 8/13/2019
 * Time: 9:45 AM
 */

class Invoice extends Controller
{

    public function search($parameter){

        $rs = new RestApi();

        if($parameter == ''){
            $rs->throwErrror('PARAM_101', 'Search parameter cannot be null', 'Parameter');
        }

        $invoicecount = Invoices::getCountInvoicebyParameter($parameter);
        if($invoicecount == 0){
            $rs->throwErrror('PARAM_404', 'Search parameter does not exist', 'Parameter');
        }

        // Verify Apikey
        $apikey = $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);

        //Get applicant details
        $invoicedata  = Invoices::getInvoicebyParameter($parameter);

        $responsedata = [];

         foreach($invoicedata as $get){

             $customername = $get->firstname. ' '.$get->lastname;
             $shopnumber = $get->storenumber;
             $telephone = $get->telephone;
             $stdata = Storenumbers::getStoreDetailsbyStoreNumber($shopnumber);
             $location = isset($stdata) ? $stdata->floor : '';
             $description = $get->description;
             $invoiceamount  =  $get->amount;
             $invoiceid = $get->invoiceid;
             $paidamount = Payments::getpaymentByInvoiceID($invoiceid);
             $amount = $invoiceamount - $paidamount;
             $invoicecode =  $get->invoicecode;

             $responsedata[] = ['invoiceID'=>$invoicecode, 'customerName'=>$customername,
                                'shopNumber'=>$shopnumber, 'location'=>$location,
                                'description'=>$description, 'amountDue'=>$amount,
                                 'telephone'=>$telephone
                                ];

         }

        $rs->returnResponse($responsedata);

    }

}