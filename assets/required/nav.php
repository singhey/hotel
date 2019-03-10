<link rel="stylesheet" type="text/css" href="/hotel/assets/css/nav.css">
<script type="text/javascript" src="/hotel/assets/js/nav.js"></script>
<header>
  <div>
    <div class="box">
      <ul>
        <li><a href="/hotel/">Home</a></li>
        <li><a href="/hotel/pages/cities.php">Cities</a></li>
        <li><a href="/hotel/pages/about_us.php">About us</a></li>
        <li><a href="/hotel/pages/contact.php">Contact</a></li>
        <?php
          if(!isset($_SESSION['username'])):
        ?>
        <li class="right"><a href="/hotel/account/login.php">Login</a></li>
        <li class="right"><a href="/hotel/account/sign_up.php">Sign Up</a></li>
        <?php endif; ?>
        <?php if(isset($_SESSION['username'])): ?>
          <li class="right"><a href="/hotel/account/log_out.php">Log out</a></li>
        <li class="right"><a href="/hotel/account/booked.php">Booked</a></li>
        <li class="right"><a href="/hotel/account/manage.php"><?php echo $_SESSION['username']; ?></a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</header>