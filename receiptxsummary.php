<?php
include 'init.php';
include 'conn.php';

if (!isset($_SESSION['userID'])) {
    echo "User not logged in.";
    exit;
}

$userID = $_SESSION['userID'];

// Get reference number from previous page (GET or POST)
$referenceno = $_GET['ref'] ?? $_POST['ref'] ?? null;

if (!$referenceno) {
    echo "No reference number provided.";
    exit;
}

// Sanitize input
$referenceno = mysqli_real_escape_string($conn, $referenceno);

// Get user info
$userQuery = "SELECT firstName, lastName, email, address FROM users WHERE userID = $userID";
$userResult = mysqli_query($conn, $userQuery);
$userRow = mysqli_fetch_assoc($userResult);

// Get receipt items for this reference
$itemsQuery = "
    SELECT items.itemName, receipt.qty, receipt.tPrice 
    FROM receipt 
    JOIN items ON receipt.itemID = items.itemID 
    WHERE receipt.referenceno = '$referenceno' AND receipt.userID = $userID
";
$itemsResult = mysqli_query($conn, $itemsQuery);

$total = 0;
$items = [];
while ($row = mysqli_fetch_assoc($itemsResult)) {
    $items[] = $row;
    $total += $row['tPrice'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUALITEES | Receipt/Summary</title>
    <link rel="icon" href="./media/icon.png" type="image/png">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .receipt {
            max-width: 420px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 24px;
        }

        .header {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #333;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid #eee;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 16px;
            margin-top: 12px;
            color: #222;
        }

        .info {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .info p {
            margin: 4px 0;
        }

        .thank-you {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #666;
            letter-spacing: 1px;
        }
    </style>
</head>
<div style="position:sticky; z-index:1000; top: 0; background-color:white">
    <?php include './headerSum.php'; ?>
</div>

<body>
    <div class="receipt">
        <div class="header">QUALITEES</div>

        <?php foreach ($items as $item): ?>
            <div class="item-row">
                <span><?= htmlspecialchars($item['itemName']) ?></span>
                <span><?= $item['qty'] ?> × ₱<?= number_format($item['tPrice'] / $item['qty'], 2) ?></span>
            </div>
        <?php endforeach; ?>

        <div class="total">Total: ₱<?= number_format($total, 2) ?></div>

        <div class="info">
            <p>To: <?= htmlspecialchars($userRow['firstName'] . ' ' . $userRow['lastName']) ?></p>
            <p>Drop: <?= htmlspecialchars($userRow['address']) ?></p>
            <p>Contact: <?= htmlspecialchars($userRow['email']) ?></p>
            <p>Reference No: <?= htmlspecialchars($referenceno) ?></p>
        </div>

        <div style="text-align:center; margin-top:20px;">THANK YOU</div>
    </div>
</body>

</html>