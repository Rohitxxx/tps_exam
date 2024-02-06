<!doctype html>
<html lang="en">
<?php
require_once "./_partials/_head.php";
require_once "./backend/Questions.php";
if(!isset($_SESSION['email'])){
    echo "<script>window.location.href='signup.php'</script>";
}
$question = new Question();
$result = $question->fetchQuestions();
if ($result == false) {
?> <script>
        alert("something went wrong,please contact instructor");
        window.location.href = 'signup.php'
    </script> <?php
            }
$_SESSION['qNo']=1;
                ?>
<script>
    // declaring global variable
    var currentQues=1;
</script>
<title>TPS Exam Portal</title>

<body onload="printUpdatedQuesNo(); startTheTimer();">
    <div class="container center">
        <form action="result.php" method="post" id="examPaper" >
            <h1 class="text-center heading">TPS</h1>
            <span class="d-flex justify-content-between">
                <h4 class="flex-start">Question <span id="currentQues"></span> of 30</h4>
                <h4 class="float-end">Time left : <span id="time">20:00</span> </h4>
            </span>
            <hr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                $i++;
            ?>
                <div  class="ques" id="question<?php echo $i ?>">
                    <span>Question <?php echo "$i: $row[question]" ?></span>
                    <div class="option form-check"><input type="radio" class="form-check-input" value="<?php echo $row['option_a'] ?>" name="optionForQ<?php echo $i ?>"><?php echo $row['option_a'] ?></div>
                    <div class="option form-check"><input type="radio" class="form-check-input" value="<?php echo $row['option_b'] ?>" name="optionForQ<?php echo $i ?>"><?php echo $row['option_b'] ?></div>
                    <div class="option form-check"><input type="radio" class="form-check-input" value="<?php echo $row['option_c'] ?>" name="optionForQ<?php echo $i ?>"><?php echo $row['option_c'] ?></div>
                    <div class="option form-check"><input type="radio" class="form-check-input" value="<?php echo $row['option_d'] ?>" name="optionForQ<?php echo $i ?>"><?php echo $row['option_d'] ?></div>
                </div>
            <?php } ?>

            <!-- <div id="question">Question 1: Which property is used to make display of html flex in css? What is the syntax for the flex property? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed iure necessitatibus cupiditate dolorem asperiores maxime ipsam perferendis repudiandae beatae culpa dolores ea totam rem, autem cumque. Illum ipsa possimus voluptatem, rerum expedita accusantium dolores sapiente assumenda dicta tenetur nobis perspiciatis inventore maiores? Vitae ea esse, amet dignissimos, vel eveniet ipsam, repudiandae veritatis aperiam illum est.</div>
            <div class="option form-check"><input type="radio" class="form-check-input" name="option">display:flex;</div>
            <div class="option form-check"><input type="radio" class="form-check-input" name="option">display:flex-box;</div>
            <div class="option form-check"><input type="radio" class="form-check-input" name="option">diplay:inline;</div>
            <div class="option form-check"><input type="radio" class="form-check-input" name="option">flex:display;</div> -->
            <hr>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" type="button" id="back" onclick="decerementQuesNo();">Back</button>
                <button class="btn btn-primary" type="button" id="next" onclick="incrementQuesNo();">Next</button>
                <input type="submit" class="btn btn-primary" id="submit" name="submit">
                <!-- <input type="submit" class="btn btn-primary form-control" name="submit" value="Submit"> -->
            </div>
        </form>
    </div>
    <?php require_once "./_partials/_scripts.php" ?>
</body>

</html>
<script>
    // showing the current question
    document.getElementById("question<?php echo $_SESSION['qNo'] ?>").style.display="block";
</script>
<script>
    function incrementQuesNo(){
        if(currentQues< <?php echo $result->num_rows ?>){
            currentQues++;
        printUpdatedQuesNo();
        showCurrentQues();
        }
        
    }
    function decerementQuesNo(){
        if(currentQues>1){
            currentQues--;
            printUpdatedQuesNo();
            showCurrentQues();
        }
    }
    function printUpdatedQuesNo(){
        document.getElementById("currentQues").innerHTML=currentQues;
    }
    function showCurrentQues(){
        var queslist=document.getElementsByClassName("ques");
        for(i=0;i< <?php echo $result->num_rows ?> ; i++){
            if(currentQues-1 == i)
                queslist[i].style.display='block';
            else
                queslist[i].style.display='none';
        }
    }
    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var myInterval=setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;
        timer--;
        if(timer<0){
            clearInterval(myInterval);
            document.getElementById('back').style.display='none';
            document.getElementById('next').style.display='none';
            document.getElementById('submit').style.margin='auto';
            document.getElementById('card').style.display='block';
        }
        // if (--timer < 0) {
        //     timer = duration;
        // }
    }, 1000);
    
}

function startTheTimer(){
    var twentyMinutes = 60 * 20,
        display = document.querySelector('#time');
    startTimer(twentyMinutes, display);
}
</script>

 <!-- this is warning message when time's up -->
<div id='card' class='animated fadeIn'>
            <div id='upper-side'>
              
             <i class='fa fa-times'></i>
                <h3 id='status'>
                Time's up!
              </h3>
            </div>
            <div id='lower-side'>
              <p id='message'>
              Time's up! Please submit the test...
              </p>
              <a href='#' id='contBtn' onclick='hide()'>Okay</a>
            </div>
          </div>
          <style>
          
              #card {
            position: fixed;
            width: 320px;
            display: none;
            margin: 40px auto;
            text-align: center;
            font-family: 'Source Sans Pro', sans-serif;
            z-index: 99999;
            top: 20%;
            left: 0;
            right: 0;
            bottom: 0;
          }
          #upper-side {
            padding: 2em;
            background-color: orangered;
            display: block;
            color: #fff;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
          }
          #checkmark {
            font-weight: lighter;
            fill: #fff;
            margin: -3.5em auto auto 20px;
          }#status {
            font-weight: lighter;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1em;
            margin-top: -.2em;
            margin-bottom: 0;
          }#lower-side {
            padding: 2em 2em 5em 2em;
            background: #fff;
            display: block;
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 8px;
          } #message {
            margin-top: -.5em;
            color: orangered;
            letter-spacing: 1px;
          }#contBtn {
            position: relative;
            top: 1.5em;
            text-decoration: none;
            background: orangered;
            color: #fff;
            margin: auto;
            padding: .8em 3em;
            -webkit-box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.21);
            -moz-box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.21);
            box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.21);
            border-radius: 25px;
            -webkit-transition: all .4s ease;
                  -moz-transition: all .4s ease;
                  -o-transition: all .4s ease;
                  transition: all .4s ease;
          }
          #contBtn:hover {
            -webkit-box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.41);
            -moz-box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.41);
            box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.41);
            -webkit-transition: all .4s ease;
                  -moz-transition: all .4s ease;
                  -o-transition: all .4s ease;
                  transition: all .4s ease;
          }
          </style>
          <script>
              function hide(){
                 document.getElementById('card').style.display='none';
              }
          </script>