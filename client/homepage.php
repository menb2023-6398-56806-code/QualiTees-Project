<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUALITEES</title>
    <link rel="icon" href="../media/icon.png" type="image/png">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom Font -->
    <style>
        @import url('../stardom.css');

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Banner */
        .hero {
            position: relative;
            background: url('../media/temp0.png') center/cover no-repeat;
            color: white;
            height: 100vh;
        }

        .hero-content {
            position: absolute;
            bottom: 40px; /* distance from bottom */
            left: 40px;   /* distance from left */
            background: rgba(0, 0, 0, 0.4); /* semi-transparent black */
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

<body>
    <?php include '../header.php'; ?>

    <!-- Hero Banner -->
    <section class="hero d-flex align-items-center">
        <div class="hero-content">
            <h1>VEHICLES</h1>
            <p>Vroom vroom brip brip skrrrr</p>
            <button class="hero-btn">BID NOW</button>
        </div>
    </section>

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
                    <img src="../media/temp.png" alt="Product Image">
                    <p class="mt-2 fw-semibold">Sample Item <?= $i + 1 ?></p>
                    <button class="bid-btn">BID</button>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </section>

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
    
    <!-- Ending Soon Section -->
    <section class="ending-soon text-center">
        <h2 class="section-title"><span class="highlight">Ending</span> Soon</h2>
        <p>Don’t <span class="highlight">miss</span> out this deal!</p>

        <div class="container mt-4">
            <div class="row g-4 justify-content-center">
                <?php for ($i = 0; $i < 3; $i++): ?>
                <div class="col-10 col-md-4">
                    <div class="product-card text-center bg-white p-3 rounded shadow-sm">
                        <img src="../media/temp.jpg" alt="Ending Soon">
                        <p class="fw-semibold mt-2">Sample Item <?= $i + 1 ?></p>
                        <p class="text-danger small">Time Left: 02:15:43</p>
                        <button class="bid-btn">BID</button>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>
    
    <a href="#" class="nav-link text-center mt-2 d-block">Back to Top</a>   

    <?php include '../footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
