<?php $conn = new mysqli('localhost', 'root', '', 'bdpa');

if ($conn->error) {
  echo "This didn't work.";
} else {
  echo "It worked.";
}

?>
