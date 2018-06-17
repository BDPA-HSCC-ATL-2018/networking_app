<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Profile</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container-fluid">
    <div class="card">
        <div class="card-header">My Profile</div>
        <div class="card-body">
          <form action="../index.php?action=signup" method="post" novalidate>
            <div class="form-group">
            <label for "first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" needsvalidation>
            <label for "last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" needsvalidation>
            <label for "email">Email</label>
            <input type="text" name="email" id="email" class="form-control" needsvalidation>
            <label for "phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control" needsvalidation>
            <label for "current_job">Current Job</label>
            <input type="text" name="current_job" id="current_job" class="form-control" needsvalidation>
            <label for "years_participated">Years You Participated</label>
            <input type="text" name="years_participated" id="years_participated" class="form-control" needsvalidation>
            <label for "bdpa_chapter_name">BDPA Chapter</label>
            <input type="text" name="bdpa_chapter_name" id="bdpa_chapter_name" class="form-control" needsvalidation><!--TODO validation-->
          <br>
            <input type="submit" class="btn btn-primary form-control">
            </div>
          </form>
      </div>
    </div>
  </div>
  <!-- jQuery first, then Bootstrap JS. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>

</html>
