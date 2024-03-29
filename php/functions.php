<?php

    // ***************   ADMIN LOGIN PAGE VALIDATION ********************//

    // FUNCTION 1 : This function checks whether the username and password are correct or not.

    function validate_admin_login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $errors = [];
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }else{
                $username    = $_POST["prof-username"];
                $password    = $_POST["prof-pwd"];
                $query =    "SELECT password FROM admindetails 
                            WHERE username= '$username'";
                $result = mysqli_query($con, $query);
                if(!$result){
                    die("ERROR: Could not connect.");
                }else{
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $row_cnt = mysqli_num_rows($result);
                    if($row_cnt == 1){
                        if($row["password"] == $password){
                            header("Location: http://localhost:8080/online-examination-system/views/adminAccess.php");
                        }else{
                            $mssg = "
                                <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\" style=\"display:block !important; margin-left:auto !important; margin-right:auto !important; top:3vh !important;\">
                                    <strong>Error!</strong> The credentials which you have entered, are not correct.
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                    </button>
                                </div>
                            ";
                            $errors[] = $mssg;
                        }
                    }else{
                        $mssg = "
                        <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                            <strong>Error!</strong> The credentials which you have entered, are not correct.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                        ";
                        $errors[] = $mssg;
                    }
                }
                foreach($errors as $error){
                    echo $error;
                }
            }    
        }
    }
    
    // ***************   ADMIN LOGIN PAGE VALIDATION END    ********************//


    // ***************   ADMIN PORTAL ADD USER VALIDATION END    ********************//

    // FUNCTION 1 : This function validates the data of the add user page.
    function validate_add_user() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $errors = [];

            $occupation  =      $_POST["occupation"];
            $firstname   =      $_POST["firstname"];
            $lastname    =      $_POST["lastname"];
            $username    =      $_POST["username"];
            $email       =      $_POST["email"];
            $usercourses =      $_POST["usercourses"];
            
            // VALIDATION FOR FIRSTNAME
            if(strlen($firstname) < 3){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> First Name should be atleast 3 characters long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }
            if(strlen($firstname) > 25){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> First Name can be atmost 25 characters long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }
            for($i = 0; $i < strlen($firstname); $i++){
                if(($firstname[$i] >= 'A' && $firstname[$i] <= 'Z') || ($firstname[$i] >= 'a' && $firstname[$i] <= 'z')){
                    continue;
                }else{
                    $mssg = "
                        <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                            <strong>Error!</strong> First Name should only contain letters.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                    ";
                    $errors[] = $mssg;
                    break;
                }
            }

            // VALIDATION FOR LASTNAME
            if(strlen($lastname) < 3){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> Last Name should be atleast 3 characters long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }
            if(strlen($lastname) > 25){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> Last Name can be atmost 25 characters long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }
            for($i = 0; $i < strlen($lastname); $i++){
                if(($lastname[$i] >= 'A' && $lastname[$i] <= 'Z') || ($lastname[$i] >= 'a' && $lastname[$i] <= 'z')){
                    continue;
                }else{
                    $mssg = "
                        <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                            <strong>Error!</strong> Last Name should only contain letters.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                    ";
                    $errors[] = $mssg;
                    break;
                }
            }

            // VALIDATION FOR USERNAME
            if(strlen($username) != 8){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> USERNAME must be exact 8 character long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }

            if(count($usercourses) == 0){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> One course must be selected.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }

            if(count($errors) == 0){
                $db_errors = add_user_to_db($occupation,$firstname,$lastname,$username,$usercourses, $email);
                if(count($db_errors) == 0){
                    $mssg = "
                        <div class=\"alert alert-success alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                            <strong>Success!</strong> The user is successfully added.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                    ";
                    echo $mssg;                    
                }else{
                    foreach($db_errors as $error){
                        echo $error;
                    }
                }
            }else{
                foreach($errors as $error){
                    echo $error;
                }
            }    
        }
    }
    
    // FUNCTION 2 : This function add user to the database and also checks thats the username and email are unique.

    function add_user_to_db($occupation,$firstname,$lastname,$username,$usercourses, $email) {
        $errors = [];
        $occupation = strtolower($occupation);
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }else{
            $query =    "SELECT * FROM $occupation 
                            WHERE ".$occupation."_username= '$username'";
            $result = mysqli_query($con, $query);
            if(!$result){
                die("ERROR: Could not connect.");
            }else{
                $row_cnt = mysqli_num_rows($result);
                if($row_cnt == 1){
                    $mssg = "
                        <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                            <strong>Error!</strong> Sorry the username already taken.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                    ";
                    $errors[] = $mssg;
                }
                $query =    "SELECT * FROM $occupation 
                                WHERE email= '$email'";
                $result = mysqli_query($con, $query);
                if(!$result){
                    die("ERROR: Could not connect.");
                }else{
                    $row_cnt = mysqli_num_rows($result);
                    if($row_cnt == 1){
                        $mssg = "
                            <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                                <strong>Error!</strong> Sorry the email already exists.
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                            </div>
                        ";
                        $errors[] = $mssg;
                    }
                    if(count($errors) != 0){
                        return $errors;
                    }else {
                        $count = 0;
                        $pwd = md5($username);
                        $query =    "INSERT INTO $occupation(".$occupation."_username, firstname, lastname, password, email)
                                        VALUES ('$username', '$firstname', '$lastname', '$pwd', '$email')";
                        $result = mysqli_query($con, $query);
                        if(!$result){
                            die("ERROR: Could not connect.");
                        }else{
                            $count++;
                        }
                        for($i = 0; $i < count($usercourses); $i++){
                            $cur_course = $usercourses[$i];
                            $query =    "INSERT INTO courses_$occupation(course_id, ".$occupation."_id)
                                        VALUES ('$cur_course', '$username')";
                            $result = mysqli_query($con, $query);
                            if(!$result){
                                echo "Hello1";
                                die("ERROR: Could not connect.");
                            }else{
                                $count++;
                            }
                        }
                        return $errors;
                    }
                }
            }
        }
    }
    
    // ***************   END ADMIN PORTAL ADD USER VALIDATION END    ********************//

?>