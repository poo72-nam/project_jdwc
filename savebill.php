<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "medix";

$conn = new mysqli($host,$user,$password,$database);
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

// get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// customer data
$name = mysqli_real_escape_string($conn, $data['customer']['name']);
$phone = mysqli_real_escape_string($conn, $data['customer']['phone']);
$date = mysqli_real_escape_string($conn, $data['customer']['date']);

// insert bill
mysqli_query($conn, "INSERT INTO bills (customer_name, phone_no, billing_date)
VALUES ('$name','$phone','$date')") or die("Bill insert error: ".mysqli_error($conn));

$bill_id = mysqli_insert_id($conn);

// insert items
foreach($data['items'] as $item){
    $product = mysqli_real_escape_string($conn, $item['medicine']);
    $qty = (int)$item['quantity'];
    $price = (float)$item['price'];
    $gst = (float)$item['gst'];

    mysqli_query($conn, "INSERT INTO bill_items 
    (bill_id, medicine_name, qty, price, gst)
    VALUES ($bill_id,'$product',$qty,$price,$gst)")
    or die("Item insert error: ".mysqli_error($conn));
}

echo "success";
?>