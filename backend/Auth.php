<?php
    class Auth{
        private $con;
        function __construct()
        {
            require_once "DbConnect.php";
            $db=new DbConnect();
            $this->con=$db->connect();
        }
        function signup($name,$email,$contact_No){
            if($this->isAlreadyCreated($email)){
                echo "<script>alert('You have already given test')</script>";
            }else{
                $sql="INSERT INTO `users` (`name`, `email`, `contact_No`) VALUES ('$name','$email', '$contact_No')";
            $status=mysqli_query($this->con,$sql);
            if($status>0){
                return true;
            }else{
                return false;
            }
            }
            
        }
        function isAlreadyCreated($email){
            $sql="SELECT * FROM `users` WHERE `email`='$email'";
            $result=mysqli_query($this->con,$sql);
            if($result->num_rows>0)
                return true;
            else
                return false;
        }
        function getUserByEmail($email){
            $sql="SELECT * FROM `users` WHERE `email`='$email'";
            $result=mysqli_query($this->con,$sql);
            if($result->num_rows>0)
                return mysqli_fetch_array($result);
            else
                return false;
        }
    }
?>