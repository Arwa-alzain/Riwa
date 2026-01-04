<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

//API in php to get product from database

include('db.php');

try {
    $sql = 'SELECT * FROM products';
    $result = $conn->query($sql);

    $products = [];

    if($result && $result->num_rows > 0);

    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);

}  catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
}

$conn->close();