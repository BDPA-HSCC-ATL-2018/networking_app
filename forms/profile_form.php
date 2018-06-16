<?php
	$page_title = "Profile";	
	include_once $_SERVER['DOCUMENT_ROOT'] . "/web-assets/tpl/app_header.php";
?>

    <form action="../index.php?action=profile" method="post" novalidate>

      <div class="card">
        <div class="card-header">My Profile</div>
        <div class="card-body">

          <div class="form-group row">
            <label for="first_name" class="col-md-2 col-form-label">First Name</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="first_name" id="first_name" required>
            </div>
          </div>

          <div class="form-group row">
            <label for "last_name" class="col-md-2 col-form-label">Last Name</label>
            <div class="col-md-6">
              <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for "email" class="col-md-2 col-form-label">Email</label>
            <div class="col-md-6">
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for "phone" class="col-md-2 col-form-label">Phone Number</label>
            <div class="col-md-6">
              <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for "current_job" class="col-md-2 col-form-label">Current Job</label>
            <div class="col-md-6">
              <input type="text" name="current_job" id="current_job" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for "years_participated" class="col-md-2 col-form-label">Years Participated</label>
            <div class="col-md-6">
              <input type="text" name="years_participated" id="years_participated" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for "bdpa_chapter_key" class="col-md-2 col-form-label">BDPA Chapter Name</label>
            <div class="col-md-6">
              <select name="bdpa_chapter_key" class="form-control">
                <option value="2">Atlanta</option>
                <option value="3">Houston</option>
                <option value="4">Los Angeles</option>
		<option value="5">Austin</option>
                <option value="6">Southern Minnesota</option>
                <option value="7">Tri Cities</option>
                <option value="8">Washington D.C</option>
                <option value="9">Detroit</option>
              </select>
            </div>
          </div>
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
