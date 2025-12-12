<?php
require 'conn.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Map form fields to DB columns
    $itemName    = $_POST['itemName'] ?? '';
    $description = $_POST['description'] ?? '';
    $price       = $_POST['price'] ?? 0;
    $mediaId = $_POST['media'] ?? '';
    $media   = "https://drive.google.com/thumbnail?id=" . $mediaId . "&sz=h1080";
    $category    = $_POST['category'] ?? '';
    $quantity    = $_POST['quantity'] ?? 0;

    // Basic validation
    if ($itemName === '' || $description === '' || $media === '' || $category === '' || $quantity === '') {
        $message = "Please fill in all required fields.";
    } else {
        // Default values for other columns
        $inventory = (int)$quantity;
        $tSold     = 0;
        $tSales    = 0.0;
        $isOver    = 0;

        $sql = "INSERT INTO items (itemName, description, media, category, price, inventory, tSold, tSales, isOver)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "ssssididi",
                $itemName,
                $description,
                $media,
                $category,
                $price,
                $inventory,
                $tSold,
                $tSales,
                $isOver
            );

            if (mysqli_stmt_execute($stmt)) {
                $message = "Product added successfully!";
            } else {
                $message = "Database insert failed: " . mysqli_error($conn);
            }
        } else {
            $message = "Failed to prepare statement: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add Product</title>
    <link rel="icon" href="./media/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        @import url('./media/stardom.css');

        body {
            background: #fff;
            font-family: 'Arial', sans-serif;
            padding: 2rem;
        }

        .form-container {
            font-family: 'Stardom-Regular';
            max-width: 520px;
            margin: 0 auto;
            padding: 2rem;
            border: 1.5px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .form-container h2 {
            margin-bottom: 1.5rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-align: center;
            color: #222;
        }

        label {
            font-weight: 600;
            color: #222;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1.5px solid #ccc;
            border-radius: 8px;
            margin-top: 0.25rem;
            margin-bottom: 1rem;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #b33939;
            outline: none;
        }

        .btn-submit {
            background-color: #222;
            border: none;
            color: white;
            padding: 0.6rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 30px;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 2rem;
            transition: background-color 0.3s;
        }

        .btn-submit:hover,
        .btn-submit:focus {
            background-color: #8a2727;
            outline: none;
        }

        .message {
            margin-bottom: 1rem;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1.5px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1.5px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <?php include './headerA.php'; ?>
    <div class="form-container">
        <h2>Add New Product</h2>

        <?php if ($message): ?>
            <div class="message <?= strpos($message, 'successfully') !== false ? 'success' : 'error' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <!-- Item Name (was Description) -->
            <label for="itemName">Item Name:</label>
            <input type="text" name="itemName" id="itemName" required />

            <!-- Description (new, for items.description) -->
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" required />

            <!-- Price -->
            <label for="price">Price (Php):</label>
            <input type="number" name="price" id="price" required min="0" step="0.01" />

            <!-- Quantity (maps to inventory) -->
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required min="0" step="1" />

            <!-- Product Image link (maps to media) -->
            <label for="media">Product Image (Google Drive ID):</label>
            <input type="text" name="media" id="media" placeholder="Enter Google Drive file ID only" required />


            <!-- Category dropdown -->
            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="" disabled selected>Select category</option>
                <option value="JEWELRY">JEWELRY</option>
                <option value="FINE ARTS">FINE ARTS</option>
                <option value="CARS">CARS</option>
                <option value="WATCHES">WATCHES</option>
                <option value="OTHERS">OTHERS</option>
            </select>

            <button type="submit" class="btn-submit">Add Product</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>