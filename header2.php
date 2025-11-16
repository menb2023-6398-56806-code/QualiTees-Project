<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUALITEES | Header</title>
    <link rel="icon" href="./media/icon.png" type="icon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        @import url('../stardom.css');

        /* Header */
        header {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            /* centers the QUALITEES */
            padding: 1.5rem 2rem;
            background: transparent;
            width: 100%;
            box-sizing: border-box;
            margin-top: 0.3rem;
            /* adds breathing room below browser bar */
        }

        header h1 {
            font-family: 'Stardom-Regular';
            font-size: 3rem;
            margin: 0;
        }

        .close-btn {
            position: absolute;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #000;
            font-size: 3rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .close-btn:hover {
            color: #b33939;
        }
    </style>
</head>

<body>
    <header>
        <h1>QUALITEES</h1>
        <a href="./homepage.php" class="close-btn"><i class="bi bi-x-lg"></i></a>
    </header>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>