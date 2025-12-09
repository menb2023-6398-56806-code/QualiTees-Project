<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUALITEES | Header</title>
  <link rel="icon" href="./media/icon.png" type="icon.png">

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    var user = "<?php echo htmlspecialchars($_SESSION['firstname'] ?? ''); ?>";


    $(document).ready(function() {
      // Search ENTER Function
      $(".search-box input").on("keypress", function(e) {
        if (e.which === 13) {
          let q = $(this).val().trim();
          if (q !== "") {
            window.location.href = "itemsort.php?search=" + encodeURIComponent(q);
          }
        }
      });

      // Search ICON click function
      $(".search-box i").on("click", function() {
        let q = $(".search-box input").val().trim();
        if (q !== "") {
          window.location.href = "itemsort.php?search=" + encodeURIComponent(q);
        }
      });

      // Helper to show dropdown content
      function showDropdown(contentHtml) {
        $("#headerDropdown").html(contentHtml).fadeIn(150);
      }

      // Icon click handlers
      $(".bi-cart-fill").on("click", function(e) {
        e.stopPropagation();
        showDropdown(`
          <div class="dropdown-box">
            <h5>Cart</h5>
            <hr>
            <div class="dropdown-content">
              <p>itemName</p>
            </div>
          </div>
        `);
      });

      $(".bi-person-circle").on("click", function(e) {
        e.stopPropagation();
        showDropdown(`
          <div class="dropdown-box">
            <h5>Hello, ${user}</h5>
            <hr>
            <div class="dropdown-content">
              <a href="#">Profile</a><br>
              <a href="./orderedxhistory.php#oOrdered">Items Ordered</a><br>
              <a href="orderedxhistory.php#oHistory">Order History</a><br>
              <a href="logout.php" class="text-danger">Log Out</a>
            </div>
          </div>
        `);
      });

      // Close when clicking outside
      $(document).on("click", function(e) {
        if (!$(e.target).closest("#headerDropdown").length) {
          $("#headerDropdown").fadeOut(150);
        }
      });
    });
  </script>

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

    /* Dropdown */
    .header-dropdown {
      position: absolute;
      top: 0px;
      right: 0;
      max-width: 400px;
      min-width: 200px;
      background: #f8f8f8;
      border-radius: 12px;
      z-index: 999;
      display: none;
    }

    .dropdown-box {
      background: white;
      border-radius: 10px;
      padding: 20px;
      font-family: 'Poppins', sans-serif;
    }

    .dropdown-box h5 {
      margin-bottom: 15px;
      font-weight: 600;
    }

    .dropdown-box a {
      text-decoration: none;
      color: black;
      font-size: 0.95rem;
    }

    .dropdown-box a:hover {
      color: #b33939;
    }

    /* Search */
    .search-box {
      display: flex;
      align-items: center;
      gap: 8px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 3px;
    }

    .search-box input {
      border: none;
      outline: none;
      font-family: 'Poppins', sans-serif;
      font-size: 0.9rem;
      width: 160px;
      background: transparent;
    }

    .search-box i {
      color: black;
      font-size: 1.2rem;
      cursor: pointer;
    }

    .search-box i:hover {
      color: #b33939;
    }

    .nav-icons i {
      color: black;
      font-size: 1.2rem;
      cursor: pointer;
      transition: color 0.2s ease;
    }

    /* Hover effect */
    .nav-icons i:hover {
      color: #b33939;
    }

    /* Active (clicked) effect */
    .nav-icons i.active {
      color: #b33939;
    }
  </style>
</head>

<body>
  <nav class="navbar py-2 shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">
      <!-- Logo -->
      <a class="navbar-brand" href="./homepage.php">
        <img src="./media/logo.png" alt="Logo" class="img-fluid">
      </a>

      <!-- Categories -->
      <ul class="navbar-nav d-flex flex-row mb-0">
        <li class="nav-item"><a class="nav-link" href="./homepage.php">HOME</a></li>
        <li class="nav-item"><a class="nav-link" href="./itemsort.php?search=&sort=chronological&category=JEWELRY">JEWELRY</a></li>
        <li class="nav-item"><a class="nav-link" href="./itemsort.php?search=&sort=chronological&category=FINE+ARTS">FINE ARTS</a></li>
        <li class="nav-item"><a class="nav-link" href="./itemsort.php?search=&sort=chronological&category=CARS">CARS</a></li>
        <li class="nav-item"><a class="nav-link" href="./itemsort.php?search=&sort=chronological&category=WATCHES">WATCHES</a></li>
        <li class="nav-item"><a class="nav-link" href="./itemsort.php?search=&sort=chronological&category=OTHERS">OTHERS</a></li>
      </ul>

      <!-- Right Side: Search + Icons -->
      <div class="d-flex align-items-center gap-4 nav-icons">
        <div class="search-box">
          <input type="text" placeholder="Search...">
          <i class="bi bi-search"></i>
        </div>
        <i class="bi bi-cart-fill"></i>
        <i class="bi bi-person-circle"></i>
      </div>


    </div>
  </nav>

  <!-- Dropdown container -->
  <div class="container position-relative">
    <div id="headerDropdown" class="header-dropdown shadow"></div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
  //JS
  $(".nav-icons i").on("click", function(e) {
    e.stopPropagation();
    // remove active from all icons
    $(".nav-icons i").removeClass("active");
    // add active to the clicked one
    $(this).addClass("active");
  });
</script>

</html>