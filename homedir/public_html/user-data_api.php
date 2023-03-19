<?php

include "./configs/connection.php";

        function password_generate($chars) 
        {
          $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
          return substr(str_shuffle($data), 0, $chars);
        }
          $passsword = password_generate(7)."\n";
          $password_insert=sha1($passsword);
          
function check_email($email_user){
    $address = strtolower(trim($email_user));
    return (preg_match("/^[a-zA-Z0-9_.-]{1,40}+@([a-zA-Z0-9_-]){2,30}+\.([a-zA-Z0-9]){2,20}$/i",$address));
}         
// Get and decode the POST data of facebbok
if (isset($_POST['userData'])) {
    $userData = json_decode($_POST['userData']); 
 
    if(!empty($userData)){ 
        
        $token = $_POST['token'];
        $oauth_provider = $_POST['oauth_provider']; 
        $link = !empty($userData->link)?$userData->link:''; 
        $genderf = !empty($userData->gender)?$userData->gender:''; 
        $date = time();
        // Check whether user data already exists in database 
        $prevQuery = "SELECT * FROM ftree_v1_4_users WHERE email = '".$userData->email."'"; 
    
        $prevResult = $db->query($prevQuery); 
        if($prevResult->num_rows > 0){  
            // Update user data if already exists 
            $query = "UPDATE ftree_v1_4_users SET gender='".$genderf."', photo = '".$userData->picture->data->url."' WHERE  email = '".$userData->email."'"; 
            $update = $db->query($query); 
        
        
        }else{ 
            // Insert user data 
                        $query = "INSERT INTO ftree_v1_4_users  
                        (username,photo,email,gender,status,level,date,password,token) 
                        values('".$userData->last_name.$userData->first_name."','".$userData->picture->data->url."','".$userData->email."','".$genderf."','0','1','".$date."','".$password_insert."','".$token."');"; 

            $insert = $db->query($query); 

        
        } 
     
        
    } 

}



// Get and decode the POST data of google
if (isset($_POST['oauth_provider'])) {
    $userDataGoogle = json_decode($_POST['userDatagoogle']);

    if(!empty($userDataGoogle)){
        // The user's profile info
         $token = $_POST['token'];
         $date = time();
        $oauth_provider = $_POST['oauth_provider'];
        $first_name = !empty($userDataGoogle->given_name)?$userDataGoogle->given_name:'';
        $last_name  = !empty($userDataGoogle->family_name)?$userDataGoogle->family_name:'';
        $email      = !empty($userDataGoogle->email)?$userDataGoogle->email:'';
        $gender     = !empty($userDataGoogle->gender)?$userDataGoogle->gender:'';
        $locale     = !empty($userDataGoogle->locale)?$userDataGoogle->locale:'';
        $picture    = !empty($userDataGoogle->picture)?$userDataGoogle->picture:'';
        $link       = !empty($userDataGoogle->link)?$userDataGoogle->link:'';
        $oauth_uid  = $userDataGoogle->id;
    // Check whether user data already exists in database 
            $Query = "SELECT * FROM ftree_v1_4_users WHERE email ='$email'"; 

            $Result = $db->query($Query); 
            if($Result->num_rows > 0){  
                // Update user data if already exists 
                $query = "UPDATE ftree_v1_4_users SET  photo = '$picture', gender = '$gender' WHERE  email = '$email';"; 
                $update = $db->query($query); 
                
            }
            else{ 
                // Insert user data 
                $query = "INSERT INTO ftree_v1_4_users 
                (username,photo,email,gender,status,level,date,password,token) 
                values('".$last_name.$first_name."','$picture','$email','$gender','0','1','$date','$password_insert','$token');"; 
                $insert = $db->query($query); 
    
            } 
        
 
    }

}


 // update number phone
if (isset($_POST['other']['otp_number'])) {
    $usernumberphone = $_POST['numberphone'];
    if(!empty($usernumberphone)){
         $id_user = $_POST['other']['id_user'];
         $query_phone = "UPDATE ftree_v1_4_users SET mobile = '$usernumberphone' WHERE  id = '$id_user'"; 
         $update_phone = $db->query($query_phone); 
         echo json_encode('complete');
    }
}


if (isset($_GET['data_send_number'])) {
    $email_user = $_POST['email_user'];
    $name_user = $_POST['name_user'];
    $moblie_user = $_POST['numberphone_login'];
    if (!check_email($email_user)) {
        $data_login =  array(
            'mobile' => "error",
        );
    }
    else{
        $prevQuery_n = "SELECT * FROM ftree_v1_4_users WHERE  email = '".$email_user."' or username = '".$name_user."'"; 
        $Result = $db->query($prevQuery_n);
        if($Result->num_rows > 0){  
            // check username or email exist 
            $data_login =  array(
                'mobile' => "exist",
            );
        }else{ 
            $date= time();
            $token     = bin2hex(openssl_random_pseudo_bytes(16));
            $db->query("INSERT INTO ftree_v1_4_users  (username,email,status,level,date,password,token,mobile) values('".$name_user."','".$email_user."','0','1','".$date."','".$password_insert."','".$token."','".$moblie_user."')");
            $data_login =  array(
                'mobile' => $moblie_user,
            );   
        } 

        echo json_encode($data_login);

        
    }
   
}

?>