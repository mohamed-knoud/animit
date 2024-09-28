<?php 
$cookie_name = "last_watched_episode";
if(isset($_GET['q'])){
    $cookie_value = $_GET['q'];
    setcookie($cookie_name, $cookie_value, time() + 3600*24*365, "/");
}
    
if(isset($_GET['d'])){
    $cookie_value = $_GET['d'];
    setcookie($cookie_name, $cookie_value, time() + 3600*24*365, "/");
}

?>