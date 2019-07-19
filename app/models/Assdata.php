<?php

class Assdata extends tableDataObject{


    const TABLENAME = 'assdata';

      public static  function getassdatabyTelephone($telephone){
          global $payrolldb;
          $getrecords = "SELECT * FROM assdata where contact  =  '$telephone' and contact <> ''   ";
          $payrolldb->prepare($getrecords);
          $payrolldb->execute();
          return $payrolldb->singleRecord();
       }


       public static  function getassdatabyStore($storenumber){
           global $payrolldb;
           $getrecords = "SELECT * FROM assdata where storenumber  =  '$storenumber'  and storenumber <> '' ";
           $payrolldb->prepare($getrecords);
           $payrolldb->execute();
           return $payrolldb->singleRecord();
        }

        public static  function getTelephonCount($telephone){
            global $payrolldb;
            $getrecords = "SELECT count(*) as CT  FROM assdata where contact  =  '$telephone' and contact <> ''   ";
            $payrolldb->prepare($getrecords);
            $payrolldb->execute();
            return $payrolldb->fetchColumn();
         }





}


?>
