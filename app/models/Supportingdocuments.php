<?php

class Supportingdocuments extends tableDataObject{

  const TABLENAME = 'supportingdoc';


  public static  function getsupportingdocsbystaffid($fid){
      global $payrolldb;
      $getrecords = "select * from  supportingdoc where Staffid = '$fid' ";
      $payrolldb->prepare($getrecords);
      $payrolldb->execute();
      return $payrolldb->singleRecord();
  }

  public static  function getsupcount($fid){
      global $payrolldb;
      $getrecords = "select count(*) as ct  from supportingdoc where staffid = '$fid' ";
      $payrolldb->prepare($getrecords);
      $payrolldb->execute();
      return $payrolldb->fetchColumn();
  }


}

 ?>
