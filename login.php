<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUALITEES | Login</title>

  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    @import url('../stardom.css');

    body {
      background-color: #ffffff;
      font-family: "Poppins", sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

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
      /* make X larger */
      text-decoration: none;
      transition: color 0.2s;
    }

    .close-btn:hover {
      color: #b33939;
    }



    /* Login form */
    .login-form {
      width: 100%;
      max-width: 420px;
      margin-top: 5rem;
    }

    .form-control {
      border-radius: 8px;
      padding: 0.75rem;
      font-size: 1rem;
    }

    .form-control:focus {
      border-color: #b33939;
      box-shadow: 0 0 0 0.2rem rgba(179, 57, 57, 0.25);
    }



    .btn-login {
      background-color: #b33939;
      color: #fff;
      border-radius: 8px;
      padding: 0.75rem;
      width: 100%;
      transition: background 0.3s;
      margin-top: 0.5rem;
    }

    .btn-login:hover {
      background-color: #8e2929;
    }

    .extra-links {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .extra-links a {
      color: #b33939;
      text-decoration: none;
    }

    .extra-links a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <header>
    <h1>QUALITEES</h1>
    <a href="./client/homepage.php" class="close-btn"><i class="bi bi-x-lg"></i></a>
  </header>

  <main class="login-form">
    <h2 style="font-family: 'Stardom-Regular'; font-size: 1.5rem; margin-bottom: 1.5rem; text-align: center;">
      Log in to your account
    </h2>
    <form id="loginForm">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
      </div>

      <div class="mb-3 password-wrapper">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
          <span class="input-group-text bg-transparent border-start-0">
            <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
          </span>
        </div>
      </div>

      <button type="submit" class="btn btn-login">Continue</button>
    </form>

    <div class="extra-links">
      <p>Don’t have an account? <a href="#">Sign up</a></p>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Password toggle
    $('#togglePassword').on('click', function() {
      const passwordInput = $('#password');
      const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
      passwordInput.attr('type', type);
      $(this).toggleClass('bi-eye-slash bi-eye');
    });

    // Form submit placeholder
    $('#loginForm').on('submit', function(e) {
      e.preventDefault();
      const email = $('#email').val().trim();
      const password = $('#password').val().trim();

      if (!email || !password) {
        alert('Please fill in all fields.');
        return;
      }

      alert(`Logging in as: ${email}`);
    });
  </script>
</body>

</html>