<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price']; 
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];

    try {
        $sql = "INSERT INTO product (name, description, price, quantity, barcode, created_at, updated_at) 
                VALUES (:name, :description, :price, :quantity, :barcode, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':quantity' => $quantity,
            ':barcode' => $barcode,
        ]);
        echo "New record created successfully";

        header("Location: read.php");
        exit; 
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="">
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Name" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" placeholder="Description" required>
    </div>
    <div>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" placeholder="Price" required>
    </div>
    <div> 
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" placeholder="Quantity" required>
    </div>
    <div>
        <label for="barcode">Barcode:</label>
        <input type="text" id="barcode" name="barcode" placeholder="Barcode" required>
    </div>
    <div>
        <button type="submit">Create</button>
    </div>
</form>
</body>
</html>
