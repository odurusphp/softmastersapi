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

        $storecount = Storenumbers::getStoreCountByShopNumber($parameter);
        $invoicecount = Invoices::getCountInvoicebyParameter($parameter);

        if($invoicecount == 0 && $storecount == 0){
            $rs->throwErrror('PARAM_404', 'Search parameter does not exist', 'Parameter');
        }

        // Verify Apikey
        $apikey = $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);


        //Get applicant details
        if($invoicecount > 0) {
            $invoicedata = Invoices::getInvoicebyParameter($parameter);
        }else {
            $storedata = Storenumbers::getStoreDetailsbyStoreNumber($parameter);
            $storetype = $storedata->storetype;
            $rates = Rates::getratebyStoreType($storetype);
            $premium = premiumCalculation($rates->premiumrent);

            $invoicedata =[(object)[
                "firstname" => "",
                "lastname" => '',
                "telephone" => '',
                "storenumber"=> $parameter,
                "description"=> 'Rent Premium',
                "invoiceid" => 'NULL',
                'amount'=> $premium,
                "invoicecode" => 'NULL',
            ]
            ];
        }




        $responsedata = [];

         foreach($invoicedata as $get){

             $customername = $get->firstname. ' '.$get->lastname;
             $shopnumber = $get->storenumber;
             $telephone = $get->telephone;
             $customerid = $get->cid;
             $stdata = Storenumbers::getStoreDetailsbyStoreNumber($shopnumber);
             $location = isset($stdata) ? $stdata->floor : '';
             $description = $get->description;
             $invoiceamount  =  $get->amount;
             $invoiceid = $get->invoiceid;
             //$paidamount = Payments::getpaymentByInvoiceID($invoiceid);
             $paidamount = Payments::getpaymentByStorenumber($shopnumber);
             $amount = $invoiceamount - $paidamount;
             $invoicecode =  $get->invoicecode;

             $responsedata[] = ['invoiceID'=>$invoicecode, 'customerName'=>$customername,
                                'shopNumber'=>$shopnumber, 'location'=>$location,
                                'description'=>$description, 'amountDue'=>$amount,
                                 'telephone'=>$telephone, 'customerid'=>$customerid
                                ];

         }

        $rs->returnResponse($responsedata);

    }

    public function all($parameter){

        $rs = new RestApi();

        if($parameter == ''){
            $rs->throwErrror('PARAM_101', 'Search parameter cannot be null', 'Parameter');
        }


        $customercount = Customer::getcustomerscountbyTelephone($parameter);
        if($customercount == 0){
            $rs->throwErrror('CUS_101', 'Customer does not exist', 'telepehone');
        }

        // Verify Apikey
        $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);

        //Get Customer Information:
        $cusdata = Customer::getcustomersbyTelephone($parameter);
        $firstname = $cusdata->firstname;
        $lastname = $cusdata->lastname;
        $telephone = $cusdata->telephone;
        $natureoftrade = $cusdata->natureofbusiness;
        $cid = $cusdata->cid;

        $customerdata = ['firstname'=> $firstname, 'lastname'=>$lastname,
                         'telephone'=>$telephone , 'natureoftrade'=>$natureoftrade, 'customerid'=>$cid];

        //Get Store information
        $storecount = Storenumbers::getCustomerStoresCount($cid);

        if($storecount  > 0) {

            $storedata = Storenumbers::getCustomerStores($cid);
            foreach($storedata as $st) {
                $storenumber = $st->shopnumber;
                $storetype = $st->storetype;
                $floor = $st->floor;

                $premium = Invoices:: getInvoiceByServiceTypeandShopNumber($storenumber, 'Store Allocation');
                $servicecharge = Invoices::getInvoiceByServiceTypeandShopNumber($storenumber, 'Service Charge');
                $setupfee = Invoices::getInvoiceByServiceTypeandShopNumber($storenumber, 'Set-Up Fee');
                $rentfee = Invoices::getInvoiceByServiceTypeandShopNumber($storenumber, 'Rent');

                //Get All Payments
                $premiumpayments = Payments::getpaymentByStoreandDescription($storenumber, 'Premium');
                $servicechargepaymnets  = Payments::getpaymentByStoreandDescription($storenumber, 'Service Charge');
                $setupfeepayment =  Payments::getpaymentByStoreandDescription($storenumber, 'Set-Up Fee');
                $rentpayment = Payments::getpaymentByStoreandDescription($storenumber, 'Rent');

                //Amount Oustanding
                $premiumoutstanding  = $premium - $premiumpayments;
                $serviceoutstanding = $servicecharge - $servicechargepaymnets;
                $setupoustanding  = $setupfee - $setupfeepayment;
                $rentoustanding  = $rentfee - $rentpayment;
                //$paymentsdata[] = ['premium'=>$premiumoutstanding, 'setupfee'=>$setupoustanding, 'servicecharge'=>$serviceoutstanding];

                $stores[] = ['storenumber'=>$storenumber, 'storetype'=>$storetype, 'floor'=>$floor,
                             'premium_payable'=>$premiumoutstanding,  'rent_payable'=>$rentoustanding,
                             'setupfee_payable'=>$setupoustanding, 'servicecharge_payable'=>$serviceoutstanding];
            }
        }else{;
            $stores = [];
            //$paymentsdata = [];
        };

        //Get Invoice Information
