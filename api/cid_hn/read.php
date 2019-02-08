<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Cid_hn.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $cid_hn = new Cid_hn($db);

  // Blog post query
  $result = $cid_hn->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $cid_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $cid_item = array(
        'CID' => $CID,
        'HN0' => $HN0,
        'HN' =>$HN,
        'XN' =>$XN,
        'auto_cid' =>$auto_cid,
        'hn_ssp' =>$hn_ssp
      );

      // Push to "data"
      array_push($cid_arr, $cid_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($cid_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Cid_HN Found')
    );
  }
