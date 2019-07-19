<?php

class Utility extends tableDataObject{

   const TABLENAME = 'utility';

   public static  function getutiltiybystaffid($fid){
       global $payrolldb;
       $getrecords = "select * from  utility  where staffid = '$fid' ";
       $payrolldb->prepare($getrecords);
       $payrolldb->execute();
       return $payrolldb->singleRecord();
   }

   public static  function getutilcount($fid){
       global $payrolldb;
       $getrecords = "select count(*) as ct  from   utility where staffid = '$fid' ";
       $payrolldb->prepare($getrecords);
       $payrolldb->execute();
       return $payrolldb->fetchColumn();
   }




}


 ?>
