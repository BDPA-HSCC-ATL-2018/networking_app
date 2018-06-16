<?php
  include_once "db.php";
  $page_title = "Dashboard";
  include_once $_SERVER['DOCUMENT_ROOT'] . "/web-assets/tpl/app_header.php";
?>

    <div class="card col-md-8">
      <div class="card-header">Chapter Members</div>
      <div class="card-body">
        <?php
	  $bdpa_chapter_key = $_SESSION['bdpa_chapter_key'];
          $sql = <<<SQL
            SELECT * FROM profiles WHERE bdpa_chapter_key = $bdpa_chapter_key;
SQL;
          $chaptersql = <<<CHSQL
            SELECT * FROM bdpa_chapters WHERE bdpa_chapter_key = $bdpa_chapter_key;
CHSQL;
        $result = $conn->query($sql);
        $chapterresult = $conn->query($chaptersql);
		
	while ($row = $result->fetch_assoc()) {
	  echo "Name: " . $row['first_name'] . " " . $row['last_name'] . "<hr>";
        }
	
        ?>
      </div>
    </div>
    <div class="card col-md-4">
      <div class="card-header">My Profile <a href="forms/profile_form.php" style="float: right">Edit</a></div>
      <div class="card-body">
      <?php
        $username = $_SESSION['username'];
        $profilesql = <<<SQL
          SELECT * FROM profiles WHERE user_id="$username";
SQL;
        $profileresult = $conn->query($profilesql);

        while ($row = $profileresult->fetch_assoc()) {
          echo "Username: " . $row['user_id'] .
              "<hr> Email: " . $row['email'] .
              "<hr> Phone: " . $row['phone'] .
              "<hr> Current Job: " . $row['current_job'] .
              "<hr> Years Participated" . $row['years_participated'];
        }
      ?>
      </div>
    </div>

  </div>
  <!-- jQuery first, then Bootstrap JS. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>

</html>
