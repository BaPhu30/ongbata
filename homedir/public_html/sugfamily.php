<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/
 
include __DIR__.'/configs/config.php';

$suggestions 	= [];

$sql = $db->query("SELECT * FROM ".prefix."families WHERE name LIKE '%".sc_sec($_GET['term'])."%'");
while($rs = $sql->fetch_assoc()){
	$suggestions[] = "(#{$rs['id']}) ".$rs['name'];
}

$data 			= [];

foreach($suggestions as $suggestion){
	if(strpos(strtolower($suggestion), strtolower($_GET['term'])) !== false)
		$data[] = $suggestion;
}

header('Content-Type: application/json');
echo json_encode(['suggestions' => $data]);
