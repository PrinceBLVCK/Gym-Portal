<?php

    include './script.php';

    $errors = array('email'=>'', 'pass'=>'', 'log'=>'');
    $email = $password = '';

    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)){
            $errors['email'] = 'Email cannot be empty';
        }
        else{
            $errors['email'] = '';
        }
        if(empty($password)){
            $errors['pass'] = 'Password cannot be empty';
        }
        else{
            $errors['pass'] = '';
        }


        try{

            if(!array_filter($errors)){
                $q = "SELECT * FROM users WHERE email_address='$email' AND  password='$password'";

                if($r = mysqli_query($conn, $q)){

                    $data = mysqli_fetch_assoc($r);

                    if(isset($data)){
                        unset($data['password']);
                        $_SESSION['user'] = array_filter($data);
                        header('Location: ./dashboard.php');
                    } 
                    else $errors['log'] = 'Incorrect Email or Password';

                }

            }

        }
        catch(Exception $e){
            alert('Error: '. $e->getMessage());
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
          <h1 class="display-5 d-inline p-1 my-2 bg-dark"> Sosh Gymnasium</h1>
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
                        <h1 class="display-7 text-center">Login</h1>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" name="email" value="<?php echo $email;?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      <small id="emailHelp" class=" text-danger"><?php echo $errors['email'];?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                      <small id="emailHelp" class=" text-danger"><?php echo $errors['pass'];?></small>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="login" >Login</button>
                        </div>
                        <div class="col-12">
                            <small id="emailHelp" class=" text-danger"><?php echo $errors['log'];?></small>
                        </div>
                    </div>
                    <div class="row mt-4 p-2">
                        <div class="col-6">
                            <a href="">Forgot Password?</a>
                        </div>
                        <div class="col-6 text-right">
                            No Account? <a href="./reg.php">Register</a>
                        </div>
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