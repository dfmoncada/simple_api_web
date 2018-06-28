<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

if(!isset($_GET['api-key']) || $_GET['api-key'] != 'maiAPIkey'){
    echo json_encode(["response"=>"FAILED", "message"=>"the API key you entered was not correct"]);
    return;
}

$json = [
    ['id'=>1, 'category'=>'all', 'parent'=> '', 'date_created'=>'01-25-2014'],
    ['id'=>2, 'category'=>'sport', 'parent'=> 'all', 'date_created'=>'10-10-2014'],
    ['id'=>3, 'category'=>'basketball', 'parent'=> 'sport', 'date_created'=>'10-16-2015'],
    ['id'=>4, 'category'=>'soccer', 'parent'=> 'sport', 'date_created'=>'12-10-2015'],
    ['id'=>5, 'category'=>'jockey', 'parent'=> 'sport', 'date_created'=>'12-20-2015'],
    ['id'=>6, 'category'=>'school', 'parent'=> 'all', 'date_created'=>'03-11-2016'],
    ['id'=>7, 'category'=>'web_project', 'parent'=> 'school', 'date_created'=>'05-02-2017'],
    ['id'=>8, 'category'=>'web_trends', 'parent'=> 'school', 'date_created'=>'05-02-2017'],
    ['id'=>9, 'category'=>'a11y', 'parent'=> 'school', 'date_created'=>'05-02-2017'],
    ['id'=>10, 'category'=>'portfolio', 'parent'=> 'school', 'date_created'=>'05-02-2017']
];

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $column = 'category';
    if(isset($_GET['column']) && isset($json[0][$_GET['column']])){
        $column = $_GET['column'];
    }
    $json = filter($json, $search, $column);
}

echo json_encode(["response"=>"OK", "values"=>$json]);

function filter($array_objects_json, $search, $property){
    $results = [];    
    for($i = 0; $i <= count($array_objects_json); $i++){
        if(strpos($array_objects_json[$i][$property],  $search) !== false){
            array_push($results, $array_objects_json[$i]);
        }
    }
    return $results;
}
