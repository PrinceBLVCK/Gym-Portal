<?php
    
    session_start();

    $errors = array('password' => '', 'cpass' => '');
    $email = $password = $cpassword = '';

    if(isset($_POST['reg'])){

        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        
        if(strcmp($password, $cpassword)){
            $errors['cpass'] = 'Password do not match';
        }else{

            $conn = mysqli_connect('localhost', 'root', '', 'sosh_gym');
            
            if(!$conn) alert( 'Error:'. mysqli_connect_error());

            $query = "INSERT INTO users (email_address, password ) VALUES ('$email', '$password')";
            $r = mysqli_query($conn, $query);
            if($r){
                alert("Register Successful");
                header("Location: ./dashboard.php");
            }
        }
        
        
        

    }

    function alert($msg) { 
        // Display the alert box; note the Js tags within echo, it performs the magic
        echo "<script>alert('$msg');</script>"; 
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="jumbotron jumbotron-fluid">
        <div class="container text-light">
          <h1 class="display-4 d-inline p-1 my-2 bg-dark"> Sosh Gymnasium</h1>
          <br>
          <br>
          <p class="lead d-inline p-1 my-2 bg-dark"><strong>Welcome to Soshanguve Local Gymnasium.</strong></p>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form method="post">
                    <div class="form-group">
                        <h1 class="display-6 text-center">Register</h1>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email Address</label>
                      <input type="email" name="email" class="form-control" value="<?php echo $email;?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" value="<?php echo $password;?>" id="exampleInputPassword1" placeholder="Password">
                      <small id="emailHelp" class="form-text text-muted">*Minimum of 6 Characters</small>
                    </div>
                    <div class="form-group">
                        <label for="cpass">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" value="<?php echo $cpassword;?>" id="cpassword" placeholder="Confirm Password">
                        <small id="emailHelp" class=" text-danger form-text "><?php echo $errors['cpass'];?></small>
                        
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="reg" class="btn btn-primary" >Register</button>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6 mt-4">
                           <p class="display-6">Already have an Account? <a href="./">Login</a></p>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>