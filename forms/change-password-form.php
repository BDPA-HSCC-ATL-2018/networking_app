<form id="change_pw" method="post" action="/networking_app/" class="needs-validation" novalidate>

<div class="card">
  <div class="card-header">Change Pasword <small>(optional)</small></div>
  <div class="card-body">

    <div class="form-group row">
      <label for="c_password" class="col-md-3 col-form-label">Current Password</label>
      <div class="col-md-9">
        <input type="password" class="form-control" id="c_password" name="c_password" value="" required/>
        <div class="invalid-feedback">Please enter current password</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="n_password" class="col-md-3 col-form-label">New Password</label>
      <div class="col-md-9">
        <input type="password" class="form-control" id="n_password" name="n_password" value="" required/>
        <small>8 - 16 characters [with at least 1 lowercase; at least 1 uppercase; at least 1 number; and at least 1 special character]</small>
        <div class="invalid-feedback">Password Requirements: 8 - 16 characters; with at least 1 lowercase; at least 1 uppercase; at least 1 number; and at least 1 special character</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="v_password" class="col-md-3 col-form-label">Verify Password</label>
      <div class="col-md-9">
        <input type="password" class="form-control" id="v_password" name="v_password" placeholder="must match new password above" value="" required/>
        <div class="invalid-feedback">Please type new password here to verify</div>
      </div>
    </div>

    <div class="form-group">
      <input type="hidden" id="w" name="w" value="change_pw"/>
      <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>"/>
      <input type="hidden" id="event" name="event" value="update"/>
      <button type="submit" class="btn btn-lg btn-primary">Update Password</button>
    </div>

  </div>
</div>

</form>
