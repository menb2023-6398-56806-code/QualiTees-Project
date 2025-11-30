<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUALITEES | Register</title>
  <link rel="icon" href="./media/icon.png" type="image/png">

  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    @import url('./media/stardom.css');

    body {
      background-color: #ffffff;
      font-family: "Poppins", sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Registration form */
    .register-form {
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

    .btn-register {
      background-color: #b33939 !important;
      color: #fff !important;
      border-radius: 8px;
      padding: 0.75rem;
      width: 100%;
      transition: background 0.3s;
      margin-top: 0.5rem;
    }

    .btn-register:hover {
      background-color: #8e2929 !important;
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

    .password-toggle-btn {
      border: none !important;
      background: transparent !important;
      box-shadow: none !important;
    }

    .password-toggle-btn:focus {
      outline: none !important;
      box-shadow: none !important;
    }

    .password-toggle-btn i {
      font-size: 1.2rem;
      color: #555;
    }

    .password-wrapper {
      position: relative;
    }

    .password-wrapper i {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      font-size: 1.2rem;
      color: #555;
      cursor: pointer;
    }

    .password-wrapper i:hover {
      color: #b33939;
    }
  </style>
</head>

<body>
  <?php include './headerLR.php'; ?>

  <main class="register-form">
    <h2 style="font-family: 'Stardom-Regular'; font-size: 1.5rem; margin-bottom: 1.5rem; text-align: center;">
      Create your account
    </h2>

    <form method="POST" action="register_process.php">

      <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" name="firstname" placeholder="Enter your first name" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control" name="lastname" placeholder="Enter your last name" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" name="address" placeholder="Enter your address" required>

        <div class="mb-3">
          <label class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="password-wrapper">
            <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
            <i class="bi bi-eye-slash" role="button" aria-label="Toggle password" onclick="togglePassword('password', this)"></i>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Confirm Password</label>
          <div class="password-wrapper">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            <i class="bi bi-eye-slash" role="button" aria-label="Toggle confirm password" onclick="togglePassword('confirm_password', this)"></i>
          </div>
        </div>



        <p style="font-size: 0.85rem; text-align: center; margin-bottom: 1rem;">
          By clicking Sign Up you agree to Qualitees
          <a href="#" style="color: #b33939; text-decoration: none;">Terms and Conditions</a>
          and
          <a href="#" style="color: #b33939; text-decoration: none;">Privacy Policy</a>.
        </p>

        <button type="submit" class="btn btn-register">Sign Up</button>
    </form>

    <div class="extra-links">
      <p>Already have an account? <a href="./login.php">Log in</a></p>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function togglePassword(fieldId, el) {
      const input = document.getElementById(fieldId);
      if (!input) return;

      let icon = el;
      if (!icon) {
        icon = input.parentElement && input.parentElement.querySelector('i');
      } else if (icon.tagName && icon.tagName.toLowerCase() !== 'i') {
        const found = icon.querySelector('i');
        if (found) icon = found;
      }

      if (!icon) return;

      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
      } else {
        input.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
      }
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#confirm_password').on('keyup', function() {
        let password = $('#password').val();
        let confirm = $(this).val();

        if (password !== confirm) {
          $(this)[0].setCustomValidity("Passwords do not match.");
        } else {
          $(this)[0].setCustomValidity("");
        }
      });
    });
  </script>

</body>

</html>