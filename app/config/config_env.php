<?php

//Path for uploads
$uploadpath = APPROOT.'/'.'uploads/';
define('UPLOAD_PATH', $uploadpath);

// Constant to secure "cron" jobs
define('JOBSEC', '$2y$10$VLdXLJRsEFF/lgJ2cQPEguWBLvoGSwpKPL.L3A3phIFyhDaDtr4bW');

define('JSVARS',serialize(array(
	'urlroot' => URLROOT
)));

if(!defined('SITENAME')){
	define('SITENAME','Hello, you should change me');
}

define('COMPANYNAME', 'This is probably not your company name...');

define('EMAILS_FOR_ERROR_ALERT', [
    'bryan@getinnotized.com'
]);

// Default color, if the local constant is not set
if (!defined('MAINBACKGROUND')){
    define('MAINBACKGROUND','#E46F2C');
}

// We need a curl timeout value - this is for PBX right now, but needs to be expanded. TODO!
define('PBX_CURL_TIMEOUT',5000);

define('ROUTE_REQUEST',true);
define ('ROUTE_REQUEST_PATH',[]);

//Define data types
define('BOOLEAN',  1);
define('INT',  2);
define('STRING', 3);

//Rest API Constants
define('REQUEST_METHOD_NOT_VALID',  101);
define('REQUEST_CONTENTTYPE_NOT_VALID',  102);
define('REQUEST_NOT_VALID',  103);
define('VALIDATE_PARAMETER_REQUIRED',  104);
define('VALIDATE_DATATYPE_REQUIRED',  105);
define('API_NAME_REQUIRED',  106);
define('API_PARAM_REQUIRED',  107);
define('API_DOES_NOT_EXIST',  108);
define('INCORRECT_FIELD_NAME',  109);
define('INVALID_USER_CREDENTIALS',  205);
define('SUCCESS_RESPONSE',  200);
define('AUTHORIZATION_HEADER_NOT_FOUND', 505);
define('INVALID_AUTH_TOKEN', 506);
define('JWT_PROCESSING_ERROR', 508);

define('SECRET_KEY', '123456');
//define('SMS_KEY', '7VrlW2P5LoU7K79adnYmvLB1Y');
define('SMS_KEY', 'c4b012085cf6c914e538');



// API CALL ERRORS
define('DEP_01', "Don't exist department with this ID");
define('DEP_02', "The ID is not a number");
define('CAT_01', "Don't exist category with this ID");
define('CAT_02', "The ID is not a number");
define('CAT_03', "The ID cannot be null or empty");

define('PRO_01', "Don't exist product with this ID");
define('PRO_02', "The ID is not a number");
define('PRO_03', "Check page number and limit");
define('PRO_04', "Please check parameters");

define('ATT_01', "Don't exist attribute with this ID");
define('ATT_02', "The ID is not a number");

define('REQUIRED', "Field is required");
define('MUST_BOOLEAN', "Data type nust be a boolean");
define('MUST_NUMERIC', "Data type nust be an integer");
define('MUST_STRING', "Data type nust be a string");


define('ITM_02', "The ID is not a number");

define('CART_02', "Cart ID cannot be null ");
define('CART_01', "Don't exist cart with this ID");

define('USR_01', "Email or Password is invalid.");
define('USR_04', "The email already exists.");
define('USR_05', "The email doesn't exists.");


define('AUT_01', "Authorization code is empty.");
define('AUT_03', "API Key does not exist.");
define('AUT_02', "Access Unauthorized.");

define('TAX_01', "Don't exist tax with this ID");
define('TAX_02', "The ID is not a number");

define('ORD_01', "Don't exist order with this ID");
define('ORD_02', "The ID is not a number");

define('SHP_01', "Don't exist shipping region with this ID");
define('SHP_02', "The ID is not a number");



define('USER_KEY', 'prince@2019');
