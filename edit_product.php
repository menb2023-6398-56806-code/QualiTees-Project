<?php
require 'conn.php';
session_start();

if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
    exit('Unauthorized');
}

$message = '';
$itemID = isset($_GET['itemID']) ? (int)$_GET['itemID'] : 0;

/**
 * Fetch item data
 */
$sql = "SELECT * FROM items WHERE itemID = $itemID LIMIT 1";
$res = mysqli_query($conn, $sql);
$item = mysqli_fetch_assoc($res);

if (!$item) {
    exit('Item not found');
}

/**
 * Handle update
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $itemName    = $_POST['itemName'] ?? '';
    $description = $_POST['description'] ?? '';
    $price       = (float)($_POST['price'] ?? 0);
    $mediaId     = $_POST['media'] ?? '';
    $media       = "https://drive.google.com/thumbnail?id=" . $mediaId . "&sz=h1080";
    $category    = $_POST['category'] ?? '';
    $inventory   = (int)($_POST['inventory'] ?? 0);
    $tSold       = (int)($_POST['tSold'] ?? 0);

    /**
     * STOCK RULE
     * inventory MUST NOT be lower than sold
     */
    if ($inventory < $tSold) {
        $message = "Inventory cannot be lower than total sold.";
    } else {

        $sql = "UPDATE items SET
                    itemName = ?,
                    description = ?,
                    media = ?,
                    category = ?,
                    price = ?,
                    inventory = ?,
                    tSold = ?
                WHERE itemID = ?";

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "ssssdi ii",
                $itemName,
                $description,
                $media,
                $category,
                $price,
                $inventory,
                $tSold,
                $itemID
            );

            if (mysqli_stmt_execute($stmt)) {
                $message = "Product updated successfully!";
                // Refresh data
                $res = mysqli_query($conn, "SELECT * FROM items WHERE itemID = $itemID");
                $item = mysqli_fetch_assoc($res);
            } else {
                $message = "Update failed.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Product</title>
    <link rel="icon" href="./media/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        @import url('./media/stardom.css');

        body {
            background: #fff;
            padding: 2rem;
        }

        .form-container {
            font-family: 'Stardom-Regular';
            max-width: 520px;
            margin: auto;
            padding: 2rem;
            border: 1.5px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            padding: .5rem;
            margin-bottom: 1rem;
            border: 1.5px solid #ccc;
            border-radius: 8px;
        }

        .btn-submit {
            background: #222;
            color: #fff;
            padding: .6rem;
            border-radius: 30px;
            width: 100%;
            font-weight: 700;
            border: none;
        }

        .message {
            text-align: center;
            font-weight: 600;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <?php include './headerA.php'; ?>

    <div class="form-container">
        <h2>Edit Product</h2>

        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post">

            <label>Item Name</label>
            <input type="text" name="itemName" value="<?= htmlspecialchars($item['itemName']) ?>" required>

            <label>Description</label>
            <input type="text" name="description" value="<?= htmlspecialchars($item['description']) ?>" required>

            <label>Price (Php)</label>
            <input type="number" step="0.01" name="price" value="<?= $item['price'] ?>" required>

            <label>Inventory</label>
            <input type="number" name="inventory" value="<?= $item['inventory'] ?>" required>

            <label>Total Sold</label>
            <input type="number" name="tSold" value="<?= $item['tSold'] ?>" required>

            <label>Product Image (Google Drive ID)</label>
            <input type="text" name="media"
                value="<?= preg_replace('/.*id=([^&]+).*/', '$1', $item['media']) ?>" required>

            <label>Category</label>
            <select name="category" required>
                <?php
                $cats = ['JEWELRY', 'FINE ARTS', 'CARS', 'WATCHES', 'OTHERS'];
                foreach ($cats as $c) {
                    $sel = ($item['category'] === $c) ? 'selected' : '';
                    echo "<option value=\"$c\" $sel>$c</option>";
                }
                ?>
            </select>

            <button class="btn-submit">Save Changes</button>
        </form>
    </div>
</body>

</html>