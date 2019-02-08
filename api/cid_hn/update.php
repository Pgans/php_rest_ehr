<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Cid_hn.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $cidhn = new Cid_hn($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $cidhn->CID = $data->CID;
  $cidhn->HN0 = $data->HN0;
  $cidhn->HN = $data->HN;
  $cidhn->XN = $data->XN;
  $cidhn->auto_cid = $data->auto_cid;
  $cidhn->hn_ssp = $data->hn_ssp;

  // Update post
  if($cidhn->update()) {
    echo json_encode(
      array('message' => 'Cid_hn Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Cid_HN Not Updated')
    );
  }

