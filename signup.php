<!doctype html>
<html lang="en">
<?php require_once "./_partials/_head.php" ?>
<title>SignUp</title>
<body>
    <div class="container center signup">
        <form action="#" method="post">
            <h2 class="text-center heading">Welcome to the TPS Exam Portal!</h2>
            <h5 class="text-center heading"> Signup and get ready for online exam</h5>
            <hr>
            <input type="text" class="form-control" required placeholder="Your Name" name="name">
            <input type="email" class="form-control" required name="email" placeholder="Your Email">
            <input type="number" class="form-control" required name="contact_No" placeholder="Your Mobile Number">
            <input type="submit" class="btn btn-primary form-control" name="submit" value="Submit">
            <hr >
        </form>
    </div>
    <?php require_once "./_partials/_scripts.php" ?>
</body>

</html>
<?php 
    if(isset($_POST['submit'])){
        require_once "./backend/Auth.php";
        $auth=new Auth();
        if($auth->signup($_POST['name'],$_POST['email'],$_POST['contact_No'])){
            $_SESSION['email']=$_POST['email'];
            $_SESSION['name']=$_POST['name'];
            header("location:instruction.php");
        }
        else{
            ?> <script>alert("Something went wrong please try again")</script> <?php 

        }
    }
?>