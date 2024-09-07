<?php
include 'connection.php';

try {
    $stmt = $conn->prepare("SELECT * FROM product");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<table border='1' style='border-collapse: collapse;'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Barcode</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>";

    foreach($result as $row) {
        echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
                <td>{$row['price']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['barcode']}</td>
                <td>{$row['created_at']}</td>
                <td>{$row['updated_at']}</td>
                <td>
                    <a href=\"update.php?id={$row['ID']}\">Edit</a> | 
                    <a href=\"delete.php?id={$row['ID']}\">Delete</a>
                </td>
              </tr>";
    }

    echo "</table>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>