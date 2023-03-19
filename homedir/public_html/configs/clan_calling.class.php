<?php
 
class Getdata{
    public function select($table_name,$condition,$db)  
 {  
      $array = array();  
      $query = "SELECT * FROM ".$table_name.$condition; 

      $result = $db->query($query);  
      while($row = $result->fetch_assoc())  
      {  
           $array[] = $row;  
      }
     
      return $array; 
      var_dump($array); 
 }
public function select_column($table_name,$column,$condition,$db)  
 {  

      $array = array();  
      $query = " SELECT ".(empty($column)?'*':$column)." FROM ".$table_name.(empty($condition)?'':' Where '.$condition); 
      $result = $db->query($query);  
      while($row = $result->fetch_assoc())  
      {  
           $array[] = $row;  
      }
      return $array;  
 }
 public function select_join($table_name,$column,$join,$condition,$db)  
 {  
      $array = array();  
      $query = "SELECT ".$column." FROM ".$table_name.$join.$condition; 
      $result = $db->query($query);  
      while($row = $result->fetch_assoc())  
      {  
           $array[] = $row;  
      }  
      return $array;  
 }
}

class Updata{
     public function insert($table_name, $data,$db)  
     {  
          $string = "INSERT INTO ".$table_name." (";            
          $string .= implode(",", array_keys($data)) . ') VALUES (';            
          $string .= "'" . implode("','", array_values($data)) . "')";  
          if($db->query($string))  
          {  
               $last_id = $db->insert_id;
               return  $last_id;  
          }  
          else  
          {  
               echo "error";
          }  
     }  
     public function updatedata($table_name, $data,$condition,$db){
          $string = " UPDATE ".$table_name." SET ".$data .$condition;
          if($db->query($string))  
          {  
               return true;  
          }  
          else  
          {  
               var_dump($string);
               echo "error";
          }  

      }
}

function send_email($setSubject,$from_send,$to_send,$body){
   
          try {
            // Create the SMTP Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
              ->setUsername('toidayhoc@datdia.com')
              ->setPassword('foaymnejscmzaqwq');
        
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
        
            // Create a message
            $message = new Swift_Message();
        
            // Set a "subject"
            $message->setSubject($setSubject);
          //   $message->attach(
          //           Swift_Attachment::fromPath('https://ongbata.vn/wp-content/uploads/2021/02/logo-300x300.png')->setDisposition('inline')
          //           );
                  
               // Set the "From address"
            $message->setFrom([$from_send => 'Phần mềm gia phả Ongbata']);
        
            // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
            $message->addTo($to_send, 'recipient name');
        
            $message->setBody("This is the plain text body of the message.\nThanks,\nAdmin");
        
            // Set a "Body"
            $message->addPart($body, 'text/html');
        
            // Send the message
            $result = $mailer->send($message);
          } catch (Exception $e) {
            echo $e->getMessage();
          }


 } 



 #function check number phone
 $GLOBALS["carriers_number"] = [
     '096' => 'Viettel',
     '097' => 'Viettel',
     '098' => 'Viettel',
     '032' => 'Viettel',
     '033' => 'Viettel',
     '034' => 'Viettel',
     '035' => 'Viettel',
     '036' => 'Viettel',
     '037' => 'Viettel',
     '038' => 'Viettel',
     '039' => 'Viettel',
 
     '090' => 'Mobifone',
     '093' => 'Mobifone',
     '070' => 'Mobifone',
     '071' => 'Mobifone',
     '072' => 'Mobifone',
     '076' => 'Mobifone',
     '078' => 'Mobifone',
 
     '091' => 'Vinaphone',
     '094' => 'Vinaphone',
     '083' => 'Vinaphone',
     '084' => 'Vinaphone',
     '085' => 'Vinaphone',
     '087' => 'Vinaphone',
     '089' => 'Vinaphone',
 
     '099' => 'Gmobile',
 
     '092' => 'Vietnamobile',
     '056' => 'Vietnamobile',
     '058' => 'Vietnamobile',
 
     '095'  => 'SFone'
 ];
 
 /**
  * Check if a string is started with another string
  *
  * @param string $needle The string being searched for.
  * @param string $haystack The string being searched
  * @return bool true if $haystack is started with $needle
  */
     function start_with($needle, $haystack) {
          $length = strlen($needle);
          return (substr($haystack, 0, $length) === $needle);
     }
 
 /**
  * Detect carrier name by phone number
  *
  * @param string $number The input phone number
  * @return bool Name of the carrier, false if not found
  */
 function detect_number ($number) {
     $number = str_replace(array('-', '.', ' '), '', $number);
 
     // $number is not a phone number
     if (!preg_match('/^0[0-9]{9,10}$/', $number)) return false;
 
     // Store all start number in an array to search
     $start_numbers = array_keys($GLOBALS["carriers_number"]);
 
     foreach ($start_numbers as $start_number) {
         // if $start number found in $number then return value of $carriers_number array as carrier name
         if (start_with($start_number, $number)) {
             return $GLOBALS["carriers_number"][$start_number];
         }
     }
 
     // if not found, return false
     return false;
 }

/* //  send nofication firebase multiple */
function sendNotif($token, $notif){
     $feilds = array('registration_ids'=>$token, 'notification'=>$notif);
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($feilds));
     $headers = array();
     $headers[] = 'Authorization: Key='.API_ACCESS_KEY;/* Server key */
     $headers[] = 'Content-Type: application/json';
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     
     $result = curl_exec($ch);
     if (curl_errno($ch)) {
         echo 'Error:' . curl_error($ch);
     }
     curl_close($ch);
    //  echo $result;
 }
/* //  send nofication firebase single */
 function sendNotif_single($token, $notif){
    $feilds = array('to'=>$token, 'notification'=>$notif,'priority'      => 'high');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($feilds));
    $headers = array();
    $headers[] = 'Authorization: Key='.API_ACCESS_KEY;/* Server key */
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    // echo $result;
}
 /* //  Function update generation */
// Find parent 
function find_parent($data,$db,$fun_class_1,$fun_class_2){
     $condition= 'family = '.$data;
     $column = 'id, parent, type ' ;
     $get_data = $fun_class_1->select_column(prefix .'members',$column,$condition,$db);
     $generation = 1;
     // Find patriarch
     foreach ($get_data  as $gd){
         if ($gd['parent']==0) {
             $column = ' generation ='.$generation;
             $condition = ' Where id='.$gd['id'];
             $fun_class_2->updatedata(prefix .'members', $column,$condition,$db);
             up_generation($gd['id'],$get_data,$generation,$db,$fun_class_2);
         }
     }
 }
 
 // Find member
 function up_generation($id,$data,$generation,$db,$fun_class)
 {
     // $up_data_son = new Updata;
     foreach ($data as $dt ){
         if ($dt['parent'] ==$id) {
             if ($dt['type'] == 2 ||  $dt['type'] == 3) {
                 $doi = $generation;
             }else {
                 $doi = $generation+1;
             }
             $column_2 = ' generation ='.$doi;
             $condition_2 = ' Where id='.$dt['id'];
             $fun_class->updatedata(prefix .'members', $column_2,$condition_2,$db);
             up_generation($dt['id'],$data,($generation+1),$db,$fun_class);
         }
     }
 
 }