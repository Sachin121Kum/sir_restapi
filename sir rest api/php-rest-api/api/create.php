<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/new-pan.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new NewPan($db);

    $data = json_decode(file_get_contents("php://input"));


    $item->applicant_first_name = $data->applicant_first_name;
    $item->applicant_middle_name = $data->applicant_middle_name;
    $item->applicant_last_name = $data->applicant_last_name;
    $item->father_first_name = $data->father_first_name;
    $item->father_middle_name = $data->father_middle_name;
    $item->father_last_name = $data->father_last_name;
    $item->mother_first_name = $data->mother_first_name;
    $item->mother_middle_name = $data->mother_middle_name;
    $item->mother_last_name = $data->mother_last_name;
    $item->mobile_no = $data->mobile_no;
    $item->email_id = $data->email_id;
    $item->birth_of_date = $data->birth_of_date;
    $item->aadhaar_no = $data->aadhaar_no;
    $item->name_of_aadhaar = $data->name_of_aadhaar;
    $item->aadhaar_proof = $data->aadhaar_proof;
    $item->gender = $data->gender;
    $item->dob_proof = $data->dob_proof;
    $item->communication_address = $data->communication_address;
    $item->identity_proof = $data->identity_proof;
    $item->address_proof = $data->address_proof;
    $item->house_no = $data->house_no;
    $item->area = $data->area;
    $item->city = $data->city;
    $item->pincode = $data->pincode;
    $item->country = $data->country;

    
    if($item->createNewPanDetails()){
        echo 'Record created successfully.';
    } else{
        echo 'Record could not be created.';
    }
?>