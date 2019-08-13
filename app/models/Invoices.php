<?php


class Invoices extends tableDataObject{

    const TABLENAME = 'invoices';

    public static  function getInvoices($invoiceid){
        global  $connectedDb;

        $getrecords = "SELECT invoices.*, customers.* FROM invoices INNER JOIN customers
                        ON invoices.cid  = customers.cid  WHERE invoiceid = '$invoiceid'";
        $connectedDb->prepare($getrecords);
        return $connectedDb->singleRecord();
    }

    public static  function getInvoicesbycid($cid){
        global $connectedDb;

        $getrecords = "SELECT * from invoices where cid = $cid";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }

    public static  function gettotalAmountBycid($cid){
        global $connectedDb;

        $getrecords = "SELECT sum(amount) as total from invoices where cid = $cid";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }

    public static  function gettotalAmountByInvoiceId($invoiceid){
        global $connectedDb;

        $getrecords = "SELECT sum(amount) as total from invoices where invoiceid = $invoiceid ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }


    public static  function getInvoicebyParameter($parameter){
        global $connectedDb;

        $getrecords = "SELECT invoices.*, customers.firstname, customers.lastname FROM invoices INNER JOIN customers ON
                        invoices.cid = customers.cid WHERE invoices.storenumber = '$parameter'
                        OR invoices.invoicecode   = '$parameter' OR customers.telephone = '$parameter' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }

    public static  function getCountInvoicebyParameter($parameter)
    {
        global $connectedDb;

        $getrecords = "SELECT count(*) as ct FROM invoices INNER JOIN customers ON
                        invoices.cid = customers.cid WHERE invoices.storenumber = '$parameter'
                        OR invoices.invoicecode   = '$parameter' OR customers.telephone = '$parameter' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();

    }


    public static  function getInvoicebyCode($invoicecode)
    {
        global $connectedDb;
        $getrecords = "SELECT invoiceid from invoices where invoicecode = '$invoicecode' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();

    }


    public static  function getInvoiceCodeCount($invoicecode)
    {
        global $connectedDb;
        $getrecords = "SELECT count(*)  as ct  from invoices where invoicecode = '$invoicecode' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();

    }









}



 ?>
