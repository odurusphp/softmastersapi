<?php

class Rates extends tableDataObject{


    const TABLENAME = 'rates';


        public static  function getratebyStoreType($storetype){
            global $payrolldb;
            $getrecords = "SELECT *  FROM rates  WHERE storetype  =  '$storetype'  ";
            $payrolldb->prepare($getrecords);
            $payrolldb->execute();
            return $payrolldb->singleRecord();
        }

  }

 ?>
