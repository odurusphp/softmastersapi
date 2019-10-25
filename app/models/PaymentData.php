<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 8/5/2019
 * Time: 10:48 AM
 */

class PaymentData extends tableDataObject
{
     const TABLENAME = 'payments';

    public static  function getpaymentcountbyInvoiceID($invoiceid)
    {
        global $payrolldb;
        $getrecords = "select count(*) as ct from  payments where invoiceid = $invoiceid ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }


    public static  function getpaymentByCid($cid)
    {
        global $payrolldb;
        $getrecords = "select payments.*, invoices.description  from  payments 
                       inner join invoices on payments.invoiceid = invoices.invoiceid where payments.cid = $cid ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


    public static  function getAllPaymentsByStore($type = null)
    {
        $stmt  = '';
        if($type == null ){
            $stmt  = '';
        }elseif($type == 'Kejetia'){
            $stmt =  'and storenumbers.location = \'Kejetia\'';
        }elseif($type == 'Central') {
            $stmt = 'and storenumbers.location = \'Central Market\'';
        }
        global $payrolldb;
        $getrecords = "select  count(DISTINCT(payments.storenumber)) from payments 
                       inner join storenumbers on  payments.storenumber = storenumbers.shopnumber
                       where payments.storenumber <> '' $stmt  ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }


    public static  function getAllPayments($page, $interval, $type=null)
    {
        global $payrolldb;

        $stmt  = '';
        if($type == null ){
            $stmt  = '';
        }elseif($type == 'Kejetia'){
            $stmt =  'and storenumbers.location = \'Kejetia\'';
        }elseif($type == 'Central') {
            $stmt = 'and storenumbers.location = \'Central Market\'';
        }


        $getrecords = "select  DISTINCT(payments.storenumber), payments.*, storenumbers.shopnumber from payments 
                       inner join storenumbers on  payments.storenumber = storenumbers.shopnumber
                       where payments.storenumber <> '' $stmt limit $page,$interval ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


    public static  function getAllPaymentSearch($parameter)
    {
        global $payrolldb;
        $getrecords = "select * from payments where (storenumber like '$parameter%' OR payeename like '$parameter%' OR 
                       payeetelephone like '$parameter%') and storenumber <> '' ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }





    public static  function getTotalPaymentbyStore($storenumber)
    {
        global $payrolldb;
        $getrecords = "select sum(amount) as amt  from payments where storenumber= '$storenumber' ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }


    public static  function getUserPayments($userid)
    {
        //$userid = $_SESSION['userid'];
        global $payrolldb;
        $getrecords = "select * from payments where uid= $userid";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


    public static  function getTotalPayments()
    {
        global $payrolldb;
        $getrecords = "select sum(amount) as amt  from payments ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }



    public static  function getPaymentsbystorenumber($storenumber)
    {
        global $payrolldb;
        $getrecords = "select * from payments where storenumber = '$storenumber' ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }

}