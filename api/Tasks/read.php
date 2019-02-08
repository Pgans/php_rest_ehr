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

  // Blog post query
  $result = $tasks->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $tasks_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $tasks_item = array(
        'Id' => $Id,
        'Title' => $Title,
        'Status' =>$Status,
      );

      // Push to "data"
      array_push($tasks_arr, $tasks_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($tasks_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Tasks Found')
    );
  }
