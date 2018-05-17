<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "affableBean";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn -> connect_error) {
	die("Connection failed." . $conn->connect_error);
}

$category = "CREATE TABLE category (
id INT PRIMARY KEY,
name VARCHAR(45))";

$product = "CREATE TABLE product (
id INT PRIMARY KEY,
name VARCHAR(45),
price DECIMAL(5.2),
description TINYTEXT,
last_update TIMESTAMP,
category_id INT)";

$ordered_product = "CREATE TABLE ordered_product (
customer_order_id INT,
product_id INT,
quantity SMALLINT)";


$customer_order = "CREATE TABLE customer_order (
id INT PRIMARY KEY,
amount DECIMAL(6.2),
date_created TIMESTAMP,
confirmation_number INT,
customer_id INT)";


$customer = "CREATE TABLE customer (
id INT PRIMARY KEY,
name VARCHAR(45),
email VARCHAR(45),
phone VARCHAR(45),
address VARCHAR(45),
city_region VARCHAR(45),
cc_number VARCHAR(45))";

$error = [];
$tables = [$category, $product, $ordered_product, $customer_order, $customer];

foreach($tables as $k => $sql){
    $query = @$conn->query($sql);

    if(!$query)
       $errors[] = "Table $k : Creation failed ($conn->error)";
    else
       $errors[] = "Table $k : Creation done";
}


foreach($errors as $msg) {
   echo "$msg <br>";
}

$conn->close();
?>
