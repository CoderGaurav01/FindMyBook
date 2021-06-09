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
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Results</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="public/css/style2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="public\css\display.css">
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

  <div class="container=100% card teal" >
    <div class="row align-items-start  "  >
      
      
              <a class="bar-item  hide-medium hide-large right padding-large hover-white large teal" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
             <div class="col-md-1" style="margin: 0%; padding: 0%;">
                <a href="index.html" class="bar-item buttonn  hover-white" style="background-color:white; color: black; text-align: center; ">Home</a>
              </div>
              <div class="col-md-1" style="margin: 0%; padding: 0%;" >
                <a href="index.html" class="bar-item buttonn hide-small  hover-white" style="text-align: center;"  >About Us</a>
              </div>
              <div class="col-md-1" style="margin: 0%; padding: 0%;" >
                <a href="login.php" class="bar-item buttonn hide-small  hover-white" style="text-align: center;padding-left:0px ;"  >Sell</a>
              </div>
              
    </div>
  </div>
     
   
    <br>
    <br>
    
    <h1 style="text-align: center;">SEARCH RESULT(S):</h1>
    
    <br>
 



<table id="customers">
  <tr>
    <th>Book Name</th>
    <th>Author</th>
    <th>Edition</th>
    <th>Semester</th>
    <th>Subject</th>
    <th>Price</th>
    <th>Seller Details</th>
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
    <td>
      
      <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $rows["id"];?>">
      View Seller Details
      </button>
  
   <!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $rows["id"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seller Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-10">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Name:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <h6><?php echo $rows["fname"]." ".$rows["lname"];?></h6>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
               <h6> <?php echo $rows["email"];?></h6>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
             <h6><?php echo $rows["contact"];?></h6>
                </div>
              </div>
              <hr>
            
              <div class="row">
                <div class="col-sm-4">
                  <h6 class="mb-0">Address:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                <?php echo $rows["address"];?>
                </div>
              </div>
      </div>
      
  </div>
</div>
    </td>
  </tr>
  
 <?php }?>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>