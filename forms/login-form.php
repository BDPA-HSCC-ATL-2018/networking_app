<h1><?php echo $page_title ?></h1>

<form id="login" method="post" action="/networking_app/" class="needs-validation" novalidate>
  <div class="card border-info">
    <div class="card-header">Start Here</div>
    <div class="card-body">
      <div class="alert alert-primary">Please Login / Signup to Connect with other BDPA Members</div>
      <div class="form-group">
        <label for="user_id" class="col-md-2 col-form-label">User ID</label>
        <div class= "col-md-9">
          <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>" required>
          <div class="invalid-feedback">User ID is required</div>
        </div>
      </div>

      <div class="form-group">
        <label for="password" class="col-md-2 col-form-label">Password</label>
        <div class= "col-md-9">
          <input type="password" class="form-control" id="password" name="password" required>
          <div class="invalid-feedback">Password is required</div>
        </div>
      </div>

      <div class="form-group">
        <div class= "col-md-9">
          <input id="w" type="hidden" name="w" value="login"/>
          <button type="submit" class="btn btn-lg btn-success">Login</button> <a href="/networking_app/?w=pw_reset_f">Forgot Password?</a>
          <a class="btn btn-lg btn-outline-primary float-right" href="/networking_app/?w=signup_f">Signup</a>
        </div>
      </div>
      
    </div>
  </div>
</form>
