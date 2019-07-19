<?php

class Market extends tableDataObject{


    const TABLENAME = 'market';

    public static  function getalldata(){
        global $payrolldb;
        $getrecords = "SELECT *, market.firstname as ufirstname, market.lastname as ulastname, market.telephone as telephone
        FROM market INNER JOIN users ON market.uid = users.uid";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
     }

     public static  function getnewalldata(){
         global $payrolldb;
         $getrecords = "SELECT * from customers where source = 'new' ";
         $payrolldb->prepare($getrecords);
         $payrolldb->execute();
         return $payrolldb->resultSet();
      }

     public static  function getstorenumber($staffid){
         global $payrolldb;
         $getrecords = "SELECT * from stores where marketid = '$staffid' ";
         $payrolldb->prepare($getrecords);
         $payrolldb->execute();
         return $payrolldb->resultSet();
      }

      public static  function getallstores(){
          global $payrolldb;
          $getrecords = "SELECT storenumber, marketid from stores";
          $payrolldb->prepare($getrecords);
          $payrolldb->execute();
          return $payrolldb->resultSet();
       }

       public static  function updatestores($staffid,  $marketid){
           global $payrolldb;
           $getrecords = "UPDATE stores SET staffid = '$staffid' , source = 'new' where   marketid = '$marketid' ";
           $payrolldb->prepare($getrecords);
           $payrolldb->execute();
        }

        public static  function updatetrade($staffid,  $marketid){
            global $payrolldb;
            $getrecords = "UPDATE trade SET staffid = '$staffid' , source = 'new' where   marketid = '$marketid' ";
            $payrolldb->prepare($getrecords);
            $payrolldb->execute();
         }

}




?>
