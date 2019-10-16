<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 8/13/2019
 * Time: 10:27 AM
 */

class Payments extends tableDataObject
{
    const TABLENAME = 'payments';

    public static  function getpaymentByInvoiceID($invoiceid){
        global $connectedDb;
        $getrecords = "SELECT  sum(amount) as amt  FROM  payments  WHERE invoiceid = $invoiceid ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }

    public static  function getpaymentByStorenumber($storenumber){
        global $connectedDb;
        $getrecords = "SELECT  sum(amount) as amt  FROM  payments  WHERE storenumber = $storenumber ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }




}