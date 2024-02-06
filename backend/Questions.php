<?php  
    class Question{
        private $con;
        function __construct()
        {
            require_once "DbConnect.php";
            $db=new DbConnect();
            $this->con=$db->connect();
        }
        function fetchQuestions(){
            $sql="SELECT * FROM `exam_questions`";
            $result=mysqli_query($this->con,$sql);
            if($result==false){
                return false;
            }else{
                return $result;
            }
        }
        function insertResponse($response,$email,$marks){
            $sql="INSERT INTO `attempt_options` (`email`, `exam_id`, `attempted_ans_list`,`marks`) VALUES ('$email', '1', '$response','$marks')";
            $status=mysqli_query($this->con,$sql);
            if($status>0){
                return true;
            }else{
                return false;
            }
        }
    }
?>