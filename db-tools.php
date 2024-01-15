<?php
    /*function createMaker($make,$mysqli){
        $resoult = $mysqli -> query("SELECT COUNT(name) FROM makers");
        $row = $resoult -> fetch_assoc();
        $errors = [];
        if($row <= 0) {
            foreach($make as $maker){
                $insert = $mysqli -> query("INSERT INTO makers (name) VALUES ('$maker')");
                if(!$insert) {
                    $errors[] = $maker;
                }
                echo"$maker\n";
            }
        }
        return $errors;
    }*/

    /*function updateMaker($pMysqli,$pData){
        $makerName = $pData['name'];
        $resoult = $pMysqli -> query("UPDATE makers SET name = $makeName");
        if (!$resoult) {
            echo"Hiba történt a $makerName beszúrása közben";
            return $resoult;
        }
        $maker = getMakerByName($pMysqli,$makeName);
        return $maker;
    }*/

    function getMaker($pMysqli, $pId) {
        $resoult = $pMysqli -> query("SELECT * FROM maker WHERE id=$pId");
        $maker = $resoult -> fetch_assoc();

        return $maker;
    }

    /*function getMakerByName($pMysqli,$pName){
        $resoult = $pMysqli -> query("SELECT * FROM maker WHERE id = $pName");
        $meker = $resoult -> fetch_accos();

        return $maker;
    }*/

    function delMaker($pMysqli, $pId) {
        $resoult = $pMysqli -> querty("DELETE makers WHERE id = $pId");
        return $resoult;
    }

    /*function getAllMakers($pMysqli) {
        $resoult = $pMysqli -> querty("SELECT * FROM makers");
        $makers = $resoult -> fetch_accos();

        return $makers;
    }*/