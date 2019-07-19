<?php

class Idcard extends tableDataObject{

    const TABLENAME = 'idcard';

    public static  function getidcardbystaffid($fid){
        global $connectedDb;
        $getrecords = "select * from  idcard where staffid = '$fid' ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->singleRecord();
    }

    public static  function getidcardcount($fid){
        global $connectedDb;
        $getrecords = "select count(*) as ct  from  idcard where staffid = '$fid' ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }




}


?>
