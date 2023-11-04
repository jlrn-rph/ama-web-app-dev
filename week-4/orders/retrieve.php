<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>☕ Coffee Shop</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <?php
        include "../database/database.php";

        // Check if the request method is POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Retrieve the order details from the database based on the provided orderID
            $orderID = $_POST["order_id"];

            try {
                 // Open the database connection
                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

                // Set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepares an SQL statement for execution
                $stmt = $conn->prepare("SELECT * FROM orders WHERE orderID = :orderID");

                // Bind the value of the variable to the parameter
                $stmt->bindParam(':orderID', $orderID);

                // Executes the prepared statement
                $stmt->execute();

                // Fetch the orders
                $result = $stmt->fetch();

                if ($result) {
                    // Display the retrieved order details
                    echo "<h1> ☕ Coffee Order Details</h1>";
                    echo "<table>";
                    echo "<tr><td>Order ID</td><td>" . $result['orderID'] . "</td></tr>";
                    echo "<tr><td>Name</td><td>" . $result['name'] . "</td></tr>";
                    echo "<tr><td>Coffee Type</td><td>" . $result['coffeeType'] . "</td></tr>";
                    echo "<tr><td>Size</td><td>" . $result['size'] . "</td></tr>";
                    echo "<tr><td>Extras</td><td>" . $result['extras'] . "</td></tr>";
                    echo "<tr><td>Total Price</td><td>₱" . number_format($result['totalPrice'], 2) . "</td></tr>";
                    echo "<tr><td>Instructions</td><td>" . $result['instructions'] . "</td></tr>";
                    echo "</table>";
                } else {
                    // Display an error message if the order ID is not found
                    echo "Order not found. Please check the Order ID and try again.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Close the database connection
        $conn = null;
        ?>

        <br />

        <form action="../pages/retrieve.html">
            <button type="submit">Back</button>
        </form>     
    </div>
</body>

</html>
