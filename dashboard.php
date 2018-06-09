<?php
  session_start();
  include_once "db.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Dashbaord</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container-fluid">
    <div class="card col-md-8">
      <div class="card-header">Chapter Members</div>
      <div class="card-body">
        <?php
          $sql = <<<SQL
            SELECT * FROM profiles WHERE bdpa_chapter_key = 2;
SQL;
          $chaptersql = <<<SQL
            SELECT * FROM bdpa_chapters WHERE bdpa_chapter_key = 2;
SQL;
        $result = $conn->query($sql);
        $chapterresult = $conn->query($chaptersql);

        $x = 0;

        $row = $result->fetch_assoc();
        echo $row['first_name'];


        while ($x < $result->num_rows) {
          echo <<<PERSON

PERSON;
          $x++;
        }
        ?>
      </div>
    </div>
    <div class="card col-md-4">
      <div class="card-header">My Profile <a href="forms/profile_form.php" style="float: right">Edit</a></div>
      <div class="card-body">

      </div>
    </div>

  </div>
  <!-- jQuery first, then Bootstrap JS. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>

</html>
