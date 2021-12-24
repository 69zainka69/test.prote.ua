<?php

    $host="127.0.0.1";
    $port=3306;
    $socket="";
    $user="root";
    $password="RooT";
    $dbname="prote";
    
    $con = new mysqli($host, $user, $password, $dbname)
    	or die ('Could not connect to the database server' . mysqli_connect_error());
    $con->set_charset("utf8");
    
    $query = "SELECT absnum, title FROM articles limit 10";
    
    
    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($field1, $field2);
        while ($stmt->fetch()) {
            printf("<p>%s, %s\n", $field1, $field2);
        }
        $stmt->close();
    }
    
    $con->close();