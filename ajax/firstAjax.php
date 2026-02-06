<?php
$data = array(
    array('id' => 1, 'name' => 'John Doe'),
    array('id' => 2, 'name' => 'Jane Smith'),
    array('id' => 3, 'name' => 'Bob Johnson')
);

$jsonData = json_encode($data);
header('Content-Type: application/json');
echo $jsonData;
