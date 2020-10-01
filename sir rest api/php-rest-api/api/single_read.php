<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/new-pan.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new NewPan($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleEmployee();
	
    if($item->applicant_first_name != null){
        // create array
        $emp_arr = array(
            "applicant_id" =>  $item->applicant_id,
            "applicant_first_name" =>  $item->applicant_first_name,
            "applicant_middle_name" =>  $item->applicant_middle_name,
            "applicant_last_name" =>  $item->applicant_last_name,
            "father_first_name" =>  $item->father_first_name,
            "father_middle_name" =>  $item->father_middle_name,
            "father_last_name" =>  $item->father_last_name,
            "mother_first_name" =>  $item->mother_first_name,
            "mother_middle_name" =>  $item->mother_middle_name,
            "mother_last_name" =>  $item->mother_last_name,
            "mobile_no" =>  $item->mobile_no,
            "email_id" =>  $item->email_id,
            "birth_of_date" =>  $item->birth_of_date,
            "aadhaar_no" =>  $item->aadhaar_no,
            "name_of_aadhaar" =>  $item->name_of_aadhaar,
            "aadhaar_proof" =>  $item->aadhaar_proof,
            "gender" =>  $item->gender,
            "source_of_income" =>  $item->source_of_income,
            "communication_address" =>  $item->communication_address,
            "identity_proof" =>  $item->identity_proof,
            "dob_proof" =>  $item->dob_proof,
            "address_proof" =>  $item->address_proof,
            "house_no" =>  $item->house_no,
            "area" =>  $item->area,
            "city" =>  $item->city,
            "state" =>  $item->state,
            "pincode" =>  $item->pincode,
            "country" =>  $item->country
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Record not found.");
    }
?>