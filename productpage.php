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

// Handle toggle product request
if (isset($_POST['toggle_product']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
    $itemId = intval($_POST['itemID']);
    $newStatus = ($item['isOver'] == 0) ? 1 : 0;
    $updateQuery = "UPDATE items SET isOver = $newStatus WHERE itemID = $itemId";

    if (mysqli_query($conn, $updateQuery)) {
        // Refresh item data
        $query = "SELECT * FROM items WHERE itemID = $itemId";
        $result = mysqli_query($conn, $query);
        $item = mysqli_fetch_assoc($result);

        // Show only the correct message
        if ($newStatus == 1) {
            echo "<p class='text-danger text-center mt-3'>Product Unpublished</p>";
        } else {
            echo "<p class='text-success text-center mt-3'>Product Republished</p>";
        }
    } else {
        echo "<p class='text-danger text-center mt-3'>Failed to update product status.</p>";
    }
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
    <?php
    if (isset($_SESSION['userID']) && $_SESSION['isAdmin'] == 1) {
        include './headerA.php';
    } else {
        include './header.php';
    }
    ?>

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
                <div class="info">Stock: <?php echo $item['inventory'] - $item['tSold']; ?></div>
                <div class="info">Sold: <?php echo $item['tSold']; ?></div>

                <!-- Form -->
                <form method="post" class="d-flex align-items-center gap-2">
                    <input type="hidden" name="itemID" value="<?php echo $item['itemID']; ?>">
                    <!-- Admin controls -->
                    <button type="submit" name="add_to_cart" class="add-cart-btn">
                        Add to Cart
                    </button>

                    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1): ?>

                        <a href="edit_product.php?itemID=<?php echo $item['itemID']; ?>"
                            class="add-cart-btn bg-dark text-white text-decoration-none" style="text-align:center">
                            Edit Product
                        </a>

                        <?php if ($item['isOver'] == 0): ?>
                            <button type="submit" name="toggle_product"
                                class="add-cart-btn bg-danger text-white">
                                Disable Product
                            </button>
                        <?php else: ?>
                            <button type="submit" name="toggle_product"
                                class="add-cart-btn bg-success text-white">
                                Enable Product
                            </button>
                        <?php endif; ?>

                    <?php endif; ?>
                </form>


            </div>
        </div>

        <?php
        // Cart / admin logic
        if (isset($_POST['add_to_cart'])) {
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
                // Admin clicked Add to Cart → show image instead
                echo '<div class="text-center mt-4">';
                echo '<img src="./media/getaloadofthisguy.jpg" width="200" height="200" alt="Get a load of this Guy">';
                echo '<p class="text-info mt-2">Get a load of this Guy</p>';
                echo '</div>';
            } elseif (!isset($_SESSION['userID'])) {
                echo "<p class='text-center mt-5'>You must be logged in to add items to cart.</p>";
            } else {
                $userId = intval($_SESSION['userID']);
                $itemId = intval($_POST['itemID']);

                // Check if item already exists in cart
                $checkQuery = "SELECT cartID FROM cart WHERE userID = $userId AND itemID = $itemId";
                $checkResult = mysqli_query($conn, $checkQuery);

                if (mysqli_num_rows($checkResult) > 0) {
                    echo "<p class='text-warning text-center mt-3'>Item is already in cart.</p>";
                } else {
                    $insertQuery = "INSERT INTO cart (userID, itemID) VALUES ($userId, $itemId)";
                    if (mysqli_query($conn, $insertQuery)) {
                        echo "<p class='text-success text-center mt-3'>Item added to cart successfully!</p>";
                    } else {
                        echo "<p class='text-danger text-center mt-3'>Failed to add item to cart.</p>";
                    }
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