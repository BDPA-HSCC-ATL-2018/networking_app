<h1><?php echo $page_title ?></h1>

<form id="pw_reset" method="post" action="/networking_app/" class="needs-validation" novalidate>
  <div class="card border-info">
    <div class="card-header">Password Reset</div>
    <div class="card-body">
      <div class="alert alert-primary">Please enter your email below to request a password reset</div>
      <div class="form-group">
        <label for="email" class="col-md-2 col-form-label">Email</label>
        <div class= "col-md-9">
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
          <div class="invalid-feedback">Valid email is required</div>
        </div>
      </div>

      <div class="form-group">
        <div class= "col-md-9">
          <input id="w" type="hidden" name="w" value="pw_reset"/>
          <button type="submit" class="btn btn-lg btn-primary">Reset Password</button>
          <a class="btn btn-lg btn-outline-primary float-right" href="/networking_app/?w=login_f">Login</a>
        </div>
      </div>
      
    </div>
  </div>
</form>
