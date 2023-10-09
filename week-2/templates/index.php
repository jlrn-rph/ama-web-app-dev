<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Order Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1> ☕ Coffee Shop Order Form</h1>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="coffee">Coffee Type:</label>
            <select id="coffee" name="coffee" required>
                <option value="espresso">Espresso - ₱250</option>
                <option value="latte">Latte - ₱300</option>
                <option value="cappuccino">Cappuccino - ₱350</option>
                <option value="americano">Americano - ₱200</option>
                <option value="mocha">Mocha - ₱400</option>
            </select>

            <div class="input-group">
                <label>Size:</label>
                <input type="radio" id="small" name="size" value="small" required>
                <label for="small">Small: +₱0</label>

                <input type="radio" id="medium" name="size" value="medium">
                <label for="medium">Medium: +₱50</label>

                <input type="radio" id="large" name="size" value="large">
                <label for="large">Large: +₱80</label>
            </div>

            <div class="input-group">
                <label for="extras">Extras:</label>
                <input type="checkbox" id="sugar" name="extras[]" value="sugar">
                <label for="sugar">Sugar: +₱5.75</label>

                <input type="checkbox" id="cream" name="extras[]" value="cream">
                <label for="cream">Cream: +₱10.50</label>
            </div>

            <label for="instructions">Special Instructions:</label>
            <textarea id="instructions" name="instructions" rows="4"></textarea>

            <button type="submit">Place Order</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo "<div class='summary'>";
            echo "<h2>📝 Order Summary</h2>";

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

            $coffee_type = $_POST["coffee"];
            $size = $_POST["size"];

            /* The isset() function checks whether a variable is set, which means that it has to be declared and is not NULL. 
            
            Checks if any extras have been selected. If they have, it stores the selected extras in the $extras variable as an array; otherwise, it initializes an empty array.*/
            $extras = isset($_POST["extras"]) ? $_POST["extras"] : [];

            // Calculates the initial total price by adding the selected coffee type's price to the selected size's price 
            $total_price = $coffee_prices[$coffee_type] + $size_prices[$size];

            // This loop iterates through the selected extras stored in the $extras array.
            foreach ($extras as $extra) {
                $total_price += $extras_prices[$extra];
            }

            // Start the order summary table
            echo "<table>";

            // The htmlspecialchars() function converts some predefined characters to HTML entities to prevent potential HTML and script injection.
            // Display customer name
            echo "<tr><td>Name</td><td>" . htmlspecialchars($_POST["name"]) . "</td></tr>";

            // Display coffee type and its price
            echo "<tr><td>Coffee Type</td><td>" . htmlspecialchars($_POST["coffee"]) . " (₱" . number_format($coffee_prices[$coffee_type], 2) . ")</td></tr>";

            // Display coffee size and its price
            echo "<tr><td>Size</td><td>" . htmlspecialchars($_POST["size"]) . " (₱" . number_format($size_prices[$size], 2) . ")</td></tr>";

            // Check if extras were selected
            if (!empty($extras)) {
                /*  
                implode(", ", $extras) takes the elements in the $extras array and joins them together with a comma and space in between. For example, if both sugar and cream are selected, it will produce "sugar, cream." 

                array_flip($extras) flips the keys and values of the $extras array. In this context, it will be used to create an array with keys like "sugar" and "cream."
                
                array_intersect_key($extras_prices, array_flip($extras)) filters the $extras_prices array to include only the prices of the selected extras. For example, if "sugar" and "cream" are selected, it will create an array like ["sugar" => 5.75, "cream" => 10.50].

                array_sum(...) calculates the sum of the prices of the selected extras.

                number_format(..., 2) formats the total cost with two decimal places.
                */
                echo "<tr><td>Extras:</td><td>" . implode(", ", $extras) . " (₱" . number_format(array_sum(array_intersect_key($extras_prices, array_flip($extras))), 2) . ")</td></tr>";
            }

            // Display the total price and instructions
            echo "<tr><td>Total Price</td><td>₱" . number_format($total_price, 2) . "</td></tr>";
            echo "<tr><td>Special Instructions</td><td>" . htmlspecialchars($_POST["instructions"]) . "</td></tr>";

            // End the order summary table
            echo "</table>";

            // Check if the coffee ordered is not espresso and tell a joke
            if ($coffee_type !== "espresso") {
                echo "Hey, " . htmlspecialchars($_POST["name"]) . "!";
                echo "<p>Here's a joke for you: Why did the coffee file a police report? It got mugged!</p>";
            }

            // Check the total price range and provide passwords
            if ($total_price > 250 && $total_price < 350) {
                echo "<p>Password for the CR: coffee123</p>";
            } elseif ($total_price >= 350) {
                echo "<p>Password for Wi-Fi: mocha456</p>";
            }

            echo "</div>";
        }

        ?>
    </div>
</body>

</html>