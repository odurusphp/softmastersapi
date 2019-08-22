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
        $othernameas = $customerdata->middelname;
        $gender = $customerdata->gender;
        $dob = $customerdata->dateofbirth;
        $placeofbirth = $customerdata->placeofbirth;
        $age = $customerdata->age;
        $nationality = $customerdata->nationality;
        $email = $customerdata->email;
        $tin = $customerdata->tin;


        $storenumber = $customerdata->storenumber;
        $natureoftrade = $customerdata->natureoftrade;
        $ownershiptype = $customerdata->occupancy;


         $basicdata = ['firstname'=>$firstname, 'lastname'=>$lastname, 'othernames'=>$othernameas,
                       'gender'=>$gender, 'dob'=>$dob, 'placeofbirth'=>$placeofbirth, 'age'=>$age,
                       'nationality'=>$nationality, 'email'=>$email, 'telephone'=>$telephone,
                       'tin'=>$tin ];

         $storedata  = ['storenumber'=>$storenumber, 'natureoftrade'=>$natureoftrade,
                        'occupancytype'=>$ownershiptype ];


         $iddata = Idcard::getidcardbystaffid($staffid);
         $idtype = $iddata->type;
         $idnumber = $iddata->idnumber;
         $dateofissue = $iddata->dateofissue;

         $identitydata = ['idtype'=>$idtype, 'idnumber'=>$idnumber, 'dateofissue'=>$dateofissue];

         $loc = Location::getcustomersLocation($cid);
         $latitude = $loc->latitude;
         $longitude = $loc->longitude;
         $city = $loc->city;
         $region = $loc->region;
         $streetnumber = $loc->street;
         $housenumber = $loc->housenumber;
         $popularname = $loc->popularname;

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