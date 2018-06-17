<?php
# get submitted values..
$c_password = isset($_REQUEST['c_password']) ? $_REQUEST['c_password'] : null;
$n_password = (isset($_REQUEST['n_password']) && validPassword($_REQUEST['n_password'])) ? $_REQUEST['n_password'] : null;
$v_password = (isset($_REQUEST['v_password']) && validPassword($_REQUEST['n_password'])) ? $_REQUEST['v_password'] : null;

if ( isset($_SESSION['user_id']) ) {
  $user_id = $_SESSION['user_id'];
} elseif ( isset($_REQUEST['user_id']) ) {
  $user_id = $_REQUEST['user_id'];
} else {
  $user_id = null;
}

# error handling..
$errors = array();

if ( empty($c_password) ) { $errors[] = "Current Password is required"; }
if ( empty($n_password) ) { $errors[] = "New Password must be 8 - 16 characters [with at least 1 lowercase; at least 1 uppercase; at least 1 number; and at least 1 special character] "; }
if ( empty($v_password) ) { $errors[] = "Verification Password is required"; }
if ( $n_password <> $v_password ) { $errors[] = "Verification password is missing / or does not match new password"; }
if ( $n_password == $c_password ) { $errors[] = "New password must be different from current password"; }

# check whether we have errors..
if (count($errors)) {

  echo <<<HereDoc
  <div class="card">
  <div class="card-header bg-warning text-white">Unable to update password. Please review the following:</div>
  <div class="panel-body">
  <ol>

HereDoc;

  foreach ($errors as $error_item) {
    echo "<li>$error_item</li>";
  }
  echo <<<HereDoc
  </ol>
  </div>
  </div><br/>
HereDoc;

  include_once $_SERVER['DOCUMENT_ROOT'] . '/networking_app/forms/change-password-form.php';
  return;

} else {

  # encrypt the passwords..
  $c_password = md5($c_password);
  $n_password = md5($n_password);

  $sql =<<<HereDoc
update bdpanet_profiles
set password = '$n_password'
where user_id = '$user_id'
and password = '$c_password'
limit 1

HereDoc;

  if (mysqli_query($dbh,$sql) && mysqli_affected_rows($dbh) > 0) {
    # password updated..

    echo <<<HereDoc
<div class="alert alert-success">Password updated successfully</div>

HereDoc;
    welcome();
  } else {
    echo <<<HereDoc
<div class="alert alert-danger">Sorry- Unable to update password..</div>

HereDoc;
    session_unset();
    session_destroy();
    loginForm();
    return;
  }
}


