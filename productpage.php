<?php
include_once "conn.php";   // ensure DB connection
require './init.php';


if (!isset($_GET['id'])) {
    echo "<p class='text-center mt-5'>No product selected.</p>";
    include './footer.php';
    exit;
}

$itemId = intval($_GET['id']);
$query = "SELECT * FROM items WHERE itemID = $itemId";
$result = mysqli_query($conn, $query);
$item = mysqli_fetch_assoc($result);

if (!$item) {
    echo "<p class='text-center mt-5'>Product not found.</p>";
    include './footer.php';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QUALITEES | Product Page</title>
    <link rel="icon" href="./media/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        .product-wrapper {
            max-width: 1000px;
            margin: 60px auto;
            padding: 20px;
        }

        .product-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        .product-image {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
            background: #f5f5f5;
        }

        .product-details h2 {
            font-family: 'Stardom-Regular';
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .product-details .info {
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .product-details .price {
            font-size: 1.6rem;
            color: #b33939;
            font-weight: bold;
            margin: 15px 0;
        }

        .add-cart-btn {
            background-color: #b33939;
            color: white;
            border: none;
            padding: 12px 30px;
            margin-top: 15px;
            text-transform: uppercase;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .add-cart-btn:hover {
            background-color: #a93232;
        }

        .description-block {
            margin-top: 40px;
        }

        .description-block h4 {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include './header.php'; ?>

    <div class="product-wrapper">
        <div class="product-layout">
            <!-- Product Image -->
            <div>
                <img src="<?php echo htmlspecialchars($item['media']); ?>"
                    alt="<?php echo htmlspecialchars($item['itemName']); ?>"
                    class="product-image">
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h2><?php echo htmlspecialchars($item['itemName']); ?></h2>
                <div class="info">Category: <?php echo htmlspecialchars($item['category']); ?></div>
                <div class="price">₱ <?php echo number_format($item['price'], 2); ?></div>
                <div class="info">Inventory: <?php echo $item['inventory']; ?></div>
                <div class="info">Sold: <?php echo $item['tSold']; ?></div>

                <form method="post">
                    <input type="hidden" name="itemID" value="<?php echo $item['itemID']; ?>">
                    <button type="submit" name="add_to_cart" class="add-cart-btn">Add to Cart</button>
                </form>
            </div>
        </div>

        <?php
        // ... product query and display logic above ...

        if (isset($_POST['add_to_cart'])) {
            if (!isset($_SESSION['userID'])) {
                echo "<p class='text-center mt-5'>You must be logged in to add items to cart.</p>";
            } else {
                $userId = intval($_SESSION['userID']);
                $itemId = intval($_POST['itemID']);

                $insertQuery = "INSERT INTO cart (userID, itemID) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $insertQuery);
                mysqli_stmt_bind_param($stmt, "ii", $userId, $itemId);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<p class='text-success text-center mt-3'>Item added to cart successfully!</p>";
                } else {
                    echo "<p class='text-danger text-center mt-3'>Failed to add item to cart.</p>";
                }
            }
        }
        ?>

        <!-- Description -->
        <div class="description-block">
            <h4>Description</h4>
            <p><?php echo htmlspecialchars($item['description']); ?></p>
        </div>
    </div>

    <?php include './footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>