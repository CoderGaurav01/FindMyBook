<?php
// Initialize the session
session_start();
require_once "config.php"; 
$method=$_POST["method"];
if($method=="search"){
    $name=$_POST["book_name"];
    $sql="SELECT * FROM books,user where books.name LIKE CONCAT('%','$name','%') AND books.user_id=user.id";
}
else if($method=="search2"){
    $author=$_POST["author"];
    $sql="SELECT * FROM books,user where books.author LIKE CONCAT('%','$author','%') AND books.user_id=user.id";
}
else if($method=="yes"){
    $semester=$_POST["semester"];
    $subject=$_POST["subject"];
    $sql="SELECT * FROM books,user where books.subject LIKE CONCAT('%','$subject','%') AND books.semester=$semester AND books.user_id=user.id";
}
else{
    header("location: search.html");
}
$result = $link->query($sql);
//$data = $result->fetch_assoc();
?>
