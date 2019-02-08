<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Tasks.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $tasks = new Tasks($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $tasks->Title = $data->Title;
  $tasks->Status = $data->Status;
  
  // Create Tasks
  if($tasks->create()) {
    echo json_encode(
      array('message' => 'Tasks Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Tasks Not Created')
    );
  }

