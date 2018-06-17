<form id="profile" method="post" action="/networking_app/" class="needs-validation" novalidate>

<div class="card">
  <div class="card-header bg-info text-white">BDPA Member</div>
  <div class="card-body">

  <p class="alert alert-primary">Create / Update Member Profile <?php if ($user_id) { echo '['. $user_id .']'; } ?><small><br/>All fields are required</small></p>

    <div class="form-group row">
      <label for="first_name" class="col-md-3 col-form-label">First Name</label>
      <div class="col-md-9">
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required/>
        <div class="invalid-feedback">First Name is required</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="last_name" class="col-md-3 col-form-label">Last</label>
      <div class="col-md-9">
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required/>
        <div class="invalid-feedback">Last Name is required</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="email" class="col-md-3 col-form-label">Email</label>
      <div class="col-md-9">
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required/>
        <div class="invalid-feedback">Email is required</div>
      </div>
    </div>

    <?php if ($event == "new") { ?>
    <div class="form-group row">
      <label for="password" class="col-md-3 col-form-label">Set Password</label>
      <div class="col-md-9">
        <input type="password" class="form-control" id="password" name="password" value="" required/>
        <small>8 - 16 characters [with at least 1 lowercase; at least 1 uppercase; at least 1 number; and at least 1 special character]</small>
        <div class="invalid-feedback">Password Requirements: 8 - 16 characters; with at least 1 lowercase; at least 1 uppercase; at least 1 number; and at least 1 special character</div>
      </div>
    </div>
   <?php } ?>

    <div class="form-group row">
      <label for="phone" class="col-md-3 col-form-label">Phone</label>
      <div class="col-md-9">
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="###-###-####" value="<?php echo $phone; ?>" required/>
      </div>
    </div>

    <div class="form-group row">
      <label for="years_participated" class="col-md-3 col-form-label">Current Job</label>
      <div class="col-md-9">
        <input type="text" class="form-control" id="current_job" name="current_job" value="<?php echo $current_job; ?>" required/>
        <div class="invalid-feedback">Current Job is required</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="bdpa_chapter_key" class="col-md-3 col-form-label">BDPA Chapter</label>
      <div class="col-md-9">
        <?php bdpaChapters($bdpa_chapter_key); ?>
        <div class="invalid-feedback">BDPA Chapter is required</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="years_participated" class="col-md-3 col-form-label">HSCC Participation</label>
      <div class="col-md-9">
        <input type="text" class="form-control" id="years_participated" name="years_participated" placeholder="HSCC Years of Participation. e.g. 2005-2007" value="<?php echo $years_participated; ?>" required/>
        <div class="invalid-feedback">Years Participated is required</div>
      </div>
    </div>

    <div class="form-group">
      <input type="hidden" id="w" name="w" value="profile"/>
      <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>"/>
      <input type="hidden" id="event" name="event" value="<?php echo $event; ?>"/>
      <button type="submit" class="btn btn-lg btn-success">Continue</button>
    </div>

  </div>
</div>
</form>
<br/>

<?php if ($event == "update") { include_once $_SERVER['DOCUMENT_ROOT'] . '/networking_app/forms/change-password-form.php'; } ?>
