<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "affableBean";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn -> connect_error) {
	die("Connection failed." . $conn->connect_error);
}
$fk_product_category = "ALTER TABLE product
    ADD CONSTRAINT fk_product_category
    FOREIGN KEY (category_id)
    REFERENCES category(id)";

$fk_ordered_product_product = "ALTER TABLE ordered_product
    ADD CONSTRAINT fk_ordered_product_customer_order
    FOREIGN KEY (customer_order_id)
    REFERENCES customer_order(id)";

$fk_ordered_product_customer_order = "ALTER TABLE ordered_product
    ADD CONSTRAINT fk_ordered_product_product
    FOREIGN KEY (product_id)
    REFERENCES product(id)";

$fk_customer_order = "ALTER TABLE customer_order
    ADD CONSTRAINT fk_customer_order_customer
    FOREIGN KEY (customer_id)
    REFERENCES customer(id)";

$fk = [$fk_product_category, $fk_ordered_product_product, $fk_ordered_product_customer_order, $fk_customer_order];

$error = [];

foreach($fk as $k => $sql){
    $query = @$conn->query($sql);

    if(!$query)
       $errors[] = "Forgien Key $k : Error ($conn->error)";
    else
       $errors[] = "Forgien Key $k : Added";
}


foreach($errors as $msg) {
   echo "$msg <br>";
}



$conn -> close();
?>