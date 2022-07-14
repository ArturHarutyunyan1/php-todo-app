<?php
include 'header.php';
require '../db.php';
$errorMsg = null;

if(isset($_REQUEST['create'])){
    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($con, $name);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $emailCheck = "SELECT * FROM `users` WHERE email LIKE ?";


    $email_check = "SELECT * FROM `users` WHERE email LIKE ?";

    $stmt  = $con -> prepare($email_check);
    $stmt -> execute([$email]);

    $check = $stmt -> fetch();

    if($check){
        $errorMsg = 'The email address is already in use.';            
    }else{
        $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($con, $sql);

        if($result){
            Header("Location: login.php");
        }else{
            $errorMsg = "Someghinda";
        }
    }
}

?>
<form class="input-form" method="post">
    <div class="header">
        <h1>Sign up with your email</h1>
        <p>Already have an account? <a href="login.php">Sign in</a></p>
    </div>
    <div class="col">   
        <input type="text" name="name" placeholder="Full Name" required>
    </div>
    <div class="col">
        <input type="email" name="email" placeholder="Email Address" required>
    </div>
    <div class="col">
        <input type="password" name="password" placeholder="Password" required>
    </div>
    <p class="error">
        <?php echo $errorMsg; ?>
    </p>
    <div class="col">
        <button name="create">Create Account</button>
    </div>
</form>
<?php include 'footer.php'; ?>