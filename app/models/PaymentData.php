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
        global $connectedDb;
        $getrecords = "select count(*) as ct from  payments where invoiceid = $invoiceid ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }


    public static  function getpaymentByCid($cid)
    {
        global $connectedDb;
        $getrecords = "select payments.*, invoices.description  from  payments 
                       inner join invoices on payments.invoiceid = invoices.invoiceid where payments.cid = $cid ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
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
        global $connectedDb;
        $getrecords = "select  count(DISTINCT(payments.storenumber)) from payments 
                       inner join storenumbers on  payments.storenumber = storenumbers.shopnumber
                       where payments.storenumber <> '' $stmt  ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }


    public static  function getAllPayments($page, $interval, $type=null)
    {
        global $connectedDb;

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
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }


    public static  function getAllPaymentSearch($parameter)
    {
        global $connectedDb;
        $getrecords = "select * from payments where (storenumber like '$parameter%' OR payeename like '$parameter%' OR 
                       payeetelephone like '$parameter%') and storenumber <> '' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }





    public static  function getTotalPaymentbyStore($storenumber)
    {
        global $connectedDb;
        $getrecords = "select sum(amount) as amt  from payments where storenumber= '$storenumber' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }


    public static  function getUserPayments($userid)
    {
        //$userid = $_SESSION['userid'];
        global $connectedDb;
        $getrecords = "select * from payments where uid= $userid";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }


    public static  function getTotalPayments()
    {
        global $connectedDb;
        $getrecords = "select sum(amount) as amt  from payments ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }


    public static  function getPaymentsbystorenumber($storenumber)
    {
        global $connectedDb;
        $getrecords = "select * from payments where storenumber = '$storenumber' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }

}