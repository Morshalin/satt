<?php
// include_once '../config/config.php';
    /*
    * Class Database
    */

    class Database{
        private $host 	= DB_HOST;
        private $user 	= DB_USER;
        private $pass 	= DB_PASS;
        private $dbname	= DB_NAME;

        public $link;
        public $error;

        public function __construct(){
            $this->connectDB();
        }

        private function connectDB(){
            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            mysqli_set_charset($this->link, 'utf8');
            if(!$this->link){
                $this->error = "Connection failed".$this->link->connect_error;
                return false;
            } //end of if
        } //end of connectDB

        // select or read data
        public function select($query){
            $result = $this->link->query($query) or die ($this->link->error.__LINE__);
            if($result->num_rows > 0){
                return $result;
            } else{
                return false;
            } //end of else
        } //end of select

        //insert data
        public function insert($query){
            $insert = $this->link->query($query) or die ($this->link->error.__LINE__);
            if($insert){
                return true;
                exit();
            } else{
                return false;
            die("Error : (".$this->link->errno.")".$this->link->error);
            } //end of else
        } //end of insert

        //custome  Insert data here last inseted id will be returned
        public function custom_insert($query){
             $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
            $last_id =$this->link->insert_id;
                 if($insert_row){
                     return $last_id;
                 } else {
                     return false;
                 }
        }


        //update data
        public function update($query){
            $update = $this->link->query($query) or die ($this->link->error.__LINE__);
            if($update){
                return true;
                exit();
            } else{
                return false;
            die("Error : (".$this->link->errno.")".$this->link->error);
            } //end of else
        } //end of update

        //delete data
        public function delete($query){
            $delete = $this->link->query($query) or die ($this->link->error.__LINE__);
            if($delete){
                return true;
                exit();
            } else{
                return false;
            die("Error : (".$this->link->errno.")".$this->link->error);
            } //end of else
        } //end of delete

        //inserId data
        public function insertId(){
            $insertId = $this->link->insert_id;
            if($insertId){
                return $insertId;
                exit();
            } else{
                return false;
            die("Error : (".$this->link->errno.")".$this->link->error);
            } //end of else
        } //end of delete


    }
?>
