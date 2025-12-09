<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <link rel="stylesheet" href="./order_receipt.css">
</head>
<?php include './headerC.php'; ?>

<body>

    <div class="receipt-container">

        <section id="oOrdered" class="section">
            <h2 class="section-title">Items Ordered</h2>

            <div class="item-entry">
                <div class="item-details">
                    <p class="item-name">itemName</p>
                    <p class="item-amount">bid.bidAmount</p>
                </div>
                <a href="#" class="view-more">view more...</a>
            </div>

            <hr class="separator">
        </section>

        <section id="oHistory" class="section">
            <h2 class="section-title">Order History</h2>

            <div class="item-entry">
                <div class="item-details">
                    <p class="item-name">itemName</p>
                    <p class="item-amount">bid.bidAmount</p>
                </div>
                <a href="#" class="view-more">view more...</a>
            </div>

            <div class="item-entry">
                <div class="item-details">
                    <p class="item-name">itemName</p>
                    <p class="item-amount">bid.bidAmount</p>
                </div>
                <a href="#" class="view-more">view more...</a>
            </div>
        </section>

    </div>

</body>

</html>