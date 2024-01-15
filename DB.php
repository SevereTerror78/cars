<?php
class DB {
        //const DBTABLE = 'makers';

        protected  $mysqli;

        function __construct($host = 'localhost', $user = 'root', $password = null, $db = 'cars') {
            $this->mysqli = new mysqli($host,$user,$password,$db);
            if ($this->mysqli->connect_errno) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }

        function __destruct(){
            $this->mysqli->close();
        }
}