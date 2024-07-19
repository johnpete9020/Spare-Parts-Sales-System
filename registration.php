<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"]; // <-- Added semicolon here
    $surname = $_POST["surname"];
    $uname = $_POST["uname"];
    $pswd = $_POST['psw'];
    $no= $_POST["no"];

    // Database Connection here
    $con = new mysqli("localhost", "root", "", "test");
    if ($con->connect_error) {
        die("Failed to connect:" . $con->connect_error);
    } else {
        // Prepare the INSERT statement
        $stmt = $con->prepare("INSERT INTO registration (name, surname, uname, psw, no) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $surname, $uname, $pswd, $no); // <-- Changed "ss" to "sssss"

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to a success page
            header("location: login.html");
        } else {
            // Handle errors if the insertion fails
            echo "<h2>Failed to register user.</h2>";
        }
        $stmt->close(); // Close the statement
        $con->close(); // Close the connection
    }
}
?>
