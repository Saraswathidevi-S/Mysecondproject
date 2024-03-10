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

// Fetch product details from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFARI - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .product {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 200px;
            text-align: center;
        }
        .product img {
            max-width: 100%;
            border-radius: 5px;
        }
        .product h3 {
            margin-top: 10px;
            font-size: 18px;
        }
        .product p {
            margin: 10px 0;
            font-size: 16px;
            color: #888;
        }
        .product button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .product button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>SAFARI</h1>
    </header>

    <div class="container">
        <h2>Featured Products</h2>
        <div class="products">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<img src='uploads/" . $row["image"] . "' alt='" . $row["name"] . "'>";
                    echo "<h3>" . $row["name"] . "</h3>";
                    echo "<p>$" . $row["price"] . "</p>";
                    echo "<button>Add to Cart</button>";
                    echo "</div>";
                }
            } else {
                echo "No products found";
            }
            ?>
        </div>
    </div>

    <!-- You can include scripts at the bottom of the body -->
</body>
</html>

<?php
$conn->close();
?>
