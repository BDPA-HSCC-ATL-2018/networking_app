<?php
$user_id = (isset($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : null;
$password = (isset($_REQUEST['password'])) ? $_REQUEST['password'] : null;

$password = md5($password);

# authenticate user..
$sql =<<<HereDoc
select
  user_id,
  password
from bdpanet_profiles
where user_id = '$user_id'
and password = '$password'

HereDoc;

if ( !$sth = mysqli_query($dbh,$sql) ) { errorHandler(mysqli_error($dbh), $sql, 0); return; }

if ( mysqli_num_rows($sth) > 0 ) {
  # get user details..

  while ($row = mysqli_fetch_array($sth)) {
    foreach ($row AS $key => $val) {
      $$key = stripslashes($val);
     }

    $_SESSION['user_id'] = $user_id;
  }
  welcome();
} else {
  echo <<<HereDoc
<div class="alert alert-warning alert-dismissible fade show">
  Unable to validate credentials. Please try again
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
HereDoc;
  loginForm();
}
?>

