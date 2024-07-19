<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Add_To_Cart'])) {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $myitems = array_column($_SESSION['cart'], 'Item_Name');
            if (in_array($_POST['Item_Name'], $myitems)) {
                echo "<script>";
                echo "alert('Item Already Added');";
                echo "window.location.href='index.html';";
                echo "</script>";
            }
        } else {
            $_SESSION['cart'] = array();
        }
          
        $count = count($_SESSION['cart']);
        $_SESSION['cart'][$count] = array('Item_Name' => $_POST['Item_Name'],'Price' => $_POST['Price'], 'Quantity' => 1);
        echo "<script>";
                echo "alert('Item Added');";
                echo "window.location.href='index.html';";
                echo "</script>";
    }
}
?>
