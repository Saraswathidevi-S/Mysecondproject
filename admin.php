<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "02091431";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    // Check if file has been uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Move uploaded file to the designated directory
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Insert product details into the database
            $sql = "INSERT INTO products (name, image, price, stock) VALUES ('$name', '$image', $price, $stock)";
            if ($conn->query($sql) === TRUE) {
                echo "Product added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Add Product</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price"><br><br>
        <label for="stock">Stock:</label><br>
        <input type="text" id="stock" name="stock"><br><br>
        <label for="image">Product Image:</label><br>
        <input type="file" id="image" name="image"><br><br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>
