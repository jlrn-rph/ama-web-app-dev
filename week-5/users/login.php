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
        session_start();
        include "../database/database.php"; // Include your database connection file

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            try {
                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Check if the username exists
                $checkStmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
                $checkStmt->bindParam(':username', $username);
                $checkStmt->execute();

                if ($checkStmt->rowCount() > 0) {
                    $user = $checkStmt->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($password, $user['password'])) {
                        $_SESSION['username'] = $username; // Store username in session for later use
                        header("Location: ../pages/menu.html"); // Redirect to menu page after successful login
                        exit();
                    } else {
                        echo "Invalid username or password";
                    }
                } else {
                    echo "Username does not exist!";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ?>
        <form action="../pages/login.html">
            <button type="submit">Back</button>
        </form>
    </div>

</body>

</html>