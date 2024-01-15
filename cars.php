<?php
    class MakerDbTools {
        const DBTABLE = 'makers';

        private  $mysqli;

        function __construct($host = 'localhost', $user = 'root', $password = null, $db = 'cars') {
            $this->mysqli = new mysqli($host,$user,$password,$db);
            if ($this->mysqli->connect_errno) {
                throw new Exception($this->mysqli->connect_errno);
            }
        }

        function __destruct(){
            $this->mysqli->close();
        }

        function createMaker($make){
                $resoult = $this->mysqli->query("SELECT * FROM makers");
                $row = $resoult->fetch_array(MYSQLI_NUM);
                $errors = [];
                if(empty($row)) {
                    foreach($make as $maker){
                        $insert = $this->mysqli->query("INSERT INTO makers (name) VALUES ('$maker')");
                        if(!$insert) {
                            $errors[] = $maker;
                        }
                        echo"$maker\n";
                    }
                }
                return $errors;
        }

        function getAllMakers() {
            $resoult = $this->mysqli->query("SELECT * FROM makers");
            $makers = $resoult->fetch_all(MYSQLI_ASSOC);
    
            return $makers;
        }

        function updateMaker($pData){
            $makerName = $pData['name'];
            $resoult = $this->mysqli->query("UPDATE makers SET name = $makeName");
            if (!$resoult) {
                echo"Hiba történt a $makerName beszúrása közben";
                return $resoult;
            }
            $maker = getMakerByName($makeName);
            return $maker;
        }

        function getMakerByName($pName){
            $resoult = $this->mysqli->query("SELECT * FROM maker WHERE id = $pName");
            $meker = $resoult -> fetch_accos();
    
            return $maker;
        }
    }