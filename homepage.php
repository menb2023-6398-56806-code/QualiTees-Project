<?php include_once "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUALITEES | Homepage</title>
    <link rel="icon" href="./media/icon.png" type="image/png">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom Font -->
    <style>
        @import url('./media/stardom.css');

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Banner */
        .hero {
            position: relative;
            background: url('./media/temp.png') center/cover no-repeat;
            color: white;
            height: 100vh;
        }

        .hero-content {
            position: absolute;
            bottom: 40px;
            left: 40px;
            background: rgba(0, 0, 0, 0.4);
            color: white;
            padding: 20px 30px;
            border: none;
            border-radius: 6px;
            max-width: 400px;
        }

        .hero-content h1 {
            font-family: 'Stardom-Regular', sans-serif;
            font-size: 3rem;
        }

        .hero-btn {
            background-color: #b33939;
            color: white;
            padding: 10px 20px;
            text-transform: uppercase;
            border: none;
            transition: color 0.4s
        }

        .hero-btn:hover {
            background: white;
            color: #b33939;
        }

        /* Section Titles */
        .section-title {
            font-family: 'Stardom-Regular', sans-serif;
            font-size: 2rem;
            text-align: center;
            margin: 2rem 0 1rem;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: #b33939;
            margin: 10px auto;
        }

        /* Product Grid */
        .product-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-card .bid-btn {
            border: 1px solid #b33939;
            background: none;
            color: #b33939;
            text-transform: uppercase;
            padding: 5px 20px;
            margin-top: 10px;
        }

        .product-card .bid-btn:hover {
            background: #b33939;
            color: white;
        }

        /* Ending Soon */
        .ending-soon {
            background: #f9f9f9;
            padding: 3rem 0;
        }

        .ending-soon .highlight {
            color: #b33939;
            font-weight: bold;
        }
    </style>
</head>

<?php
$imagePath = "./media/product1.png"; // dynamic path
$itemName = "Cool Gadget";
$timeLeft = "01:30:45";
$bidAmount = 500;
?>

<body>
    <?php include './header.php'; ?>

    <div class="container">
        <!-- Hero Banner -->
        <section class="hero d-flex align-items-center">
            <div class="hero-content">
                <h1>placeholder</h1>
                <p>im going bananas</p>
                <button class="hero-btn">BID NOW</button>
            </div>
        </section>
        <br>
    </div>

    <!-- Qualitees Banner -->
    <section class="text-center  py-4" style="background: #E5E4E2">
        <h1 style="font-family: 'Stardom-Regular'; font-size: 64px;">QUALITEES</h1>
        <p class="text-muted" style="font-size: 24px;">Bid with Confidence, Win with Trust</p>
    </section>
    <section class="bg-dark">
        <br>
        <br>
        <br>
    </section>

    <div class="container">
        <!-- Ongoing Section -->
        <section class="container my-5">
            <h2 class="section-title">ONGOING</h2>
            <div class="text-end mb-3">
                <button class="btn btn-outline-dark btn-sm">View All</button>
            </div>

            <div class="row g-4">
                <?php for ($i = 0; $i < 8; $i++): ?>
                    <div class="col-6 col-md-3">
                        <div class="product-card text-center">
                            <img src="./media/temp.png" alt="Product Image">
                            <p class="mt-2 fw-semibold">Sample Item <?= $i + 1 ?></p>
                            <p class="text-dark small">Time Left: 00:00:00</p>
                            <button class="bid-btn">₱ 000</button>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </section>
    </div>



    <?php include './footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>