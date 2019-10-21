<?php

class Rates extends tableDataObject{


    const TABLENAME = 'rates';


        public static  function getratebyStoreType($storetype){
            global $connectedDb;
            $getrecords = "SELECT *  FROM rates  WHERE storetype  =  '$storetype'  ";
            $connectedDb->prepare($getrecords);
            $connectedDb->execute();
            return $connectedDb->singleRecord();
        }

  }

 ?>
