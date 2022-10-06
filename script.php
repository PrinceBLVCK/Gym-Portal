<?php
    
    session_start();

    $conn = mysqli_connect('localhost', 'root', '', 'sosh_gym');
    
    if(!$conn) alert( 'Error:'. mysqli_connect_error());

    function getUser_info(){

    }

