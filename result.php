<!doctype html>
<html lang="en">
<?php
    require_once "./_partials/_head.php";
    require_once "./backend/Auth.php";
    require_once "./backend/Questions.php";
    $questions=new Question();
    $auth=new Auth();
?>
<title>Congratulations!!!</title>
<body>
    <div class="container center signup">
        <form action="index.php" method="post">
            <h2 class="text-center heading">Congratulations!!!</h2>
            <h2 class="text-center heading"><?php echo $_SESSION['name'] ?></h2>
            <hr>
            
            <h3 class="text-center heading">You have scored</h3>
            <h1 class="text-center circle " ><span id="result"></span>/30</h1>
            <h3 class="text-center">Take the screenshot of this screen and send it to the official Whatsapp Number <span class='text-danger'>9616969636</span>.</h3>
            <h3 class="text-center">Our team will contact you soon as if you will be shortlisted for the next Round.</h3>
            <hr >
            <a href="signup.php" class="btn btn-primary" style="width: fit-content; margin:auto">Home</a>
        </form>

    </div>
    <?php require_once "./_partials/_scripts.php" ?>
</body>
</html>
<?php 
    if(isset($_POST['submit'])){
        include_once './backend/Questions.php';
        $questions=new Question();
        $marks=0;
        if($result=$questions->fetchQuestions()){
            foreach($_POST as $response){
                if($row=mysqli_fetch_array($result)){
                    if(strcmp($response,$row['answer'])==0){
                        $marks++;
                        // echo $response.$row['answer'];
                    }
                }
            }
            if($questions->insertResponse(json_encode($_POST),$_SESSION['email'],$marks)){
                // echo "<script>alert('report cart sent to recruiter')</script>";
            }else{
                echo "<script>alert('report cart not send to recruiter, kindly contact take screenshot of issuse and contact us')</script>";
            }
            // print_r($_POST);
            echo "<script>document.getElementById('result').innerHTML='$marks'</script>";
            session_destroy();
        }else{
            echo "<script>window.location.href='signup.php'</script>";
        }
    }else{
        echo "<script>window.location.href='signup.php'</script>";
    }
?>