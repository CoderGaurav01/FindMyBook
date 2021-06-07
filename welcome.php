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
$sql = "SELECT * FROM user WHERE id=$id";
$result = $link->query($sql);
$data = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome User</title>
  <style>
           section
              {
                text-align: right;
                margin : 10px;
             
               }

            </style>
  
 
  <link rel="stylesheet" href="C:\wamp64\www\FindMyBook\public\css\welcome.css">
<link rel="stylesheet" href="public/css/style2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="public/css/welcome.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
   <div class="bar teal card left-align medium container=100%">
    <div class="row">
           <!--  <a class="bar-item button hide-medium hide-large right padding-large hover-white large teal" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a> -->
           <div class="col-md-1"  >
            <a href="index.html" class="bar-item button white homebtn">Home</a>
          </div>
          <div class="col-md-1"  >
            <a href="sellerbooks.php" class="bar-item button " style="left: 0px;">Books</a>
          </div>
          
           <div class="col order-1 right">
           
            <section >
                    

                <i class="fa fa-user" aria-hidden="true"></i>
                <select class="right" name="profile" id="profile">
                <a href="welcome.php"><option value="profile"> Profile</option></a>
                <option value="Books"><a href="sellerbooks.php">Your Books</a></option> 
                <a href="logout.php"><option value="change-profile">Log Out</option></a>
              </select>
            </section>
              </div>
        </div>
            <!--<a href="#" class="bar-item button hide-small padding-large hover-white">Vendor</a>-->
        </div>
   <br>
   <br>

 <div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $data["fname"]." ".$data["lname"]?></h4>
                     
                    </div>
                  </div>
                </div>
              </div>
            <!--   <div class="card mt-3">
                
              </div> -->
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $data["fname"]." ".$data["lname"]?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $data["email"]?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $data["contact"]?>
                    </div>
                  </div>
                  <hr>
                
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $data["address"]?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="  btn btn-primary  " data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="#">Edit</a>
                      
                      
                      
                      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Update Details </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <fieldset>
         
                                <label for="name">First Name:</label>
                                <input type="text" id="name" name="user_name" placeholder="Johny" required>
                  
                                <label for="name" >Last Name:</label>
                                <input type="text" id="name" name="user_name" placeholder="Christian">
                                
                                <label for="mail">Email:</label>
                                <input type="email" id="mail" name="user_email" required placeholder="abc@xyz.com">
                                
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="user_password">
                  
                                <label for="phone">Phone No(+91):</label>
                                <input type="tel" id="phone" name="phone" required size="10" >
                  
                                <label for="address">Address: </label>
                                <input type="text" id="address" name="address" required placeholder="1234 Main S"> 
                                
                                <label for="address"> City: </label>
                                <input type="city" id="address" name="address"   required placeholder="Chicago">
                                
                                
                                <label for="address">State: </label>
                                <input type="state" id="address" name="address" required placeholder="California">       
                                <br>
                                <label for="address">Zip: </label>
                                <input type="zip" id="address" name="address" required placeholder="90011">  
                          
                              </fieldset>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary">Update</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<!--  -->


            </div>
          </div>

        </div>
    </div>
    
<script src="">public/js/welcome.js</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>