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
$name=$_POST["name"];
$author=$_POST["author"];
$edition=$_POST["edition"];
$semester=$_POST["semester"];
$subject=$_POST["subject"];
$price=$_POST["price"];
$sql = "INSERT INTO books (name,author,edition,semester,subject,price,user_id) VALUES ('$name','$author', $edition, $semester, '$subject', $price,$id)";
        if ($link->query($sql) === TRUE) {
            header("location: sellerbooks.php");
          } else {
            echo "Error: " . $sql . "<br>" . $link->error;
          }
          mysqli_close($link);
        }
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>FindMyBook</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/books.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


</head>

<body style="background-color:#EAF6F6">
  <div class="top">
    <div class="bar teal card left-align large">
      <!-- <a class="bar-item button hide-medium hide-large right padding-large hover-white large teal" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a> -->
      <a href="index.html" class="bar-item homebtn button padding-large white">Home</a>
    </div>
    <br><br>

    <form class="book" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <h1>Enter Book Details:</h1>
      <br><br>
      <div class="form-row">
        <div class="form-group col-md-11">
          <label for="bname">Name of the Book:</label>
          <input type="text" class="form-control" name="name" id="bname" placeholder="Arthur" required>
        </div>
        <div class="form-group col-md-11">
          <label for="author">Author Name:</label>
          <input type="text" class="form-control" name="author" id="author" placeholder="John Doe" required>
        </div>
      </div>
      <div class="form-group col-md-11">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" name="subject" id="subject" placeholder="Maths" required>
      </div>

      <div class="row">
        <div class="form-group col-md-4">
          <label for="edition">Edition</label>
          <input type="number" class="form-control" name="edition" id="edition" placeholder="6th" min="1">
        </div>
        <div class="form-group col-md-3 ">
          <label for="semester">Semester</label>
          <input type="number" class="form-control" name="semester" id="semester" placeholder="4" required min="1"
            max="8" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="priice">Price</label>
          <input type="text" class="form-control" name="price" id="price" placeholder="₹250" required>
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Add Book</button>
    </form>


</body>

</html>