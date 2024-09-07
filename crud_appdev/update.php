<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $barcode = $_POST['barcode'];

        try {
            $sql = "UPDATE product SET name = :name, description = :description, price = :price, 
                    quantity = :quantity, barcode = :barcode, updated_at = NOW() WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':quantity' => $quantity,
                ':barcode' => $barcode,
                ':id' => $id,
            ]);
            echo "Record updated successfully";

            header("Location: read.php");
            exit;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
        exit;
    } else {
        $stmt = $conn->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<form method="POST" action="">
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($product['description']); ?>" required>
    </div>
    <div>
        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
    </div>
    <div>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
    </div>
    <div>
        <label for="barcode">Barcode:</label>
        <input type="text" id="barcode" name="barcode" value="<?php echo htmlspecialchars($product['barcode']); ?>" required>
    </div>
    <div>
        <button type="submit">Update</button>
    </div>
</form>
