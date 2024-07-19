<?php
    $uname=$_POST["uname"];
    $pswd = $_POST['psw'];
    
    //Database Connection here
    $con = new mysqli("localhost","root","","test");
    if($con->connect_error) {
        die("Failed to connect:".$con->connect_error);

    }
    else{
        $stmt = $con->prepare("select * from admin where uname = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0) {
           $data = $stmt_result->fetch_assoc();
           if($data['psw'] === $pswd) {
             header("location: index1.php");
           } else{
            echo "<h2> Invalid Username or Password";
           } 
        }
        else{
            echo "<h2> Invalid Username or Password";
           } 
    }  
?>
    