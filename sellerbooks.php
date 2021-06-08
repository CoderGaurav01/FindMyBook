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
   
    <link rel="stylesheet" href="public\css\style2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="public\css\sellerbooks.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  
    
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

<div class="container=100% card teal" >
  <div class="row align-items-start  "  >
    
    
            <a class="bar-item  hide-medium hide-large right padding-large hover-white large teal" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
           <div class="col-md-1" style="margin: 0%; padding: 0%;">
              <a href="welcome.php" class="bar-item buttonn  hover-white" style="background-color:white; color: black; text-align: center; ">Profile</a>
            </div>
            <div class="col-md-1" style="margin: 0%; padding: 0%;" >
              <a href="sellerbooks.php" class="bar-item buttonn hide-small  hover-white" style="text-align: center;"  >Your Books</a>
            </div>
            <div class="col-md-1 offset-md-9"  >
              <a href="logout.php" class="bar-item buttonn hide-small  hover-white " style="text-align: center;"  >Logout</a>
            </div>
        
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
      <form method="POST" action="book_action.php">
        <input name="book_id" type="hidden" value="<?php echo $rows["id"];?>">
         <button type="submit">Delete</button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel"><u> Edit Book Details:</u></h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div id="myModal" class="modal">
        
          
          <div >
            
        
            <form class="book">
                <span data-dismiss="modal" aria-label="Close">&times;</span>
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
                  <div class="form-group col-md-8">
                    <label for="edition">Edition:</label>
                    <input type="number" class="form-control" id="edition"  style="width: 30%" placeholder="6th" min="1">
                  </div>
                  
                  <br>
                  <div class="form-group col-md-3 ">
                    <label for="semester">Semester:</label>
                    <input type="number" class="form-control" id="semester" placeholder="4" required min="1" max="8" required>
                  </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-10">
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
<!--<script src="sellerbook.js"></script>-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>		