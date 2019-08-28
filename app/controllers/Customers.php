<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 6/6/2019
 * Time: 12:36 PM
 */

class Customers extends Controller
{

    public function index($telephone){

        $rs = new RestApi();

        if($telephone == ''){
            $rs->throwErrror('TEL_101', 'Telephone', 'Telephone');
        }

        $usercount = Customer::getcustomerscountbyTelephone($telephone);
        if($usercount == 0){
            $rs->throwErrror('TEL_102', 'Telephone number doesnot exist', 'Telephone');
        }

        // Verify Apikey
        $apikey = $rs->getApikey();

        //Getting Authorization token
        $token = $rs->getBearerToken();

        //Verifying Token
        $rs->verifyToken($token);

        //Get applicant details
        $customerdata  = Customer::getcustomersbyTelephone($telephone);
        $staffid  = $customerdata->staffid;
        $cid = $customerdata->cid;
        $firstname = $customerdata->firstname;
        $lastname = $customerdata->lastname;
        $othernameas = $customerdata->middlename;
        $gender = $customerdata->gender;
        $dob = $customerdata->dateofbirth;
        $placeofbirth = $customerdata->placeofbirth;
        $age = $customerdata->age;
        $nationality = $customerdata->nationality;
        $email = $customerdata->email;
        $tin = $customerdata->tin;


        //$storenumber = $customerdata->shopnumber;
        //$natureoftrade = $customerdata->natureoftrade;
         $ownershiptype = $customerdata->occupancy;

         $st =  Customer::getallocatedCustomers($cid);
         $shopnumber = isset($st->shopnumber) ? $st->shopnumber : '';
         $natureoftrade = isset($st->natureoftrade) ? $st->natureoftrade : '';


         $basicdata = ['firstname'=>$firstname, 'lastname'=>$lastname, 'othernames'=>$othernameas,
                       'gender'=>$gender, 'dob'=>$dob, 'placeofbirth'=>$placeofbirth, 'age'=>$age,
                       'nationality'=>$nationality, 'email'=>$email, 'telephone'=>$telephone,
                       'tin'=>$tin ];

         $storedata  = ['storenumber'=>$shopnumber, 'natureoftrade'=>$natureoftrade,
                        'occupancytype'=>$ownershiptype ];

         $iddata = Idcard::getidcardbystaffid($staffid);
         $idtype = isset($iddata->type) ? $iddata->type : '';
         $idnumber = isset($iddata->idnumber) ? $iddata->idnumber : '' ;
         $dateofissue = isset($iddata->dateofissue) ? $iddata->dateofissue : '' ;

         $identitydata = ['idtype'=>$idtype, 'idnumber'=>$idnumber, 'dateofissue'=>$dateofissue];

         $loc = Location::getcustomersLocation($cid);
         $latitude = isset($loc->latitude) ? $loc->latitude : '';
         $longitude = isset($loc->longitude) ? $loc->longitude : '';
         $city = isset($loc->city) ? $loc->city: '';
         $region = isset($loc->region) ? $loc->region : '';
         $streetnumber = isset($loc->street) ? $loc->street : '';
         $housenumber = isset($loc->housenumber) ? $loc->housenumber : '';
         $popularname =isset($loc->popularname) ? $loc->popularname : '';

         $locationdata = ['latitude'=>$latitude, 'longitude'=>$longitude, 'city'=>$city, 'region'=>$region,
                          'streetnumber'=>$streetnumber, 'popularname'=>$popularname,
                          'housenumber'=>$housenumber];


          //Ducuments and Images
         $siteroot = 'http://kma.ucomgh.com';
         $passport = $siteroot.'/uploads/storeimages/'.$staffid. '.jpeg';
         $idimage  = $siteroot.'/uploads/idimages/'.$staffid. '.jpeg';

         $documents = ['passportpicture'=>$passport, 'idcard'=>$idimage];


        $responsedata  =  ['basicData'=>$basicdata, 'storeData'=>$storedata,
                          'Identification'=> $identitydata, 'locationData'=>$locationdata,
                          'Documents'=>$documents
                         ];


        $rs->returnResponse($responsedata);

    }



}