<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = $confirm_password = $fname = $lname = $city = $state = $zip= $phone= $address="";
$email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
        $email_err = "Email Invalid";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    $city=$_POST["city"];
    $state=$_POST["state"];
    $zip=$_POST["zip"];

    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        
        $param_fname=$fname;
        $param_lname=$lname;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $param_contact=$phone;
        $param_address= $address.",".$city.",".$state.",".$zip;
        $sql = "INSERT INTO user (fname,lname,email,password,contact,address) VALUES ('$param_fname','$param_lname', '$param_email', '$param_password', $param_contact, '$param_address')";
        if ($link->query($sql) === TRUE) {
            header("location: login.php");
          } else {
            echo "Error: " . $sql . "<br>" . $link->error;
          }
          
        /*if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssis",$param_fname,$param_lname, $param_email, $param_password,$param_contact,$param_address);
            
            // Set parameters
           
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }*/
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="public/css/style2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public\css\register.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>

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
    <title>Register</title>
</head>

<body style="background-color: #deedf0">
    <!-- Navbar --> <div class="top">
        <div class="bar teal card left-align large">
            <a class="bar-item button hide-medium hide-large right padding-large hover-white large teal" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
            <a href="index.html" class="bar-item button padding-large left white">Home</a>
            <a href="index.html" class="bar-item button hide-small left padding-large hover-white">About Us</a>
            <a href="login.php" class="bar-item button hide-small left padding-large hover-white">Sell</a>
        </div>

         <!-- Navbar on small screens -->
        <div id="navDemo" class="bar-block hide hide-large hide-medium large">
            <a href="#about_us" class="bar-item button padding-large">About Us</a>
            <a href="login.php" class="bar-item button padding-large">Sell</a>
           <!--<a href="#" class="bar-item button padding-large">Vendor</a>-->
        </div>
        </div>
   
        <br><br>    
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          
            <h1>Register Here</h1>
            
            <fieldset>
         
              <label for="fname">First Name:</label>
              <input type="text" id="fname" name="fname" placeholder="" required>

              <label for="lname" >Last Name:</label>
              <input type="text" id="lname" name="lname" placeholder="">
              
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required placeholder="abc@xyz.com">
              <span class="invalid-feedback"><?php echo $email_err; ?></span>
              
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" required>
              <span class="invalid-feedback"><?php echo $password_err; ?></span>

              <label for="confirm_password">Confirm Password:</label>
              <input type="password" id="confirm_password" name="confirm_password" required>
              <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>

              <label for="phone">Phone No(+91):</label>
              <input type="tel" pattern="[1-9]{1}[0-9]{9}" id="phone" name="phone" required size="10">

              <label for="address">Address: </label>
              <input type="text" id="address" name="address" required placeholder=""> 
              
              <label for="city"> City: </label>
              <input type="text" id="city" name="city"   required placeholder=""> 
              
              <label for="state">State: </label>
              <input type="text" id="state" name="state" required placeholder="">       
              
              <label for="zip">Zip: </label>
              <input type="zip" id="zip" name="zip" required placeholder="">  
              
        
            </fieldset>
            
         
            
           <input type="submit" class="btn buttonn"value="Sign Up">
          </form>
          
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script>
        // Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("show") == -1) {
                x.className += " show";
            } else {
                x.className = x.className.replace(" show", "");
            }
        }
    </script>
       
        </body>
</html>