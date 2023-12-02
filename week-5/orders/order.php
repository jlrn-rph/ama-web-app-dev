<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>☕ Coffee Shop</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php
    /**
     * Displays the order summary, including customer details, coffee order details, jokes, and passwords if applicable.
     * Generates a receipt content based on the order details and saves it to a text file.
     */
    function displayOrderSummary()
    {
        // Check if the request method is POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Display the order summary section
            echo "<div class='summary'>";
            echo "<h2>📝 Order Summary</h2>";

            // Define the prices for different coffee types, sizes, and extras
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

            // Sanitize the input values
            $name = htmlspecialchars($_POST["name"]);
            $coffeeType = htmlspecialchars($_POST["coffee"]);
            $size = htmlspecialchars($_POST["size"]);
            $instructions = htmlspecialchars($_POST["instructions"]);

            // Extract the user input details
            $coffee_type = $_POST["coffee"];
            $size = $_POST["size"];
            $extras = isset($_POST["extras"]) ? $_POST["extras"] : [];

            // Calculate the total price
            $total_price = calculateTotalPrice($coffee_prices, $size_prices, $extras_prices, $coffee_type, $size, $extras);

            // Display the detailed order information
            displayOrderDetails($name, $coffee_prices, $size_prices, $extras_prices, $coffee_type, $size, $extras, $total_price);

            // Display jokes and passwords based on the total price
            displayJokeAndPassword($coffee_type, $_POST["name"], $total_price);

            // Generate the receipt content based on the order details
            $receiptContent = generateReceiptContent($name, $coffeeType, $coffee_prices, $size, $size_prices, $extras, $extras_prices, $total_price, $instructions);

            // Save the receipt content to a text file
            saveReceiptToFile($receiptContent);

            // Insert order details into the database
            insertOrderToDatabase($name, $coffeeType, $size, $total_price, $instructions, $extras);


            // Close the order summary section
            echo "</div>";
        }
    }


    /**
     * Calculates the total price of the coffee order, including coffee type, size, and any selected extras.
     * 
     * @param array $coffee_prices The array containing the prices of different coffee types
     * @param array $size_prices The array containing the prices of different sizes
     * @param array $extras_prices The array containing the prices of different extras
     * @param string $coffee_type The type of coffee ordered
     * @param string $size The size of the coffee ordered
     * @param array $extras The selected extras for the coffee
     * 
     * @return float The total price of the coffee order
     */
    function calculateTotalPrice($coffee_prices, $size_prices, $extras_prices, $coffee_type, $size, $extras)
    {
        $total_price = $coffee_prices[$coffee_type] + $size_prices[$size];

        // Using Foreach
        foreach ($extras as $extra) {
            $total_price += $extras_prices[$extra];
        }

        // // Using for loop
        // for ($i = 0; $i < count($extras); $i++) {
        //     $total_price += $extras_prices[$extras[$i]];
        // }

        // Using while loop
        // $index = 0;
        // while ($index < count($extras)) {
        //     $total_price += $extras_prices[$extras[$index]];
        //     $index++;
        // }

        // // Using do-while loop
        // $index = 0;
        // do {
        //     $total_price += $extras_prices[$extras[$index]];
        //     $index++;
        // } while ($index < count($extras));

        return $total_price;
    }

    /**
     * Displays the details of the coffee order in a table format.
     * 
     * @param string $name The name of the customer
     * @param array $coffee_prices The array containing the prices of different coffee types
     * @param array $size_prices The array containing the prices of different sizes
     * @param array $extras_prices The array containing the prices of different extras
     * @param string $coffee_type The type of coffee ordered
     * @param string $size The size of the coffee ordered
     * @param array $extras The selected extras for the coffee
     * @param float $total_price The total price of the order
     */
    function displayOrderDetails($name, $coffee_prices, $size_prices, $extras_prices, $coffee_type, $size, $extras, $total_price)
    {
        echo "<table>";

        // Display the customer's name
        echo "<tr><td>Name</td><td>" . htmlspecialchars($name) . "</td></tr>";

        // Display the type of coffee ordered along with its price
        echo "<tr><td>Coffee Type</td><td>" . htmlspecialchars($coffee_type) . " (₱" . number_format($coffee_prices[$coffee_type], 2) . ")</td></tr>";

        // Display the size of the coffee ordered along with its price
        echo "<tr><td>Size</td><td>" . htmlspecialchars($size) . " (₱" . number_format($size_prices[$size], 2) . ")</td></tr>";

        // Check if any extras were selected and display them along with their total price
        if (!empty($extras)) {
            echo "<tr><td>Extras:</td><td>" . implode(", ", $extras) . " (₱" . number_format(array_sum(array_intersect_key($extras_prices, array_flip($extras))), 2) . ")</td></tr>";
        }

        // Display the total price of the order
        echo "<tr><td>Total Price</td><td>₱" . number_format($total_price, 2) . "</td></tr>";

        // Display any special instructions provided by the customer
        echo "<tr><td>Special Instructions</td><td>" . htmlspecialchars($_POST["instructions"]) . "</td></tr>";

        echo "</table>";
    }

    /**
     * Displays a joke and password based on the coffee type and total price.
     * 
     * @param string $coffee_type The type of coffee ordered
     * @param string $name The name of the customer
     * @param float $total_price The total price of the order
     */
    function displayJokeAndPassword($coffee_type, $name, $total_price)
    {
        // Check if the coffee type is not espresso
        if ($coffee_type !== "espresso") {
            // Display a greeting with the customer's name
            echo "Hey, " . htmlspecialchars($name) . "!";
            // Display a coffee-related joke
            echo "<p>Here's a joke for you: Why did the coffee file a police report? It got mugged!</p>";
        }

        // Check the total price to determine the password to be displayed
        if ($total_price > 250 && $total_price < 350) {
            // Display the password for the CR
            echo "<p>Password for the CR: coffee123</p>";
        } elseif ($total_price >= 350) {
            // Display the password for Wi-Fi
            echo "<p>Password for Wi-Fi: mocha456</p>";
        }
    }

    /**
     * Generates the content for the receipt based on the provided parameters.
     * 
     * @param string $name The name of the customer
     * @param string $coffeeType The type of coffee ordered
     * @param array $coffee_prices Array containing the prices of different coffee types
     * @param string $size The size of the coffee ordered
     * @param array $size_prices Array containing the prices of different coffee sizes
     * @param array $extras Array containing the selected extras
     * @param array $extras_prices Array containing the prices of different extras
     * @param float $total_price The total price of the order
     * @param string $instructions Any special instructions provided
     * @return string The content of the receipt
     */
    function generateReceiptContent($name, $coffeeType, $coffee_prices, $size, $size_prices, $extras, $extras_prices, $total_price, $instructions)
    {
        // Initialize the receipt content with a title and separator
        $receiptContent = "Order Summary\n";
        $receiptContent .= "-----------------\n";

        // Add customer name to the receipt content
        $receiptContent .= "Name: " . $name . "\n";

        // Add coffee type with its price to the receipt content
        $receiptContent .= "Coffee Type: " . $coffeeType . " (₱" . number_format($coffee_prices[$coffeeType], 2) . ")\n";

        // Add coffee size with its price to the receipt content
        $receiptContent .= "Size: " . $size . " (₱" . number_format($size_prices[$size], 2) . ")\n";

        // Check if any extras were selected and add them to the receipt content
        if (!empty($extras)) {
            $receiptContent .= "Extras: " . implode(", ", $extras) . " (₱" . number_format(array_sum(array_intersect_key($extras_prices, array_flip($extras))), 2) . ")\n";
        }

        // Add the total price to the receipt content
        $receiptContent .= "Total Price: ₱" . number_format($total_price, 2) . "\n";

        // Add any special instructions to the receipt content
        $receiptContent .= "Special Instructions: " . $instructions . "\n";

        // Add a thank you message to the receipt content
        $receiptContent .= "\n";
        $receiptContent .= "Thank you for your order!";

        // Return the complete receipt content
        return $receiptContent;
    }


    /**
     * Saves the receipt content to a text file.
     * 
     * @param string $receiptContent The content of the receipt to be saved
     */
    function saveReceiptToFile($receiptContent)
    {
        // Open a file for writing. If the file does not exist, it will be created.
        // If the file cannot be opened, display an error message and terminate the script.
        $file = fopen("Coffee Shop Order Summary.txt", "w") or die("Unable to open file!");

        // Write the receipt content to the file.
        fwrite($file, $receiptContent);

        // Close the file after writing is complete.
        fclose($file);

        // Display a success message indicating that the receipt was created.
        echo "Receipt created successfully as Coffee Shop Order Summary.txt!";
    }

    // Call the displayOrderSummary function
    displayOrderSummary();

    function insertOrderToDatabase($name, $coffeeType, $size, $total_price, $instructions, $extras)
    {

        include "../database/database.php";

        try {
            // Open the database connection
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepares an SQL statement for execution
            $stmt = $conn->prepare("INSERT INTO orders (name, coffeeType, size, totalPrice, instructions, extras) 
                VALUES (:name, :coffee_type, :size, :total_price, :instructions, :extras)");

            // Convert the array into a single string
            $extras_string = implode(", ", $extras);

            // Bind the value of the variable to the parameter
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':coffee_type', $coffeeType);
            $stmt->bindParam(':size', $size);
            $stmt->bindParam(':total_price', $total_price);
            $stmt->bindParam(':instructions', $instructions);
            $stmt->bindParam(':extras', $extras_string);

            // Executes the prepared statement
            $stmt->execute();

            echo "<br /> Order details inserted into the database successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // Close the database connection
    $conn = null;
    ?>

    <br />

    <form action="../pages/insert.html">
        <button type="submit">Back</button>
    </form>
</body>

</html>