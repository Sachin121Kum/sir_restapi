<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/new-pan.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new NewPan($db);

    $stmt = $items->getEmployees();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $panArr = array();
        $panArr["body"] = array();
        $panArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "applicant_id" => $applicant_id,
                "applicant_first_name" => $applicant_first_name,
                "applicant_middle_name" => $applicant_middle_name,
                "applicant_last_name" => $applicant_last_name,
                "father_first_name" => $father_first_name,
                "father_middle_name" => $father_middle_name,
                "father_last_name" => $father_last_name,
                "mother_first_name" => $mother_first_name,
                "mother_middle_name" => $mother_middle_name,
                "mother_last_name" => $mother_last_name,
                "mobile_no" => $mobile_no,
                "email_id" => $email_id,
                "birth_of_date" => $birth_of_date,
                "aadhaar_no" => $aadhaar_no,
                "name_of_aadhaar" => $name_of_aadhaar,
                "aadhaar_proof" => $aadhaar_proof,
                "gender" => $gender,
                "source_of_income" => $source_of_income,
                "communication_address" => $communication_address,
                "identity_proof" => $identity_proof,
                "dob_proof" => $dob_proof,
                "address_proof" => $address_proof,
                "house_no" => $house_no,
                "area" => $area,
                "city" => $city,
                "state" => $state,
                "pincode" => $pincode,
                "country" => $country,
            );

            array_push($panArr["body"], $e);
        }
        echo json_encode($panArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>