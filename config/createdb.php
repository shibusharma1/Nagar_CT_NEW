<?php
   //echo "Welcome to the stage where we are ready to connect with database <br>";
   // connecting to database
     $servername = "localhost";
     $username = "root";
     $password = "";

    $conn = mysqli_connect($servername,$username,$password);


     #Create a database 
    $sql = "CREATE DATABASE IF NOT EXISTS NagarDB";
    $res = mysqli_query($conn , $sql);
    echo "<br>";
    //Check for the database creation success
    if($res){
        
        //echo "DB created successfully!!!";
    }
    else{
        
        echo "DB not created successfully because of this error ---->".mysqli_error($conn);
    }  


    

