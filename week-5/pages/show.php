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
        <h1>☕ Coffee Shop Orders</h1>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Coffee Type</th>
                <th>Size</th>
                <th>Total Price</th>
                <th>Instructions</th>
                <th>Extras</th>
            </tr>
            <?php include '../orders/show_order.php'; ?>
        </table>

        <br />

        <form action="menu.html">
            <button type="submit">Back to Main Menu</button>
        </form>
    </div>


</body>

</html>