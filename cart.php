<?php
require_once 'conn.php';
require_once 'init.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$userID = intval($_SESSION['userID']);

// Handle remove action
if (isset($_POST['remove'])) {
    $cartID = intval($_POST['cartID']);
    $deleteQuery = "DELETE FROM cart WHERE cartID = $cartID AND userID = $userID";
    mysqli_query($conn, $deleteQuery);

    echo "<script>alert('Item removed from cart.'); window.location='cart.php';</script>";
    exit();
}

// Handle purchase action
if (isset($_POST['purchase'])) {
    if (!empty($_POST['selected'])) {
        $selected = $_POST['selected']; // array of selected cartIDs
        $qtys = $_POST['qty'];          // array of quantities keyed by cartID

        // Generate one unique reference number for this batch
        do {
            $ref = strtoupper(bin2hex(random_bytes(5)));
            $checkQuery = "SELECT referenceno FROM receipt WHERE referenceno = '$ref'";
            $checkResult = mysqli_query($conn, $checkQuery);
        } while (mysqli_num_rows($checkResult) > 0);

        foreach ($selected as $cartID) {
            $cartID = intval($cartID);
            $qty = intval($qtys[$cartID]);

            // Get item info
            $itemQuery = "SELECT items.itemID, items.price 
                          FROM items 
                          INNER JOIN cart ON items.itemID = cart.itemID 
                          WHERE cart.cartID = $cartID";
            $itemResult = mysqli_query($conn, $itemQuery);
            $item = mysqli_fetch_assoc($itemResult);

            $itemID = intval($item['itemID']);
            $price = floatval($item['price']);
            $totalPrice = $price * $qty;

            // Delete from cart after purchase
            $deleteQuery = "DELETE FROM cart WHERE cartID = $cartID";
            mysqli_query($conn, $deleteQuery);

            // Insert into receipt with same reference number
            $insertQuery = "INSERT INTO receipt (referenceno, userID, itemID, qty, tPrice, orderStatus) 
                            VALUES ('$ref', $userID, $itemID, $qty, $totalPrice, 0)";
            mysqli_query($conn, $insertQuery);
        }

        echo "<script>alert('Purchase successful! Reference: $ref'); window.location='cart.php';</script>";
        exit();
    } else {
        echo "<script>alert('No items selected for purchase.'); window.location='cart.php';</script>";
        exit();
    }
}

// Fetch cart items
$cartQuery = "SELECT cart.cartID, items.itemID, items.itemName, items.price, items.media 
              FROM cart 
              INNER JOIN items ON cart.itemID = items.itemID 
              WHERE cart.userID = $userID";
$cartItems = mysqli_query($conn, $cartQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUALITEES | Cart</title>
    <link rel="icon" href="./media/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('../stardom.css');

        body {
            font-family: 'Stardom-Regular', sans-serif;
        }

        .btn-purchase {
            background-color: #b33939 !important;
            transition: background 0.3s;
            color: #fff !important;
        }

        .btn-purchase:hover {
            background-color: #8e2929 !important;
        }
    </style>
</head>
<?php include './headerC.php'; ?>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4"><i class="bi bi-cart"></i> Cart</h2>

        <?php if (mysqli_num_rows($cartItems) > 0): ?>
            <form method="POST">
                <table class="table align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Select</th>
                            <th>#</th>
                            <th>Item</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        while ($row = mysqli_fetch_assoc($cartItems)): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected[]" value="<?= $row['cartID'] ?>">
                                </td>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($row['itemName']) ?></td>
                                <td><img src="<?= htmlspecialchars($row['media']) ?>" alt="item" class="img-thumbnail" style="width:100px;"></td>
                                <td>₱<?= number_format($row['price'], 2) ?></td>
                                <td>
                                    <input type="number" name="qty[<?= $row['cartID'] ?>]" value="1" min="1" class="form-control" style="width:80px;">
                                </td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="cartID" value="<?= $row['cartID'] ?>">
                                        <button type="submit" name="remove" class="btn btn-purchase btn-sm">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <button type="submit" name="purchase" class="btn btn-purchase"><i class="bi bi-credit-card"></i> Purchase</button>
            </form>
        <?php else: ?>
            <div class="alert alert-info">Your cart is empty.</div>
        <?php endif; ?>
    </div>
</body>

</html>