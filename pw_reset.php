<?php

# get submitted values..
$email = isset($_REQUEST['email']) ? filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL) : null;

if ( empty($email) ) {
  echo <<<HereDoc
<div class="alert alert-danger">Valid email required to continue.</div>

HereDoc;
  pwResetForm();
  return;
}

# validate user exists based on provided email..

$sql =<<<HereDoc
select
  user_id,
  password
from bdpanet_profiles
where email = '$email'

HereDoc;

if ( !$sth = mysqli_query($dbh,$sql) ) { errorHandler(mysqli_error($dbh), $sql); return; }

if ( mysqli_num_rows($sth) > 0 ) {
  # we have a match..

  $new_pw = makeRandompasswd();
  $encrypted_pw = md5($new_pw);

  # update the password in the database..
  $pw_sql =<<<HereDoc
update bdpanet_profiles 
set password='$encrypted_pw' 
where email='$email' 
limit 1

HereDoc;

  if ( !mysqli_query($dbh,$pw_sql) ) {
    errorHandler(mysqli_error($dbh),$sql);
    return;
  }

  while ($row = mysqli_fetch_array($sth) ) {
    foreach ( $row AS $key => $val ) {
      $$key = $val;
    }
    echo <<<HereDoc
<div class="alert alert-success">Login credentials (User ID/Password) <code>$new_pw</code> have been emailed to: $email</div>

HereDoc;
  }
  loginForm();

} else {
  echo <<<HereDoc
<div class="alert alert-danger">Sorry- A user account with that email was not found.</div>

HereDoc;

  pwResetForm();
  return;
}


