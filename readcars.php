<?php
    //$fileName = readline('Adja meg a beolvasondo file nevet: ');
    require_once('db-tools.php');
    require_once('cars.php');
    $fileName = "car-db.csv";
    $cars = Getcsv($fileName);
    $make = getMakers($cars);

    // $mysqli = new mysqli("localhost", "root", null, "cars");
    // if($mysqli -> connect_errno) {
    //     echo"Nem sikerült csatlakozni a táblához!" . $mysqli -> connect_error;
    //     exit();
    // }
    $makersDbTool = new MakerDbTools();

    echo"connected\n";

    $errors = $makersDbTool->createMaker($make);
    print_r("Errors:");
    foreach($errors as $error){
        print_r($error);
    }

    $makers = $makersDbTool->getAllMakers();
    $makersdb = count($makers);
    echo"$makersdb gyártó van a táblában";
    //$newMaker = $makersDbTool->updateMaker($data);
    //getMaker($mysqli,)
    //$mysqli -> close();

    /*for($i = 0; $i < count($cars); $i++) {
            print_r($cars[$i]);
    }*/

    function getMakers($pcars) {
        $keyMaker = array_search('make', $pcars[0]);
        $make = [];
        foreach($pcars as $idx => $car) {
            if(!is_array($car)){
                continue;
            }
            if ($idx == 0) {
                continue;
            }
            if(!isset($make)){
                $make[] = $car[$keyMaker];
            } else {
                $isIn = false;

                for($i = 0; $i < count($make); $i++){
                    if($car[$keyMaker] == $make[$i]){
                        $isIn = true;
                    }
                }
                if(!$isIn){
                    $make[] = $car[$keyMaker];
                } 
            }
        }
        return $make;
    }

    /*for($i = 0; $i < count($make); $i++) {
        print_r($make[$i]);
    }*/


    function Getcsv($pFileName, $withHeader = true) {
        if(!file_exists($pFileName)) {
            print_r('A megadott file nem letezik (vagy nincs a megfelelo helyen)');
            return false;
        } else {
            $csvFile = fopen($pFileName, 'r');
            $header = fgetcsv($csvFile);
            if($withHeader){
                $lines[] = $header;
            } else {
                $lines = [];
            }
            while (! feof($csvFile)) {
                $line = fgetcsv($csvFile);
                $lines[] = $line;
            }
            fclose($csvFile);
            return $lines;
        }
    }

