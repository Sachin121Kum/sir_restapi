<?php
    class NewPan{

        // Connection
        private $conn;

        // Table
        private $db_newpan_address = "newpan_address";
        private $db_newpan_document = "newpan_document";
        private $db_newpan_personal_info = "newpan_personal_info";

        // Personal Information Columns
        public $applicant_id;
        public $applicant_first_name;
        public $applicant_middle_name;
        public $applicant_last_name;
        public $father_first_name;
        public $father_middle_name;
        public $father_last_name;
        public $mother_first_name;
        public $mother_middle_name;
        public $mother_last_name;
        public $mobile_no;
        public $email_id;
        public $birth_of_date;
        public $aadhaar_no;
        public $name_of_aadhaar;
        public $aadhaar_proof;
        public $gender;
        public $source_of_income;
        public $communication_address;

        // Document Columns
        public $identity_proof;
        public $dob_proof;
        public $address_proof;

        // Address Columns
        public $house_no;
        public $area;
        public $city;
        public $state;
        public $pincode;
        public $country;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getEmployees(){
            $sqlQuery = "SELECT * FROM ". $this->$db_newpan_personal_info . " a, ". $this->db_newpan_address . " b, ". $this->db_newpan_document . " c WHERE a.applicant_id = b.applicant_id and b.applicant_id=c.applicant_id";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createNewPanDetails(){
            $userId = $this->insertNewPanPersonal();
            echo $userId;
            if($userId != 0 && $this->insertNewPanAddress($userId) && $this->insertNewPanDocument($userId)){
                return true;
            }
            else{
                return false;
            }
        }


        public function insertNewPanPersonal(){
            $sqlQuery = "INSERT INTO ".$this->db_newpan_personal_info." (applicant_first_name, applicant_middle_name, applicant_last_name, father_first_name, father_middle_name, father_last_name, mother_first_name, mother_middle_name, mother_last_name, mobile_no, email_id, birth_of_date, aadhaar_no, name_of_aadhaar, aadhaar_proof, gender, source_of_income, communication_address) VALUES (:applicant_first_name, :applicant_middle_name, :applicant_last_name, :father_first_name, :father_middle_name, :father_last_name, :mother_first_name, :mother_middle_name, :mother_last_name, :mobile_no, :email_id, :birth_of_date, :aadhaar_no, :name_of_aadhaar, :aadhaar_proof, :gender, :source_of_income, :communication_address)";

            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->applicant_first_name=htmlspecialchars(strip_tags($this->applicant_first_name));
            $this->applicant_middle_name=htmlspecialchars(strip_tags($this->applicant_middle_name));
            $this->applicant_last_name=htmlspecialchars(strip_tags($this->applicant_last_name));
            $this->father_first_name=htmlspecialchars(strip_tags($this->father_first_name));
            $this->father_middle_name=htmlspecialchars(strip_tags($this->father_middle_name));

            $this->father_last_name=htmlspecialchars(strip_tags($this->father_last_name));
            $this->mother_first_name=htmlspecialchars(strip_tags($this->mother_first_name));
            $this->mother_middle_name=htmlspecialchars(strip_tags($this->mother_middle_name));
            $this->mother_last_name=htmlspecialchars(strip_tags($this->mother_last_name));
            $this->mobile_no=htmlspecialchars(strip_tags($this->mobile_no));

            $this->email_id=htmlspecialchars(strip_tags($this->email_id));
            $this->birth_of_date=htmlspecialchars(strip_tags($this->birth_of_date));
            $this->aadhaar_no=htmlspecialchars(strip_tags($this->aadhaar_no));
            $this->name_of_aadhaar=htmlspecialchars(strip_tags($this->name_of_aadhaar));
            $this->aadhaar_proof=htmlspecialchars(strip_tags($this->aadhaar_proof));

            $this->gender=htmlspecialchars(strip_tags($this->gender));
            $this->source_of_income=htmlspecialchars(strip_tags($this->source_of_income));
            $this->communication_address=htmlspecialchars(strip_tags($this->communication_address));
           
            // bind data
            $stmt->bindParam(":applicant_first_name", $this->applicant_first_name);
            $stmt->bindParam(":applicant_middle_name", $this->applicant_middle_name);
            $stmt->bindParam(":applicant_last_name", $this->applicant_last_name);
            $stmt->bindParam(":father_first_name", $this->father_first_name);
            $stmt->bindParam(":father_middle_name", $this->father_middle_name);

            $stmt->bindParam(":father_last_name", $this->father_last_name);
            $stmt->bindParam(":mother_first_name", $this->mother_first_name);
            $stmt->bindParam(":mother_middle_name", $this->mother_middle_name);
            $stmt->bindParam(":mother_last_name", $this->mother_last_name);
            $stmt->bindParam(":mobile_no", $this->mobile_no);

            $stmt->bindParam(":email_id", $this->email_id);
            $stmt->bindParam(":birth_of_date", $this->birth_of_date);
            $stmt->bindParam(":aadhaar_no", $this->aadhaar_no);
            $stmt->bindParam(":name_of_aadhaar", $this->name_of_aadhaar);
            $stmt->bindParam(":aadhaar_proof", $this->aadhaar_proof);

            $stmt->bindParam(":gender", $this->gender);
            $stmt->bindParam(":source_of_income", $this->source_of_income);
            $stmt->bindParam(":communication_address", $this->communication_address);
        
            if($stmt->execute()){
               return $this->conn->lastInsertId();
            }
            return 0;
        }



        public function insertNewPanAddress($applicant_id){
            $sqlQuery = "INSERT INTO ".$this->db_newpan_address." (applicant_id, house_no, area, city, state, pincode, country) VALUES (:applicant_id, :house_no, :area, :city, :state, :pincode, :country)";

            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->applicant_id=htmlspecialchars(strip_tags($applicant_id));
            $this->house_no=htmlspecialchars(strip_tags($this->house_no));
            $this->area=htmlspecialchars(strip_tags($this->area));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->state=htmlspecialchars(strip_tags($this->state));
            $this->pincode=htmlspecialchars(strip_tags($this->pincode));
            $this->country=htmlspecialchars(strip_tags($this->country));
            
           
            // bind data
            $stmt->bindParam(":applicant_id", $this->applicant_id);
            $stmt->bindParam(":house_no", $this->house_no);
            $stmt->bindParam(":area", $this->area);
            $stmt->bindParam(":city", $this->city);
            $stmt->bindParam(":state", $this->state);
            $stmt->bindParam(":pincode", $this->pincode);
            $stmt->bindParam(":country", $this->country);
            
           
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function insertNewPanDocument($applicant_id){
            $sqlQuery = "INSERT INTO ".$this->db_newpan_document." (applicant_id, identity_proof, dob_proof, address_proof) VALUES (:applicant_id, :identity_proof, :dob_proof, :address_proof)";

            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->applicant_id=htmlspecialchars(strip_tags($applicant_id));
            $this->identity_proof=htmlspecialchars(strip_tags($this->identity_proof));
            $this->dob_proof=htmlspecialchars(strip_tags($this->dob_proof));
            $this->address_proof=htmlspecialchars(strip_tags($this->address_proof));
            
           
            // bind data
            $stmt->bindParam(":applicant_id", $this->applicant_id);
            $stmt->bindParam(":identity_proof", $this->identity_proof);
            $stmt->bindParam(":dob_proof", $this->dob_proof);
            $stmt->bindParam(":address_proof", $this->address_proof);
            
           
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleEmployee(){
            $sqlQuery = "SELECT * FROM ". $this->db_newpan_personal_info . " a, ". $this->db_newpan_address . " b, ". $this->db_newpan_document . " c WHERE a.applicant_id = b.applicant_id and b.applicant_id=c.applicant_id and ".
                    "a.applicant_id = ? ".
                    "LIMIT 0,1";


            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->applicant_id = $dataRow['applicant_id'];
            $this->applicant_first_name = $dataRow['applicant_first_name'];
            $this->applicant_middle_name = $dataRow['applicant_middle_name'];
            $this->applicant_last_name = $dataRow['applicant_last_name'];
            $this->father_first_name = $dataRow['father_first_name'];
            $this->father_middle_name = $dataRow['father_middle_name'];
            $this->father_last_name = $dataRow['father_last_name'];
            $this->mother_first_name = $dataRow['mother_first_name'];
            $this->mother_middle_name = $dataRow['mother_middle_name'];
            $this->mother_last_name = $dataRow['mother_last_name'];
            $this->mobile_no = $dataRow['mobile_no'];
            $this->email_id = $dataRow['email_id'];
            $this->birth_of_date = $dataRow['birth_of_date'];
            $this->aadhaar_no = $dataRow['aadhaar_no'];
            $this->name_of_aadhaar = $dataRow['name_of_aadhaar'];
            $this->aadhaar_proof = $dataRow['aadhaar_proof'];
            $this->gender = $dataRow['gender'];
            $this->source_of_income = $dataRow['source_of_income'];
            $this->communication_address = $dataRow['communication_address'];
            $this->identity_proof = $dataRow['identity_proof'];
            $this->dob_proof = $dataRow['dob_proof'];
            $this->address_proof = $dataRow['address_proof'];
            $this->house_no = $dataRow['house_no'];
            $this->area = $dataRow['area'];
            $this->city = $dataRow['city'];
            $this->state = $dataRow['state'];
            $this->pincode = $dataRow['pincode'];
            $this->country = $dataRow['country'];
        }        

        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

