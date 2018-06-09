<?php
  session_start();
  include_once "db.php";

switch ($_REQUEST['action']) {
  case 'signup':
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    signup($conn, $username, $password);
    break;

  case 'login':
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    login($conn, $username, $password);
    break;

  default:
    header("Location: forms/signup.php");
    break;
}

function signup($conn, $username, $password) {
  $password = password_hash($password, PASSWORD_DEFAULT);

  $sql = <<<SQL
  INSERT INTO profiles (user_id, password, bdpa_chapter_key)
  VALUES ("$username", "$password", 2);
SQL;

  $result = $conn->query($sql);

  if ($result) {
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
  } else {
    echo "Not in the database.";
  }

echo "Your username is $username and password $password";
}
// include_once "db.php";
function login($conn, $username, $password) {
  $loginsql = <<<SQL
    SELECT password, user_id FROM profiles WHERE user_id="$username"
SQL;

  if (!$result = mysqli_query($conn, $loginsql)) {
    echo mysqli_error($conn);
  }

if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_array($result)) {
    foreach ($row as $key => $val) {
      $$key = $val;
    }
    $_SESSION['username'] = $username;
    include_once "dashboard.php";
  }
} else {
  echo "Not in the database.";
  include_once "forms/login.php";
  return;
}

echo "Your username is $username and password $password";
}
?>
