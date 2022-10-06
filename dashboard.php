<?php

    include './script.php';

    $error = array('pi' => '', 'bi' => '');
    $fullname = $surname = $mobile = $gender = $address = ' - ';

    if(!isset( $_SESSION['user'])) logout();

    $data = $_SESSION['user'];

    if(isset($_SESSION['amt'])) $amt = $_SESSION['amt'];
    else $amt = $_SESSION['amt'] = 259.85;


    if(isset($_POST['pay'])){
        $amount = (double)$_POST['amount'];
        $amt = $amt - $amount;

        $_SESSION['amt'] = $amt;
    }

    if(isset($_GET['logout'])){
        logout();
    }

    if(!isset($data['full_name'])) $error['pi'] = 'update';
    else {
        $fullname = $data['full_name'];
        $surname = $data['surname'];
        $mobile = $data['mobile_no'];
        $gender = $data['gender'];
        $address = $data['address'];

    }

    if(isset($_POST['updataUser'])){

        $fullname = $_POST['fullname'];
        $surname = $_POST['surname'];
        $mobile = $_POST['mobile'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        
        $id =$data['id'];
        $q ="UPDATE users
            SET full_name = '$fullname', surname = '$surname', mobile_no ='$mobile', gender='$gender', address='$address'
            WHERE id='$id'";

        if(mysqli_query($conn, $q)){
            $q = "SELECT * FROM users WHERE id='$id'";
            if($r = mysqli_query($conn, $q)){

                $data = mysqli_fetch_assoc($r);

                if(isset($data)){
                    
                    unset($data['password']);
                    $_SESSION['user'] = array_filter($data);
                } 

            }
            // getUser_info();
        }
    }

    function logout(){
        $_SESSION = array();
        session_destroy();
        header("Location: ./");
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
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <nav class="navbar container-fluid navbar-light bg-dark">
        <div class="container">
            <span></span>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-light my-2 my-sm-0" name="logout" type="submit">Logout</button>
            </form>
        </div>    
    </nav>
    <div class="container">
        <div class="jumbotron mt-4">
            <div class="container text-dark">
              <h1 class="display-4 d-inline p-1 my-2"> Sosh Gymnasium</h1>
              <br>
              <br>
              <p class="lead d-inline p-1 my-2"><strong>Welcome to Soshanguve Local Gymnasium.</strong></p>
            </div>
        </div>


        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title">Account</h5>

                <div class="card w-100 border-0">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Personal Details</h6>
                        <p class="card-text mb-0">Full Name: <?php echo $fullname;?></p>
                        <p class="card-text mb-0">Surname: <?php echo $surname;?></p>
                        <p class="card-text mb-0">Email Address: <?php echo $data['email_address'];?></p>
                        <p class="card-text mb-0">Mobile Address: <?php echo $mobile;?></p>
                        <p class="card-text mb-0">Gender: <?php echo $gender;?></p>
                        <p class="card-text mb-0">Physical Address: <?php echo $address;?></p>
        
                        <div class="row">
            
                            <div class="col-md-12 text-right">
                                <button class="float-right btn <?php if(empty($error['pi'])) echo 'btn-primary'; else echo 'btn-danger'; ?> " data-toggle="modal" data-target="#exampleModalCenter">Update</button>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="card w-100 border-0">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Banking Details</h6>
                        <p class="card-text mb-0">Account Holder: -</p>
                        <p class="card-text mb-0">Account Type: -</p>
                        <p class="card-text mb-0">Account Number: -</p>
        
                        <div class="row">
        
                            <div class="col-md-12 text-right">
                                <button class="float-right btn btn-primary">Update</button>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="card w-100 border-0">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Membership Info</h6>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="card-text mb-0">Subscription Type: </p>
                            </div>
                            <div class="col-md">
                                <p class="card-text mb-0">Basic</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="card-text mb-0">Subscription Fee:</p>
                            </div>
                            <div class="col-md">
                                <p class="card-text mb-0">R150</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="card-text mb-0">Current Balance: </p>
                            </div>
                            <div class="col-md">
                                <p class="card-text mb-0">R90</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="card-text mb-0">Next Payment Date: </p>
                            </div>
                            <div class="col-md">
                                <p class="card-text mb-0">05 October 2022</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="card-text mb-0">Next Payment Amount: </p>
                            </div>
                            <div class="col-md">
                                <p class="card-text mb-0">R<?php echo $amt;?></p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="card w-100 border-0">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Payments</h6>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <p class="card-text">Outstanding Payment: </p>
                            </div>
                            <div class="col-md">
                                <p class="card-text">R<?php echo $amt;?></p>
                            </div>
                        </div>
                        <div class="row">
        
                            <div class="col-md-3 h-0"></div>
                            <div class="col-md-6 mt-md-4 text-center">
                                <button class="center-align w-100 btn btn-primary" data-toggle="modal" data-target="#paymodal">Make Payment</button>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Persona Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" name="fullname" class="form-control" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Surname</label>
                    <input type="text" name="surname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mobile No.</label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Gender</label>
                    <select name="gender" id="" class="form-control" required>
                        <option selected disabled>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                </div>
                
                <div class="form-group">
                    <label for="exampleInputPassword1">Physical Address</label>
                    <textarea name="address" class="form-control" required id="" cols="30" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="updataUser" class="btn btn-primary">Save changes</button>
            </div> 
        </form>
        </div>
    </div>
    </div>


    <!--Payment Modal -->
    <div class="modal fade" id="paymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">

                <div class="modal-body">
                
                        <div class="form-group">
                            <label for="exampleInputPassword1">Amount</label>
                            <input type="text" name="amount" class="form-control" placeholder="R200" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="pay" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
        
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>