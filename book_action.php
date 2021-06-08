<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
$id=$_SESSION["id"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
$bookid=$_POST["book_id"];
$sql = "Delete from books where id=$bookid ";
        if ($link->query($sql) === TRUE) {
            header("location: sellerbooks.php");
          } else {
            echo "Error: " . $sql . "<br>" . $link->error;
          }
          mysqli_close($link);
        }

?>