//        $premium = Invoices::getInvoiceByServiceType($cid, 'Store Allocation');
//        $servicecharge = Invoices::getInvoiceByServiceType($cid, 'Service Charge');
//        $setupfee = Invoices::getInvoiceByServiceType($cid, 'Set-Up Fee');
//
//        //Get All Payments
//        $premiumpayments = Payments::getpaymentByCidandDescription($cid, 'Premium');
//        $servicechargepaymnets  = Payments::getpaymentByCidandDescription($cid, 'Service Charge');
//        $setupfeepayment =  Payments::getpaymentByCidandDescription($cid, 'Set-Up Fee');
//
//        //Amount Oustanding
//        $premiumoutstanding  = $premium - $premiumpayments;
//        $serviceoutstanding = $servicecharge - $servicechargepaymnets;
//        $setupoustanding  = $setupfee - $setupfeepayment;
//
//        $paymentsdata = ['premium'=>$premiumoutstanding, 'setupfee'=>$setupoustanding, 'servicecharge'=>$serviceoutstanding];

        $responsedata = ['customerData'=>$customerdata,  'paymentInformation'=>$stores ];

        $rs->returnResponse($responsedata);

    }

    public function store($parameter){

        $rs = new RestApi();

        if($parameter == ''){
            $rs->throwErrror('PARAM_101', 'Search parameter cannot be null', 'Parameter');
        }


        $customercount = Storenumbers::getStoreCountByShopNumber($parameter);
        if($customercount == 0){
            $rs->throwErrror('ST_101', 'Store does not exit', 'Store Number');
        }

        // Verify Apikey
        $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);

        //Get Customer Information:
        $sto = Storenumbers::getStoreDetailsbyStoreNumber($parameter);
        $cid = $sto->cid;
        $cusdata = new Customer($cid);
        $firstname = $cusdata->recordObject->firstname;
        $lastname = $cusdata->recordObject->lastname;
        $telephone = $cusdata->recordObject->telephone;
        $natureoftrade = $cusdata->recordObject->natureofbusiness;

        $customerdata = ['firstname'=> $firstname, 'lastname'=>$lastname,
            'telephone'=>$telephone , 'natureoftrade'=>$natureoftrade, 'customerid'=>$cid];

        //Get Store information
        $storecount = Storenumbers::getCustomerStoresCount($cid);

        if($storecount  > 0) {

            $storedata = Storenumbers::getAllStoreDetailsbyStoreNumber($parameter);

            foreach($storedata as $st) {
                $storenumber = $st->shopnumber;
                $storetype = $st->storetype;
                $floor = $st->floor;

                $premium = Invoices:: getInvoiceByServiceTypeandShopNumber($storenumber, 'Store Allocation');
                $servicecharge = Invoices::getInvoiceByServiceTypeandShopNumber($storenumber, 'Service Charge');
                $setupfee = Invoices::getInvoiceByServiceTypeandShopNumber($storenumber, 'Set-Up Fee');
                $rentfee = Invoices::getInvoiceByServiceTypeandShopNumber($storenumber, 'Rent');

                //Get All Payments
                $premiumpayments = Payments::getpaymentByStoreandDescription($storenumber, 'Premium');
                $servicechargepaymnets  = Payments::getpaymentByStoreandDescription($storenumber, 'Service Charge');
                $setupfeepayment =  Payments::getpaymentByStoreandDescription($storenumber, 'Set-Up Fee');
                $rentpayment = Payments::getpaymentByStoreandDescription($storenumber, 'Rent');

                //Amount Oustanding
                $premiumoutstanding  = $premium - $premiumpayments;
                $serviceoutstanding = $servicecharge - $servicechargepaymnets;
                $setupoustanding  = $setupfee - $setupfeepayment;
                $rentoustanding  = $rentfee - $rentpayment;

                $stores[] = ['storenumber'=>$storenumber, 'storetype'=>$storetype, 'floor'=>$floor,
                    'premium_payable'=>$premiumoutstanding,  'rent_payable'=>$rentoustanding,
                    'setupfee_payable'=>$setupoustanding, 'servicecharge_payable'=>$serviceoutstanding];
               }
        }else{;
            $stores = [];
            //$paymentsdata = [];
        };

        $responsedata = ['customerData'=>$customerdata,  'paymentInformation'=>$stores ];

        $rs->returnResponse($responsedata);

    }

}