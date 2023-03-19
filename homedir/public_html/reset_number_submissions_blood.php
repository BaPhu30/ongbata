<?php 
      $db = new mysqli("localhost","giaphaobt_user","Qtthuchien2021","giaphaobt_data");
      $db->query("UPDATE ftree_v1_4_users  SET number_submissions_blood =0 WHERE number_submissions_blood >0");
?>
