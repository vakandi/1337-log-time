<?php
    $username = $_POST['username'];
    $output = shell_exec("ruby script/get_logtime.rb " . $username);
    echo $output;
?>

