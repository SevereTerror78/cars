<?php 
function getCsvData($fileName) {
	if (!file_exists($fileName)) {
		echo "$fileName nem taláható";
		return false;
	}
	$csvFile = fopen($fileName, 'r');
    $lines = [];	
	while (! feof($csvFile)) {
		$line = fgetcsv($csvFile);
		$lines[] = $line;
	}
	fclose($csvFile);
	
	return $lines;
}

function getMakers($csvData)
{
    $idxMaker = array_search('make', $csvData[0]);
    $makers = [];
    $isHeader = true;
    foreach ($csvData as $data) {
        if (!is_array($data)) {
            continue;
        }
        if ($isHeader) {
            $isHeader = false;
            continue;
        }

        $maker = $data[$idxMaker];
        if (!in_array($maker, $makers)) {
            $makers[] = $maker;
        }
    }

    return $makers;
}

function getModels($csvData)
{
    $idxMake = array_search('make', $csvData[0]);
    $idxModel = array_search('model', $csvData[0]);
    $models = [];
    $isHeader = true;
    foreach ($csvData as $data) {
        if (!is_array($data)) {
            continue;
        }
        if ($isHeader) {
            $isHeader = false;
            continue;
        }
        $makeId = $data[$idxMake];
        $modelName = $data[$idxModel];
        $models[] = ['id_make' => $makeId, 'name' => $modelName];
    }
    return $models;
}