<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Tasks.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $tasks = new Tasks($db);

  // Get ID
  $tasks->Id = isset($_GET['Id']) ? $_GET['Id'] : die();

  // Get post
  $tasks->read_single();

  // Create array
  $tasks_arr = array(
    'Id' => $tasks->Id,
    'Title' => $tasks->Title,
    'Status' => $tasks->Status
  );

  // Make JSON
  print_r(json_encode($tasks_arr));