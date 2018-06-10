<?php $conn = new mysqli('localhost', 'root', '', 'bdpa');

if ($conn->error) {
  echo "The database connection failed.";
}

?>
