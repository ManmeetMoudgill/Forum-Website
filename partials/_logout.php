<?php
session_start();
session_unset();
session_destroy();
error_reporting(E_ALL ^ E_NOTICE); 
header("Location:/NewForumWebsite/index.php?loggedOut=true");






?>