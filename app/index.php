<?php 

// redirect user wether he is connected or not
if (isset($_SESSION['user_id'])) {
    header('Location: account.php');
}
else {
    header('Location: home.php');
}
