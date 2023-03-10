<?php 
    include("../layouts/header.php");
?>

<link rel="stylesheet" href="../css/style.css">

<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
      <div class="container">
        <a class="navbar-brand text-white" href="#">Fitness Center</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="mx-auto"></div>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white" href="../../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="../../docs/about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="../../docs/shop.php">Pricing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="login.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


<div class="login">
    <div class="container">
        <div class="login-content">
            <div class="login-box">
                <div class="title"><i class="fas fa-key"></i>&nbsp; Password Reset</div>
                <div class="body">
                  <?php 
                    include("../function/function.php");
                    if(isset($_POST['request_otp'])){
                        $result = check_otp_email($_POST['pass_opt_username'], $_POST['pass_opt_email']);
                        echo $result;
                    }

                  ?>
                    <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
                        <p class="form-text">Enter Your Username : </p>
                        <input type="text" name="pass_opt_username" class="form-input" id="otpUsernme" placeholder="Enter Username">
                        <br><br>
                        <p class="form-text">Enter Your Email : </p>
                        <input type="email" name="pass_opt_email" class="form-input" id="otpEmail" placeholder="Enter Email">                                              
                        <br>
                        <input type="submit" value="Request OTP" name="request_otp" class="login-btn">                        
                    </form>
                    <hr>
                    <p>Enter Your Username and Email for get OTP</p>


                    <p class="bottom-by"><i class="far fa-copyright"></i>By Maneesha</p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 
    include("../layouts/footer1.php")    
?>

<script src="../../js/script.js"></script>