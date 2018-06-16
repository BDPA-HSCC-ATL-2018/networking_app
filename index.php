<?php
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

  case 'profile':
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $current_job = $_REQUEST['current_job'];
    $years_participated = $_REQUEST['years_participated'];
    $bdpa_chapter_name = $_REQUEST['bdpa_chapter_name'];
    profiles($conn, $first_name, $last_name, $email, $phone, $current_job, $years_participated, $bdpa_chapter_name);
    break;

  default:
    header("Location: forms/signup.php");
    break;
}

// Signup Function
function signup($conn, $username, $password) {
  $password = password_hash($password, PASSWORD_DEFAULT);

  $sql = <<<SQL
  INSERT INTO profiles (user_id, password, bdpa_chapter_key)
  VALUES ("$username", "$password", $bdpa_chapter_key);
SQL;

  $result = $conn->query($sql);

  if ($result) {
    $_SESSION['username'] = $username;
    $_SESSION['bdpa_chapter_key'] = bdpa_chapter_key;
    header("Location: forms/profile_form.php");
  } else {
    echo "Not in the database.";
  }

echo "Your username is $username and password $password";
}

// Login Function
function login($conn, $username, $password) {
  $loginsql = <<<SQL
    SELECT password, user_id, bdpa_chapter_key FROM profiles WHERE user_id="$username"
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
    $_SESSION['bdpa_chapter_key'] = $bdpa_chapter_key;
    header("Location: dashboard.php");
  }
} else {
  echo "Not in the database.";
  include_once "forms/login.php";
  return;
}

echo "Your username is $username and password $password";
}

// Edit Profile Function
function profiles($conn, $first_name, $last_name, $email, $phone, $current_job, $years_participated, $bdpa_chapter_name) {
  $username = $_SESSION['username'];

  $sql = <<<SQL
    UPDATE profiles
    SET first_name="$first_name", last_name="$last_name", email="$email", phone="$phone", current_job="$current_job", years_participated="$years_participated"
    WHERE user_id="$username";
SQL;

  $request = $conn->query($sql);

  if($request) {
    header("Location: dashboard.php");
  } else {
    header("Location: profile.php");
  }
}
?>
