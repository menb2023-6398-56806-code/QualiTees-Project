<?php
require './init.php';
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUALITEES | Product's Page</title>
    <link rel="icon" href="./media/icon.png" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">


    <style>
        @import url('./media/stardom.css');

        body {
            margin: 0;
            font-family: "Georgia", "Times New Roman", serif;
            background-color: #ffffff;
            color: #000000;
        }

        /* ===========================
   BIDDING SECTION
=========================== */
        .bidding-wrapper {
            max-width: 900px;
            margin: 60px auto 80px auto;
            padding: 40px 60px;
            background-color: #ffffff;
        }

        .bidding-layout {
            display: grid;
            grid-template-columns: 2fr 1.4fr;
            column-gap: 60px;
            align-items: start;
        }

        .item-media-box {
            position: relative;
            width: 100%;
            padding-top: 100%;
            /* square ratio */
            background-color: #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 32px;
            letter-spacing: 1px;
            color: #333333;
        }

        .item-info-right {
            font-size: 13px;
            line-height: 1.6;
        }

        .item-name-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .item-name {
            font-size: 20px;
        }

        .heart-icon i {
            font-size: 18px;
            cursor: pointer;
            color: black;
            /* default outline */
            transition: color 0.2s ease;
        }

        .heart-icon i.filled {
            color: #b33939;
            /* red when filled */
        }

        .info-label {
            font-weight: bold;
            display: block;
            margin-top: 4px;
        }

        .info-value {
            display: block;
            margin-bottom: 10px;
        }

        /* ===========================
   BID FORM
=========================== */
        .bid-section {
            margin-top: 32px;
            font-size: 13px;
        }

        .bid-label {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .bid-input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #cccccc;
            margin-bottom: 14px;
            font-size: 13px;
        }

        .bid-button {
            padding: 10px 40px;
            border: none;
            background-color: #c44545;
            color: #ffffff;
            font-size: 13px;
            cursor: pointer;
            letter-spacing: 0.5px;
            transition: background-color 0.15s ease-in-out;
        }

        .bid-button:hover {
            background-color: #f46a6a;
        }

        /* ===========================
   DESCRIPTION BLOCK
=========================== */
        .description-block {
            margin-top: 36px;
            font-size: 13px;
        }

        .description-title {
            font-weight: bold;
            margin-bottom: 6px;
        }

        /* ===========================
   RESPONSIVE STYLES
=========================== */
        @media (max-width: 800px) {
            .bidding-layout {
                grid-template-columns: 1fr;
                row-gap: 40px;
            }
        }

        /* ===========================
   FOOTER STYLES
=========================== */
        footer {
            background-color: #fff;
            border-top: 1px solid #ddd;
            padding: 2rem 0;
            color: #000;
            font-family: 'Poppins', sans-serif;
        }

        .footer-logo {
            font-family: 'Stardom-Regular';
            font-size: 1.8rem;
            font-weight: 600;
            color: #000;
            text-decoration: none;
        }

        .footer-logo:hover {
            color: #b33939;
        }

        .footer-links a {
            color: #000;
            text-decoration: none;
            font-weight: 500;
            margin: 0 0.75rem;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: #b33939;
        }

        .social-icons a {
            color: #000;
            font-size: 1.2rem;
            margin: 0 0.5rem;
            transition: color 0.2s ease;
        }

        .social-icons a:hover {
            color: #b33939;
        }

        .footer-bottom {
            border-top: 1px solid #ddd;
            margin-top: 1.5rem;
            padding-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>

<body>



    <div class="bidding-wrapper">
        <div class="bidding-layout">
            <div>
                <div class="item-media-box">items.media</div>
            </div>

            <div class="item-info-right">
                <div class="item-name-row">
                    <div class="item-name">items.ItemName</div>
                    <div class="heart-icon"><i class="bi bi-heart"></i></div>
                </div>

                <div>
                    <span class="info-label">Duration</span>
                    <span class="info-value">items.startDate – items.endDate</span>

                    <span class="info-label">Estimate</span>
                    <span class="info-value">items.price</span>

                    <span class="info-label">Current Highest Bid</span>
                    <span class="info-value">bidHighestBid</span>
                </div>

                <form class="bid-section">
                    <div class="bid-label">Bid</div>
                    <input type="number" step="0.01" min="0" name="bidAmount" class="bid-input" placeholder="Enter your bid">
                    <button type="button" class="bid-button">Bid</button>
                </form>
            </div>
        </div>

        <div class="description-block">
            <div class="description-title">Description</div>
            <div>items.description</div>
        </div>
    </div>

    <footer>
        <div class="container text-center">
            <a href="#" class="footer-logo">QUALITEES</a>
            <div class="footer-links mt-3">
                <a href="#">About</a>
                <a href="#">Contact</a>
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
            <div class="social-icons mt-3">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-twitter-x"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
            </div>
            <div class="footer-bottom mt-3">
                &copy; 2025 Qualitees. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Heart Toggle Script -->
    <script>
        const heartIcon = document.querySelector('.heart-icon i');

        heartIcon.addEventListener('click', () => {
            heartIcon.classList.toggle('bi-heart'); // outline heart
            heartIcon.classList.toggle('bi-heart-fill'); // filled heart
            heartIcon.classList.toggle('filled'); // red color
        });
    </script>

</body>

</html>