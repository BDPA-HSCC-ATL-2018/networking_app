<?php
function bdpaChapters($bdpa_chapter_key_sel=null) {
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
<select class="form-control" name="bdpa_chapter_key" id="bdpa_chapter_key" required>
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



function getChapterMembers($bdpa_chapter_key) {
  global $dbh;

  # list of members associated with a chapter..
  $sql =<<<HereDoc
select
  a.user_id,
  a.first_name,
  a.last_name,
  a.email,
  a.current_job,
  a.years_participated,
  a.bdpa_chapter_key,
  b.bdpa_chapter_name
from bdpanet_profiles a
left join bdpanet_bdpa_chapters b on a.bdpa_chapter_key = b.bdpa_chapter_key
where a.bdpa_chapter_key = $bdpa_chapter_key
order by a.first_name asc

HereDoc;

  if ( !$sth = mysqli_query($dbh,$sql) ) { errorHandler(mysqli_error($dbh), $sql); return; }

  if ( mysqli_num_rows($sth) > 0 ) {

    echo <<<HereDoc
<table class="table table-sm table-hover">
<tr>
  <th>User ID</th>
  <th colspan="2">Name</th>
  <th>Email</th>
  <th>Current Job</th>
  <th>Participation</th>
  <th>Chapter</th>
</tr>

HereDoc;

    while ( $row = mysqli_fetch_array($sth) ) {
      foreach ( $row AS $key => $val ) {
        $$key = stripslashes($val);
      }

      echo <<<HereDoc
<tr>
  <td>$user_id</td>
  <td>$first_name</td>
  <td>$last_name</td>
  <td>$email</td>
  <td>$current_job</td>
  <td>$years_participated</td>
  <td>$bdpa_chapter_name</td>
</tr>

HereDoc;
    }

    echo <<<HereDoc
</table>

HereDoc;

  } else {
    echo <<<HereDoc
<p class="alert alert-danger">There are no members for selected BDPA Chapter</p>

HereDoc;
  }
}
