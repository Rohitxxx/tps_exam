<?php  
    class DbConnect{
        private $con;
        function connect(){
            $this->con=mysqli_connect("sql101.epizy.com","epiz_29749686","76kVfJclMpmEn","epiz_29749686_tps");
            if(mysqli_errno($this->con)){
                die;
            }else{
                return $this->con;
            }
        }
    }
?>