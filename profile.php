<?php
# get the values submitted from the website

if ( isset($_SESSION['user_id']) ) {
  $user_id = $_SESSION['user_id'];
} elseif ( isset($_REQUEST['user_id']) ) {
  $user_id = $_REQUEST['user_id'];
} else {
  $user_id = null;
}

$first_name = isset($_REQUEST['first_name']) ? prettyStr($_REQUEST['first_name']) : null;
$last_name = isset($_REQUEST['last_name']) ? prettyStr($_REQUEST['last_name']) : null;
$email = isset($_REQUEST['email']) ? filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL) : null;
$password = isset($_REQUEST['password']) ? validPassword($_REQUEST['password']) : null;

# encrypt the password..
if ( $password ) { $password = md5($password); }

$current_job = isset($_REQUEST['current_job']) ? prettyStr($_REQUEST['current_job']) : null;
$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
$bdpa_chapter_key = isset($_REQUEST['bdpa_chapter_key']) ? $_REQUEST['bdpa_chapter_key'] : null;
$years_participated = isset($_REQUEST['years_participated']) ? $_REQUEST['years_participated'] : null;

$event = (isset($_REQUEST['event']) && !empty($_REQUEST['event'])) ? $_REQUEST['event'] : 'new';

# generate a user_id..
if ( empty($user_id) || $event == 'new' ) {
  $user_id = getUserID($first_name,$last_name);
}

# error handling..
$errors = array();
if ( empty($user_id) ) { $errors[] = "Error setting User ID $password"; }
if ( empty($first_name) ) { $errors[] = 'First Name is required'; }
if ( empty($last_name) ) { $errors[] = 'Last name is required'; }
if ( empty($email) ) { $errors[] = 'Email is required'; }
if ( $event == 'new' && empty($password) ) { $errors[] = "Valid Password is required (8-16 alphanumeric/special characters) $user_id"; }
if ( empty($phone) ) { $errors[] = 'Phone number is required'; }

if ( empty($current_job) ) { $errors[] = 'Current Job is required'; }
if ( empty($bdpa_chapter_key) ) { $errors[] = 'BDPA Chapter is required'; }
if ( empty($years_participated) ) { $errors[] = 'Years participated is required'; }

# now check whether we have errors..
if (count($errors)) {

  echo <<<HereDoc
  <div class="card">
  <div class="card-header bg-warning text-white">Please review the following:</div>
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

  include_once 'forms/profile-form.php';
  return;
} else {
  # save session variables for later use..
  $_SESSION['user_id'] = $user_id;

  # prepare for database..
  $user_id = empty($user_id) ? 'NULL' : "\"$user_id\"";
  $first_name = empty($first_name) ? 'NULL' : "\"$first_name\"";
  $last_name = empty($last_name) ? 'NULL' : "\"$last_name\"";
  $email = empty($email) ? 'NULL' : "\"$email\"";
  $password = empty($password) ? 'NULL' : "\"$password\"";
  $phone = empty($phone) ? 'NULL' : "\"$phone\"";
  $current_job = empty($current_job) ? 'NULL' : "\"$current_job\"";
  $bdpa_chapter_key = empty($bdpa_chapter_key) ? 'NULL' : "\"$bdpa_chapter_key\"";
  $years_participated = empty($years_participated) ? 'NULL' : "\"$years_participated\"";

  # SQL to save the data
  $add_sql =<<<HereDoc
insert into bdpanet_profiles (
  user_id,
  password,
  first_name,
  last_name,
  email,
  phone,
  current_job,
  bdpa_chapter_key,
  years_participated
) values (
  $user_id,
  $password,
  $first_name,
  $last_name,
  $email,
  $phone,
  $current_job,
  $bdpa_chapter_key,
  $years_participated
)

HereDoc;

$update_sql =<<<HereDoc
update bdpanet_profiles
set
  first_name        = $first_name,
  last_name         = $last_name,
  email             = $email,
  phone             = $phone,
  current_job       = $current_job,
  bdpa_chapter_key  = $bdpa_chapter_key,
  years_participated= $years_participated,
  lastmod           = now()
where user_id = $user_id
limit 1

HereDoc;

  $sql = ($event == 'new') ? $add_sql : $update_sql;

  if (mysqli_query($dbh,$sql) && mysqli_affected_rows($dbh) > 0) {

    echo <<<HereDoc
<div class="alert alert-success alert-dismissible fade show">
  Profile information saved successfully
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

HereDoc;

    include_once __DIR__ . '/dashboard.php';

  } else {
    errorHandler(mysqli_error($dbh), $sql);
/*
    $error_message = mysqli_error($dbh);
    echo <<<HereDoc
    <div class="alert alert-warning">
    <h4>Problem Saving member information</h4>
    $error_message
    <pre>$sql</pre>
    </div>

HereDoc;
*/
    # take the user back to the form..
    profileForm();

  }
}

function getUserID($first_name,$last_name) {
  global $dbh, $errors;
  $user_id = strtolower(substr($first_name,0,1) . $last_name);

  # sanity check..
  $sql = "select count(*) as count from bdpanet_profiles where user_id='$user_id'";

  $count = fetch_one($sql,'count');

  if ( $count <= 0 ) {
    return strtolower($user_id);
  } else {
    # postpend a random string to the user_id...
    $i = mt_rand(1,100);
    return strtolower(getUserID($first_name,$last_name.$i));
  }
}
?>
