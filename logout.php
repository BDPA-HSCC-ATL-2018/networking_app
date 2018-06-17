<?php
session_unset();
session_destroy();

echo <<<HereDoc
<div class="alert alert-warning alert-dismissible fade show">
  Loggged out successfully. For your security, you should now close this browser window.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
HereDoc;

loginForm();
