<?php
// Include config file
require "config.php";
session_start();
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $address = $email = $mobileno = $name = "";
$username_err = $password_err = $confirm_password_err = $email_err = $address_err = $mobileno_err = $pincode = $name_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Passwords must have atleast 8 characters.";
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


    if(empty(trim($_POST["name"]))){
        $name_err = "Please Enter your Name.";
    } else if (!preg_match ("/^[a-zA-z]*$/", $name) ) {
        $name_err = "Only alphabets and whitespace are allowed.";
    }else{
        $name = trim($_POST["name"]);
    }


    $mobileno = $_POST["mobileno"];  
    if (!preg_match ("/^[0-9]*$/", $mobileno)){  
        $mobileno_err = "Only numeric value is allowed.";
    } elseif(strlen(trim($_POST["mobileno"])) < 10){
        $mobileno_err = "Please Enter a Valid Number.";
    }


    $email = $_POST ["email"];  
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
    if (!preg_match ($pattern, $email) ){  
        $email_err = "Email is not valid.";
    }


    if(empty(trim($_POST["address"]))){
        $address_err = "Please Enter your Address.";     
    } else{
        $address = trim($_POST["address"]);
    }



    $pincode = $_POST["pincode"];  
    if (!preg_match ("/^[0-9]*$/", $pincode) ){  
        $pincode_err = "Only numeric value is allowed.";   
    } elseif(empty(trim($_POST["pincode"]))){
        $pincode_err = "Please enter Pincode.";     
    } elseif(strlen(trim($_POST["pincode"])) < 6){
        $pincode_err = "Pincode must have 6 Digits.";
    } else{
        $pincode = trim($_POST["pincode"]);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($name_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($mobileno_err) && empty($address_err) && empty($pincode_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, name, email, mobileno, pincode, address) VALUES (:username, :password, :name, :email, :mobileno, :pincode, :address)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":mobileno", $param_mobileno, PDO::PARAM_STR);
            $stmt->bindParam(":address", $param_address, PDO::PARAM_STR);
            $stmt->bindParam(":pincode", $param_pincode, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_name = $name;
            $param_email = $email;
            $param_mobileno = $mobileno;
            $param_address = $address;
            $param_pincode = $pincode;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}



?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px;padding: 20px;position: relative;left: 40%; }
    </style>
</head>
<body>
    <div class="wrapper" id ="cont">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
              <span class="invalid-feedback"><?php echo $name_err; ?></span>
          </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
             <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
             <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="mobileno" class="form-control <?php echo (!empty($mobileno_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobileno; ?>">
                <span class="invalid-feedback"><?php echo $mobileno_err; ?></span>
            </div>
             <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
                <span class="invalid-feedback"><?php echo $address_err; ?></span>
            </div>
             <div class="form-group">
                <label>Pincode</label>
                <input type="text" name="pincode" class="form-control <?php echo (!empty($pincode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pincode; ?>">
                <span class="invalid-feedback"><?php echo $pincode_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>