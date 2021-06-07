<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$id=$_SESSION["id"];
require_once "config.php";
$sql = "SELECT * FROM books WHERE user_id=$id";
$result = $link->query($sql);
//$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Your books</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="public/css/style2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="public\css\sellerbooks.css">
  
    
    <style>
        body,
        h1, 
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Lato", sans-serif
        }

        .bar,
        h1,
        button {
            font-family: "Montserrat", sans-serif
        }

        .fa-anchor,
        .fa-coffee {
            font-size: 200px
        }
    </style>

<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }
    
    #customers tr:nth-child(even){background-color: #f2f2f2;}
    
    #customers tr:hover {background-color: #ddd;}
    
    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }
    </style>
    

</head>

<body>

    <!-- Navbar -->
    <div class="top">
        <div class="bar teal card left-align medium">
            <a class="bar-item button hide-medium hide-large right padding-large hover-white large teal" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
            <a href="index.html" class="bar-item button padding-large white">Home</a>
            <a href="#about_us" class="bar-item button hide-small padding-large hover-white">About Us</a>
            <a href="login.php" class="bar-item button hide-small padding-large hover-white">Sell</a>
            <!--<a href="#" class="bar-item button hide-small padding-large hover-white">Vendor</a>-->
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" class="bar-block hide hide-large hide-medium large">
            <a href="#about_us" class="bar-item button padding-large">About Us</a>
            <a href="login.php" class="bar-item button padding-large">Sell</a>
           <!--<a href="#" class="bar-item button padding-large">Vendor</a>-->
        </div>
    </div>
   
   
    <br>
    <br>
    
    <h1 style="text-align: center; ">YOUR BOOK(S):</h1>
    
    <br>
 



<table id="customers" style="text-align: center;">
  <tr>
    <th style="text-align: center; ">Book Name</th>
    <th style="text-align: center;">Author</th>
    <th style="text-align: center;">Edition</th>
    <th style="width: 40px ;text-align: center;" >Semester</th>
    <th style="text-align: center;">Subject</th>
    <th style="text-align: center;">Price</th>
    <th style="width: 40px; text-align: center;">Availability</th>
    <th style="text-align: center;">Edit</th>  
   
    
 
  </tr>
 
    
  
  <tr>
    <td>Higher Engineering Mathematics</td>
    <td>Dr.B.S Grewal</td>
    <td>39</td>
    <td>3</td>
    <td>Applied Mathematics</td>
    <td>850</td>
    <td>1</td>
    <td><!-- Trigger/Open The Modal -->
        <button id="myBtn">Edit</button>
        
        <!-- The Modal -->
        </td>
        
        
    </tr>
    <?php 
                while($rows=$result->fetch_assoc())
                {
             ?>
  <tr>
    <td><?php echo $rows["name"];?></td>
    <td><?php echo $rows["author"];?></td>
    <td><?php echo $rows["edition"];?></td>
    <td><?php echo $rows["semester"];?></td>
    <td><?php echo $rows["subject"];?></td>
    <td><?php echo $rows["price"];?></td>
    <td><?php echo $rows["availability"];?></td>
    <td>
      <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input name="name" type="hidden" value="<?php echo $rows["name"];?>">
        <input name="author" type="hidden" value="<?php echo $rows["author"];?>">
        <input name="edition" type="hidden" value="<?php echo $rows["edition"];?>">
        <input name="semester" type="hidden" value="<?php echo $rows["edition"];?>">
        <input name="semester" type="hidden" value="<?php echo $rows["semester"];?>">
        <input name="subject" type="hidden" value="<?php echo $rows["subject"];?>">
        <input name="price" type="hidden" value="<?php echo $rows["price"];?>">
         <button id="myBtn" class="bmt" type="submit">Edit</button>
      </form>
    </td>
  </tr>
 <?php  }?>
</table>
<div class="container">
  <center><div style="margin: 10px;">
    <a href="books.php"><button class="btn btn-primary">ADD BOOK</button></a>
  </div></center>
</div>
<div id="myModal" class="modal">
        
          
          <div >
            
        
            <form class="book">
                <span class="close">&times;</span>
                <h1><u> Edit Book Details:</u></h1>
          
                <br><br>
                <div class="form-row">
                  <div class="form-group col-md-11">
                    <label for="bname">Name of the Book:</label>
                    <input type="text" class="form-control" id="bname" value="<?php $_GET["name"];?>" required>
                  </div>
                  <br>
                  <div class="form-group col-md-11">
                    <label for="author">Author Name:</label>
                    <input type="text" class="form-control" id="author" placeholder="John Doe" required>
                  </div>

                </div>
                <br>
                <div class="form-group col-md-11">
                  <label for="subject">Subject:</label>
                  <input type="text" class="form-control" id="subject" placeholder="Maths" required>
                </div>
    <br>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="edition">Edition:</label>
                    <input type="number" class="form-control" id="edition"  style="width: 20%" placeholder="6th" min="1">
                  </div>
                  
                  <br>
                  <div class="form-group col-md-3 ">
                    <label for="semester">Semester:</label>
                    <input type="number" class="form-control" id="semester" placeholder="4" required min="1" max="8" required>
                  </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="priice">Price:</label>
                      <input type="text" class="form-control" id="price"  style="width: 30%"  placeholder="₹250" required>
                    </div>
                        <br>
                    <div class="form-row " >
                        <div class="form-group">
                          <label for="Availability">Availability:</label>
                          <input  type="number" class="form-control" id="Availability"  style="width: 15%" placeholder=2 required min=1>
                        </div>
                  </div>
                  <br>
                  <button type="submit"  class="btn" style="background-color: #94d0cc;"> Edit Details</button>
                <button type="submit" class="btn"  style="background-color: #eec4c4;"> Remove Book</button>
              </form>
     
          </div>
        
        </div>
<script src="sellerbook.js"></script>
</body>
</html>		