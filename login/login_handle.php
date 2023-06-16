<?php
require_once('../class.php');
if (!empty($_POST['username'])) {
    //Hidden form was filled in...
    //Do anything EXCEPT attempt login
    exit;
}
$lh = new configAndConnect();
if ($lh->issetCheck('THE_username') && $lh->issetCheck('THE_password')) {
    $try_login = new doLoginAttempt($_POST['THE_username'], $_POST['THE_password']);
    $result = $try_login->attemptLogin('' . configAndConnect::URL . '/');//Redirect to account page on success
    //echo $result;//Will only show when login was NOT successful
    echo "<meta http-equiv='refresh' content='0;url=index.php?msg={$result}'>";
} else {
    $lh->outputString("Username and Password cannot be empty");
}