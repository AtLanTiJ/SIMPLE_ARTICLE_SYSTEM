<?php
session_start();
if ($_SESSION['group'] == 'admin') {
 phpinfo();
}else{
    echo "404 Not Found";
}