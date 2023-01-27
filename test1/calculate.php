<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $output = exec("ruby get_logtime.rb $username 2>&1", $result);
    echo $output;
}
?>

