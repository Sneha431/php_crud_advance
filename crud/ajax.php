<?php
// print_r($_REQUEST);
// print_r($_FILES);
// die();

$action = $_REQUEST['action'];
if (!empty($action)) {
  require_once('partials/User.php');
  $obj = new User();
}
//adding user action
if ($action == "adduser" && !empty($_POST)) {
  $pname = $_POST["username"];
  $pemail = $_POST["email"];
  $pimg = $_FILES["image"];
  $pphone = $_POST["phone"];

  $puserid = (!empty($_REQUEST["userId"])) ? $_REQUEST["userId"] : "";
  $imagename = "";
  if (!empty($pimg['name'])) {
    $imagename = $obj->upload_photo($pimg);
    $userdata = ["pname" => $pname, "email" => $pemail, "phone" => $pphone, "photo" => $imagename];
  } else {
    $userdata = ["pname" => $pname, "email" => $pemail, "phone" => $pphone];
  }
  $userid = $obj->add($userdata);
  if (!empty($userid)) {
    $user = $obj->getRow('id', $userid);
    echo json_encode($user);
    exit;
  }
}

//getcount

if ($action == "getallusers") {
  $page = (!empty($_GET["page"])) ? $_GET["page"] : 1;
  $limit = 4;
  $start = ($page - 1) * $limit;
  $users = $obj->getRows($start, $limit);
  if (!empty($users)) {
    $userlist = $users;
  } else {
    $userlist = [];
  }
  $totalcount = $obj->getCount($userlist);
  $userArr = ["count" => $totalcount, "users" => $userlist];
  echo json_encode($userArr);
  exit;
}