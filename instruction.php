<!doctype html>
<html lang="en">
<?php require_once "./_partials/_head.php";
if(!isset($_SESSION['email'])){
    echo "<script>window.location.href='signup.php'</script>";
}
?>

<title>Instructions</title>
<body>
    <div class="container center signup">
        <form action="index.php" method="post">
            <h2 class="text-center heading">Welcome To The TPS Exam Portal!</h2>
            <h5 class="text-center heading">-: Exam Instructions :-</h5>
            <hr>
            <ol>
                <li>This test contains 30 Multiple  Choice Questions each carrying 1 marks, 
                     you are required to choose the correct option.</li>
                <li>No negative markings will be there.</li>
                <li>Time Duration- <span class="text-danger">20 minutes.</span></li>
            </ol>
            <h2 class="text-center">Best of Luck!</h2>
            <input type="submit" class="btn btn-primary form-control" name="submit" value="Start the test!">
            <hr >
        </form>
    </div>
    <?php require_once "./_partials/_scripts.php" ?>
</body>

</html>