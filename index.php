<?php
  $page_title = "BDPA Network";
  include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_header.php';
  include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_nav.php';
  include_once $_SERVER['DOCUMENT_ROOT'] . '/networking_app/lib/db.php';
  include_once $_SERVER['DOCUMENT_ROOT'] . '/networking_app/chapter-members.php';

  # this line captures the requested "action", it tells us what to do..
  $action = (isset($_REQUEST['w']) ? $_REQUEST['w'] : null);

  $options = array(
    'profile'       => 'profileAPI',
    'profile_f'     => 'profileForm',
    'signup_f'      => 'profileForm',
    'login'         => 'loginAPI',
    'logout'        => 'logoutAPI',
    'welcome'       => 'welcome',
    'pw_reset_f'    => 'pwResetForm',
    'pw_reset'      => 'pwResetAPI',
    'change_pw'     => 'changePWAPI',
  );

  # check whether we have configured a function for each action we are expecting..

  if (array_key_exists($action, $options)) {
    $function = $options[$action];
    call_user_func($function);
  } else {
    loginForm();
  }

  include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_footer.php';

  function profileInfo() {
    global $dbh;
    include_once __DIR__ . '/profile.php';
  }

  function profileForm() {
    global
      $dbh,
      $user_id,
      $email,
      $first_name,
      $last_name,
      $phone,
      $current_job,
      $bdpa_chapter_key,
      $bdpa_chapter_name,
      $years_participated,
      $event;

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $user_id;
    $event = (isset($_REQUEST['event']) && !empty($_REQUEST['event'])) ? $_REQUEST['event'] : 'new';

    if ( $user_id ) {
      $sql =<<<HereDoc
select
  user_id,
  email,
  first_name,
  last_name,
  phone,
  current_job,
  bdpa_chapter_key,
  years_participated,
  'update' as event
from bdpanet_profiles
where user_id='$user_id'

HereDoc;

      if ( !$sth = mysqli_query($dbh, $sql) ) { errorHandler(mysqli_error($dbh), $sql, 0); return; }

      if ( mysqli_num_rows($sth) > 0 ) {
        while ($row = mysqli_fetch_array($sth)) {
          foreach ($row AS $key => $val) {
            $$key = stripslashes($val);
          }
        }
      }
    }
    include_once __DIR__ . '/forms/profile-form.php';
  }

  # login..
  function loginAPI() {
    global $dbh;
    include_once __DIR__ . '/login.php';
  }

  # logout..
  function logoutAPI() {
    include_once __DIR__ . '/logout.php';
  }

  # save/update profile
  function profileAPI() {
    global $dbh;
    include_once __DIR__ . '/profile.php';
  }

  # welcome..
  function welcome() {
    global $dbh;
    include_once __DIR__ . '/dashboard.php';
  }

  function loginForm() {
    global $dbh, $user_id, $event;

    if ( isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
      welcome();
    } else {
      $page_title = "Welcome";
      include_once __DIR__ . '/forms/login-form.php';
    }
  }

  # password reset form..
  function pwResetForm() {
    global $dbh, $email;
    $page_title = 'Password Reset';
    include_once __DIR__ . '/forms/pw_reset_form.php';
  }

  # password reset API
  function pwResetAPI() {
    global $dbh;
    include_once __DIR__ . '/pw_reset.php';
  }

  # change password API
  function changePWAPI() {
    global $dbh;
    include_once __DIR__ . '/change-password.php';
  }


  function bdpaChapterSW($bdpa_chapter_key_sel=null) {
    global $dbh;
    $sql = <<<HereDoc
select
  bdpa_chapter_key,
  bdpa_chapter_name
from bdpanet_bdpa_chapters
order by bdpa_chapter_name asc
HereDoc;

    if (!$sth = mysqli_query($dbh,$sql)) { errorHandler(mysqli_error($dbh),$sql); return; }

    echo <<<HereDoc
<select class="form-control" name="bdpa_chapter_key" id="bdpa_chapter_key">
  <option></option>
HereDoc;

    while ($row = mysqli_fetch_array($sth)) {
      foreach( $row AS $key => $val ){
        $$key = stripslashes($val);
      }
      # capture incoming selected value..
      $selected = ($bdpa_chapter_key == $bdpa_chapter_key_sel) ? ' selected = "selected"' : null;

      echo <<<HereDoc
    <option value="$bdpa_chapter_key"$selected>$bdpa_chapter_name</option>
HereDoc;
    }
    echo <<<HereDoc
</select>
HereDoc;
  }

?>
