<!DOCTYPE html>
<html>
<head>
    <title>All About Bees</title>
    <link rel="stylesheet" type="text/css" href="../public/styles.css">
</head>
<body>
    <header>
        <h1>Welcome to the Bee Kingdom</h1>
    </header>

    <section>
        <h2>PHP Basics</h2>
        <p>Let's dive into some PHP fundamentals:</p>
        <ul>
            <li>Syntax: PHP code is embedded within HTML using &lt;?php ... ?&gt; tags.</li>
            <li>Comments: Use // for single-line comments and /* ... */ for multi-line comments.</li>
            <li>Case Sensitivity: PHP is case-sensitive; variable names are case-sensitive.</li>
            <li>Variables: Declare variables using the $ symbol (e.g., $beeCount).</li>
            <li>Echo/Print: Use echo or print to display content on the page.</li>
            <li>Data Types: PHP supports various data types, including strings, numbers, and arrays.</li>
            <li>String Concatenation: Combine strings with the . operator (e.g., $greeting . ' from PHP!').</li>
        </ul>
    </section>

    <section>
        <h2>🐝 About Bees</h2>
        <p>Bees are incredible insects that play a crucial role in our ecosystem. They are known for their remarkable...</p>

        Gdrive link: https://bit.ly/WEBAPP_W1L1
        GitHub: https://github.com/jlrn-rph/web-app-dev-w1l1/ 

        <?php
            // Initial details
            $beeCount = 10000;
            $beeSpecies = "Honey bees";
            $greeting = "Hello";

            // Data Types
            $beeColors ="yellow, black, brown";
            $averageLifespan = 122.5; // Float
            // var_dump($averageLifespan);

            $averageLifeSpan = 123; // Integer
            // var_dump($averageLifeSpan);

            $isEndangered = false; // Boolean
            // var_dump($isEndangered);

            // String Concatenation
            $beeDescription = "Bees are fascinating insects with colors like " . $beeColors . ".";
            $lifespanInfo = "On average, they live up to $averageLifespan days.";
            $endangeredInfo = $isEndangered ? "They are considered endangered." : "They are not considered endangered.";

            // Print the information
            echo "<p>$greeting from PHP 🌎!</p>";
            print "<p>There are approximately $beeCount $beeSpecies in a typical hive.</p>";
            echo "<p>$beeDescription</p>";
            echo "<p>$lifespanInfo</p>";
            echo "<p>$endangeredInfo</p>";
        ?>

        <p>Bees come in various species, including honey bees, bumblebees, and more. They are known for their important role in pollination, which is vital for our food supply.</p>
    </section>

    <footer>
        <p>&copy; 2023 The Bee Kingdom</p>
    </footer>
</body>
</html>
