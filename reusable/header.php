<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUALITEES | Header</title>
    <link rel="icon" href="../media/icon.png" type="icon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
            max-height: 50px;
        }

        .nav-link {
            color: black !important;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 1px;
            padding: 0.5rem 1rem !important;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #b33939 !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #b33939;
        }

        .icon-btn i {
            font-size: 1.25rem;
            color: black;
            transition: color 0.2s ease;
        }

        .icon-btn i:hover {
            color: #b33939;
        }

        @media (max-width: 991px) {
            .navbar-nav {
                display: none !important;
            }
        }
    </style>
</head>
<body>

  <nav class="navbar py-2 shadow-sm">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a class="navbar-brand" href="../client/homepage.php">
                <img src="../media/logo.png" alt="Logo" class="img-fluid">
            </a>

            <!-- Categories -->
            <ul class="navbar-nav d-flex flex-row mb-0">
            <li class="nav-item"><a class="nav-link active" href="#">NEW</a></li>
            <li class="nav-item"><a class="nav-link" href="#">JEWELRY</a></li>
            <li class="nav-item"><a class="nav-link" href="#">FINE ARTS</a></li>
            <li class="nav-item"><a class="nav-link" href="#">CARS</a></li>
            <li class="nav-item"><a class="nav-link" href="#">WATCHES</a></li>
            <li class="nav-item"><a class="nav-link" href="#">OTHERS</a></li>
            </ul>

            <!-- Icons -->
            <div class="d-flex align-items-center gap-3">
                <a href="#" class="icon-btn"><i class="bi bi-search"></i></a>
                <a href="#" class="icon-btn"><i class="bi bi-bell-fill"></i></a>
                <a href="#" class="icon-btn"><i class="bi bi-eye"></i></a>
                <a href="#" class="icon-btn"><i class="bi bi-person-circle"></i></a>
            </div>
        </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
