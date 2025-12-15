<?php
include 'conn.php';
include 'init.php';

/**
 * Render orders in a 2-column grid, showing 10 initially and expand by 10.
 * - Admin (isAdmin = 1): shows all users' transactions
 * - User  (isAdmin = 0): shows only their transactions via $_SESSION['userID']
 * - Optional search by referenceno via GET ?ref=
 */
function renderOrders($conn, $statusLabel, $orderStatus, $searchRef = null)
{
    $isAdmin = isset($_SESSION['isAdmin']) ? (int)$_SESSION['isAdmin'] : 0;
    $userID  = isset($_SESSION['userID']) ? (int)$_SESSION['userID'] : 0;

    // Build base query
    $query = "SELECT 
                r.referenceno,
                r.qty,
                r.tPrice,
                i.itemName,
                u.firstName, 
                u.lastName,
                r.userID
              FROM receipt r
              JOIN items i ON r.itemID = i.itemID
              JOIN users u ON r.userID = u.userID
              WHERE r.orderStatus = $orderStatus";

    // If not admin, restrict to their own transactions
    if ($isAdmin === 0 && $userID > 0) {
        $query .= " AND r.userID = $userID";
    }

    // If searching by reference number
    if (!empty($searchRef)) {
        $searchRefEsc = mysqli_real_escape_string($conn, $searchRef);
        $query .= " AND r.referenceno = '$searchRefEsc'";
    }

    $query .= " ORDER BY r.referenceno DESC";

    $result = mysqli_query($conn, $query);

    // Group by referenceno
    $orders = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $ref = $row['referenceno'];
            if (!isset($orders[$ref])) {
                $orders[$ref] = [
                    'items' => [],
                    'total' => 0,
                    'user'  => ($row['firstName'] . ' ' . $row['lastName'])
                ];
            }
            $orders[$ref]['items'][] = $row;
            $orders[$ref]['total'] += (float)$row['tPrice'];
        }
    }

    // Render section and grid
    echo '<section class="section" id="section-' . $orderStatus . '">';
    echo '<h2 class="section-title">' . htmlspecialchars($statusLabel) . '</h2>';
    echo '<div class="order-grid">';

    $count = 0;
    foreach ($orders as $ref => $group) {
        $hiddenClass = ($count >= 10) ? 'hidden' : '';
        echo '<div class="order-group ' . $hiddenClass . '" data-ref="' . htmlspecialchars($ref) . '">';

        // Customer name once per group
        echo '<div class="customer-name"><strong>' . htmlspecialchars($group['user']) . '</strong></div>';

        foreach ($group['items'] as $item) {
            echo '
            <div class="item-entry">
                <div class="item-details">
                    <div class="item-text">
                        <span class="item-name">' . htmlspecialchars($item['itemName']) . '</span>
                        <span class="item-x"> x </span>
                        <span class="item-qty">' . htmlspecialchars($item['qty']) . '</span>
                    </div>
                    <p class="item-amount">₱' . number_format((float)$item['tPrice'], 2) . '</p>
                </div>
            </div>';
        }

        echo '
<div class="ref-summary">
    <span class="ref-text">Reference No: ' . htmlspecialchars($ref) . '</span><br>
    <span class="ref-text">Total ₱' . number_format($group['total'], 2) . '</span>
</div>
        </div>'; // end order-group
        $count++;
    }

    echo '</div>'; // end order-grid

    // Expand icon only if more than 10 groups exist
    if ($count > 10) {
        echo '<div class="expand-btn text-center mt-2">
                <i class="bi bi-chevron-down expand-icon" data-section="' . $orderStatus . '"></i>
              </div>';
    }

    echo '</section>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUALITEES | Ordered & History</title>
    <link rel="icon" href="./media/icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        @import url('../stardom.css');

        body {
            font-family: 'Stardom-Regular', sans-serif;
            background-color: #f8f9fa;
        }

        .receipt-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 1rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 0.5rem;
        }

        .item-entry {
            margin-bottom: 0.5rem;
        }

        .item-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .item-text {
            flex-grow: 1;
        }

        .item-name {
            font-weight: normal;
        }

        .item-x {
            color: #b33939;
            margin: 0 4px;
        }

        .item-qty {
            font-weight: bold;
        }

        .item-amount {
            color: #28a745;
            font-weight: bold;
            margin-left: auto;
        }

        .ref-summary {
            text-align: right;
            margin-top: 0.25rem;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .ref-text {
            font-size: 0.85rem;
            /* smaller text */
            color: #6c757d;
            /* Bootstrap grey */
            display: block;
            /* stack vertically */
        }

        .order-group {
            padding: 0.75rem;
            border-radius: 6px;
            border: 1px solid #ccc;
            /* grey edge */
            transition: background-color 0.2s ease, transform 0.1s ease;
            cursor: pointer;
            background-color: #fff;
        }

        .order-group:hover {
            background-color: #f7f7f7;
            transform: scale(1.01);
        }

        .order-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .hidden {
            display: none;
        }

        .expand-icon {
            font-size: 1.5rem;
            cursor: pointer;
            color: #007bff;
        }

        .expand-icon:hover {
            color: #0056b3;
        }

        .top-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .nav-buttons .btn {
            margin-right: 0.5rem;
        }

        .search-bar form {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .customer-name {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>
<div style="position:sticky; z-index:1000; top: 0; background-color:white">
    <?php

    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
        include './headerA.php';
    } else {
        include './headerC.php';
    }
    ?>
</div>


    <div class="receipt-container">
        <div class="top-controls">
            <div class="nav-buttons">
                <button class="btn btn-outline-primary" onclick="showSection(0)">Items Ordered</button>
                <button class="btn btn-outline-secondary" onclick="showSection(1)">Order History</button>
            </div>

            <div class="search-bar">
                <form method="get" action="orderedxhistoryA.php">
                    <input type="text" name="ref" placeholder="Search Reference No" value="<?php echo isset($_GET['ref']) ? htmlspecialchars($_GET['ref']) : ''; ?>" class="form-control" style="width:300px;">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <?php if (isset($_GET['ref']) && $_GET['ref'] !== ''): ?>
                        <a href="orderedxhistoryA.php" class="btn btn-secondary">Clear</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <?php
        $searchRef = isset($_GET['ref']) ? $_GET['ref'] : null;
        renderOrders($conn, 'Items Ordered', 0, $searchRef);
        renderOrders($conn, 'Order History', 1, $searchRef);
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show a specific section (0 = Items Ordered, 1 = Order History)
        function showSection(status) {
            document.querySelectorAll(".section").forEach(sec => {
                sec.style.display = "none";
            });
            const target = document.getElementById("section-" + status);
            if (target) target.style.display = "block";
        }

        // Default view: show Items Ordered
        document.addEventListener("DOMContentLoaded", function() {
            showSection(0);

            // Click to open receipt summary
            $(document).on("click", ".order-group", function() {
                let ref = $(this).data("ref");
                if (ref) {
                    window.location.href = "receiptxsummary.php?ref=" + ref;
                }
            });

            // Expand 10 more per-click per section
            $(document).on("click", ".expand-icon", function(e) {
                e.stopPropagation();
                let sectionStatus = $(this).data("section");
                let sectionEl = $("#section-" + sectionStatus);
                let hiddenOrders = sectionEl.find(".order-group.hidden");
                hiddenOrders.slice(0, 10).removeClass("hidden");

                // Hide icon if nothing left to show
                if (sectionEl.find(".order-group.hidden").length === 0) {
                    $(this).closest(".expand-btn").hide();
                }
            });
        });
    </script>

    <?php include './footer.php'; ?>
</body>

</html>