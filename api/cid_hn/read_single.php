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
  $cidhn = new Cid_hn($db);

  // Get ID
  $cidhn->auto_cid = isset($_GET['auto_cid']) ? $_GET['auto_cid'] : die();

  // Get post
  $cidhn->read_single();

  // Create array
  $cid_arr = array(
    'CID' => $cidhn->CID,
    'HN0' => $cidhn->HN0,
    'HN' => $cidhn->HN,
    'XN' => $cidhn->XN,
    'auto_cid' => $cidhn->auto_cid,
    'hn_ssp' => $cidhn->hn_ssp
  );

  // Make JSON
  print_r(json_encode($cid_arr));