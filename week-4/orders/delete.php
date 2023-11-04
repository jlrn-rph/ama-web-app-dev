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

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Check if the order_id is set and not empty
            if (isset($_POST["order_id"]) && !empty($_POST["order_id"])) {
                $orderID = $_POST["order_id"];

                try {
                    // Open the database connection
                    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                    // Set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Prepare and execute the deletion query
                    $stmt = $conn->prepare("DELETE FROM orders WHERE orderID = :orderID");
                    $stmt->bindParam(':orderID', $orderID);
                    $stmt->execute();

                    // Check if any rows were affected
                    if ($stmt->rowCount() > 0) {
                        echo "Order with ID $orderID has been deleted successfully.";
                    } else {
                        echo "No order found with the provided ID. Please check the Order ID and try again.";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Please provide the Order ID.";
            }
            // Close the database connection
            $conn = null;
        }
        ?>
        <form action="../pages/delete.html">
            <button type="submit">Back</button>
        </form>
    </div>

</body>

</html>