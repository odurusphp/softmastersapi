<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 6/24/2019
 * Time: 2:44 PM
 */

class Documents extends tableDataObject
{
    const TABLENAME = 'documents';

    public static function getDocumentcount($id, $doctype){
        global $connectedDb;
        $query = "SELECT count(*) as ct from documents where id = '$id' and type = '$doctype' ";
        $connectedDb->prepare($query);
        return $connectedDb->fetchColumn();
    }

    public static function getDocumentData($id, $doctype){
        global $connectedDb;
        $query = "SELECT * from documents where id = '$id' and type = '$doctype' ";
        $connectedDb->prepare($query);
        return $connectedDb->singleRecord();
    }

    public static function getDocumentByID($id){
        global $connectedDb;
        $query = "SELECT * from documents where id = '$id' ";
        $connectedDb->prepare($query);
        return $connectedDb->resultSet();
    }

}