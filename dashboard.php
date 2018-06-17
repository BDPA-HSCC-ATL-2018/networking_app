<?php
$page_title = "BDPA Net";

if ( isset($_SESSION['user_id']) ) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = null;
}

$sql = <<<HereDoc
select
  a.first_name,
  a.last_name,
  a.phone,
  a.email,
  a.current_job,
  a.bdpa_chapter_key,
  b.bdpa_chapter_name
from bdpanet_profiles a
left join bdpanet_bdpa_chapters b on a.bdpa_chapter_key = b.bdpa_chapter_key
where user_id = '$user_id'

HereDoc;

if ( !$sth = mysqli_query($dbh,$sql) ) { errorHandler(mysqli_error($dbh), $sql, 0); return; }

if ( mysqli_num_rows($sth) > 0 ) {

  # this block happens when we find at least one record for this applicant in the database..

  while ($row = mysqli_fetch_array($sth)) {
    foreach( $row AS $key => $val ) {
      $$key = stripslashes($val);
    }
    # set the user_id in the session..
    $_SESSION['user_id'] = $user_id;

    echo <<<HereDoc

    <div class="card">
      <div class="card-header bg-primary text-white">Welcome $first_name <span class="float-right"><a class="text-white" title="Sign Out" href="/networking_app/?w=logout"><i class="fa fa-sign-out fa-lg"></i></a></div>
        <div class="card-body clickable-row glow" data-href="/networking_app/?w=profile_f">
          <address>
          $first_name $last_name <span class="float-right fa fa-lg fa-pencil"></span><br/>
          <small>$email</small><br/>
          $bdpa_chapter_name<br/>
          </address>
        </div>
    </div><br/>

    <div class="card">
      <div class="card-header">
        <h2 class="float-left">BDPA Network Members</h2>
        <span class="float-right">

HereDoc;

        bdpaChapterSW($bdpa_chapter_key);

    echo <<<HereDoc
        </span>
      </div>
      <div id="chapter_members" class="card-body">
HereDoc;

    getChapterMembers($bdpa_chapter_key);
    echo <<<HereDoc
      </div>
    </div>

  </div>

HereDoc;
  }
} else {

  # profile was not found in the databse, so let us present the profile form (new case):

  $_SESSION['user_id'] = null;
  profileForm();
}



