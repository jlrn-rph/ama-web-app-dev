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

        // Define arrays for coffee prices, size prices, and extras prices
        $coffee_prices = [
            "espresso" => 250,
            "latte" => 300,
            "cappuccino" => 350,
            "americano" => 200,
            "mocha" => 400,
        ];

        $size_prices = [
            "small" => 0.00,
            "medium" => 50.0,
            "large" => 80.0,
        ];

        $extras_prices = [
            "sugar" => 5.75,
            "cream" => 10.50,
        ];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $orderID = $_POST["order_id"];

            try {
                // Open the database connection
                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                
                // Set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepare and execute the update query
                $stmt = $conn->prepare("SELECT * FROM orders WHERE orderID = :orderID");
                $stmt->bindParam(':orderID', $orderID);
                $stmt->execute();

                // Fetch the orders
                $result = $stmt->fetch();

                if ($result) {
                    // Retrieve existing values
                    $name = isset($_POST["name"]) && $_POST["name"] !== "" ? $_POST["name"] : $result['name'];
                    $coffeeType = isset($_POST["coffee"]) && $_POST["coffee"] !== "" ? $_POST["coffee"] : $result['coffee_type'];
                    $size = isset($_POST["size"]) && $_POST["size"] !== "" ? $_POST["size"] : $result['size'];
                    $extras = isset($_POST["extras"]) && is_array($_POST["extras"]) ? $_POST["extras"] : explode(", ", $result['extras']);
                    $instructions = isset($_POST["instructions"]) ? $_POST["instructions"] : $result['instructions'];

                    // Calculate the total price
                    $total_price = calculateTotalPrice($coffee_prices, $size_prices, $extras_prices, $coffeeType, $size, $extras);

                    // Update the order details
                    $updateStmt = $conn->prepare("UPDATE orders SET name=:name, coffeeType=:coffeeType, size=:size, extras=:extras, totalPrice=:total_price, instructions=:instructions WHERE orderID=:orderID");
                    $updateStmt->execute(array(
                        ':name' => $name,
                        ':coffeeType' => $coffeeType,
                        ':size' => $size,
                        ':extras' => implode(", ", $extras),
                        ':total_price' => $total_price,
                        ':instructions' => $instructions,
                        ':orderID' => $orderID
                    ));

                    echo "Order details updated successfully!";
                } else {
                    echo "Order not found. Please check the Order ID and try again.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            // Close the database connection
            $conn = null;
        }

        function calculateTotalPrice($coffee_prices, $size_prices, $extras_prices, $coffee_type, $size, $extras)
        {
            $total_price = $coffee_prices[$coffee_type] + $size_prices[$size];

            foreach ($extras as $extra) {
                $total_price += $extras_prices[$extra];
            }

            return $total_price;
        }
        ?>

        <br />
        <form action="../pages/update.html">
            <button type="submit">Back</button>
        </form>
    </div>
</body>

</html>