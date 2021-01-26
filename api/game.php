<<<<<<< HEAD
<?php
if(isset($_POST)) {
 $jsonz = file_get_contents('php://input');
 $dataz = json_decode($jsonz, true);
 if(isset($dataz['game_id'])){
  deliver_response("isseted");
 }
 else{
  deliver_response("not_isseted"); 
 }
 
}

function deliver_response($data) {
 header('Content-type: application/json');
 if($data == "isseted"){
   $response = array('status' => 'failed', 'message' => 'game id not available');
 }
 else{
   $response = array('status' => 'failed', 'message' => 'game id not inserted');
 }
 echo json_encode($response);
}
=======
<?php
if(isset($_POST)) {
 $jsonz = file_get_contents('php://input');
 $dataz = json_decode($jsonz, true);
 if(isset($dataz['game_id'])){
  deliver_response("isseted");
 }
 else{
  deliver_response("not_isseted"); 
 }
 
}

function deliver_response($data) {
 header('Content-type: application/json');
 if($data == "isseted"){
   $response = array('status' => 'failed', 'message' => 'game id not available');
 }
 else{
   $response = array('status' => 'failed', 'message' => 'game id not inserted');
 }
 echo json_encode($response);
}
>>>>>>> 8e856fb351392b4b7cb50a4ad55a13eb8eac225b
?>