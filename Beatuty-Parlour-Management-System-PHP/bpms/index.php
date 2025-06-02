<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

?>
<!doctype html>
<html lang="en">

<head>

  <title>Vio Hair salon and Spa| Home Page</title>

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-starter.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body id="home">

  <?php include_once('includes/header.php'); ?>

  <script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->
  <!--bootstrap working-->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- //bootstrap working-->
  <!-- disable body scroll which navbar is in active -->
  <script>
    $(function() {
      $('.navbar-toggler').click(function() {
        $('body').toggleClass('noscroll');
      })
    });
  </script>
  <!-- disable body scroll which navbar is in active -->

  <section class="homebanner">
    <div class="container">
      <div class="banner-text">
        <div class="landtext">
          <h3>Vio Hair Salon and Spa</h3>
          <h4>We make your hair dreams<br>
            come true</h4>
        </div>
        <a href="book-appointment.php" class="btn logo-button top-margin">Book an Appointment</a>
      </div>
    </div>
  </section>

  <!--
  <div class="w3l-hero-headers-9">
    <div class="css-slider">
      <input id="slide-1" type="radio" name="slides" checked>
      <section class="slide slide-one">
        <div class="container">
          <div class="banner-text">
            <h3>Vio Hair Salon and Spa</h3>
            <h4>We make your hair dreams<br>
              come true</h4>

            <a href="book-appointment.php" class="btn logo-button top-margin">Book an Appointment</a>
          </div>
        </div>

      </section>
      <input id="slide-2" type="radio" name="slides">
      <section class="slide slide-two">
        <div class="container">
          <div class="banner-text">
            <h3>Vio Hair Salon and Spa</h3>
            <h4 class="cta sectiontitle">We make your hair dreams<br>
              come true</h4>

            <a href="book-appointment.php" class="btn logo-button top-margin">Book an Appointment</a>
          </div>
        </div>
        <nav>
        <label for="slide-2" class="prev">&#10094;</label>
        <label for="slide-1" class="next">&#10095;</label>
      </nav> 
      </section>
      <header>
        <label for="slide-1" id="slide-1"></label>
        <label for="slide-2" id="slide-2"></label>
      </header>
    </div>
  </div>
  -->

  <h3 class="sectiontitle">Offers of the day</h3>
  <section class="w3l-call-to-action_9">
    <div class="call-w3 ">
      <div class="container">
        <div class="grids">
          <div class="grids-content row">

            <div class="column col-lg-4 col-md-6 color-2 ">
              <div>
                <h4 class="sectiontitle cta">Offering you professional services at an affordable cost</h4>

                <p class="para "> The Iconic Afro Cut!
                  Rock your roots with style — bold, beautiful, and unapologetically YOU.
                  ✨ Get 20% OFF today only!

                  Walk in or book now — let your crown shine. At a subsized cost, get the afro that'll last longer than the usual fros you have seen and probably tried
                </p>
                <a href="about.php" class="action-button btn mt-md-4 mt-3">Read more</a>
              </div>
            </div>
            <div class="column col-lg-4 col-md-6 col-sm-6 back-image  ">
              <img src="assets/images/afro.jpg" alt="product" class="img-responsive ">
            </div>
            <div class="column col-lg-4 col-md-6 col-sm-6 back-image2 ">
              <img src="assets/images/saoon.jpg" alt="product" class="img-responsive ">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <h3 class="sectiontitle">Account exclusivity</h3>
  <section class="w3l-teams-15">
    <div class="team-single-main ">
      <div class="container">

        <div class="column2 image-text">
          <h3 class="team-head ">Create an account with us </h3>
          <p class="para  text ">
            Make sure not to miss out on these benefits</p>

          <ul class="aelist">
            <br>
            <li><span class="fa fa-check" aria-hidden="true"></span> Instant invoices</li>
            <br>
            <li><span class="fa fa-check" aria-hidden="true"></span> Booking history</li>
            <br>
            <li><span class="fa fa-check" aria-hidden="true"></span> Profile settings</li>
            <br>
            <li><span class="fa fa-check" aria-hidden="true"></span> Discounts</li>
            <br>
            <li><span class="fa fa-check" aria-hidden="true"></span> Loyalty points</li>
          </ul>
          <br>

          <a href="signup.php" class="btn logo-button top-margin mt-4">Sign up now</a>
        </div>
      </div>
    </div>
    </div>
  </section>

  <h3 class="sectiontitle">Services we offer</h3>
  <section class="w3l-specification-6">
    <div class="specification-layout ">
      <div class="container">
        <div class=" row">
          <div class="col-lg-6 back-image">
            <img src="assets/my images/supplies.jpg" alt="product" class="img-responsive ">
          </div>
          <div class="col-lg-6 about-right-faq align-self">
            <h3 class="title-big"><a href="services.php">Vio Hair Salon: Offering Quality at a friendly price</a></h3>
            <p class="mt-3 para">Our array of beauty parlour services include :</p>
            <div class="hair-cut">
              <div>
                <ul class="w3l-right-book">
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Hair wash with Blow dry</a></li>
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Hair relaxing</a></li>
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Braiding</a></li>
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Curling</a></li>
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Locs</a></li>
                </ul>
              </div>
              <div class="image-right">
                <ul class="w3l-right-book">
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Make-up</a></li>
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Nails</a></li>
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Face Massage</a></li>
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Skin Care</a></li>
                  <li><span class="fa fa-check" aria-hidden="true"></span><a href="services.php">Body Therapy</a></li>
                </ul>
              </div>
              <a href="services.php" class="action-button btn mt-md-4 mt-3">View other services</a>
            </div>
          </div>

  </section>

  <h3 class="sectiontitle">Hot deals of the week</h3>
<section class="w3l-member-deals">
    <div class="container">
        <div class="deals-wrapper">
            <?php 
            if (isset($_SESSION['bpmsuid'])) {
                $ret = mysqli_query($con, "SELECT * FROM tblservices WHERE Discount > 0");
                if(mysqli_num_rows($ret) > 0) { ?>
                    <div class="row">
                        <?php while ($row = mysqli_fetch_array($ret)) {
                            $discountedPrice = $row['Cost'] - ($row['Cost'] * $row['Discount'] / 100);
                        ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="deal-card">
                                    <img src="admin/images/<?php echo $row['Image']; ?>" 
                                         alt="<?php echo $row['ServiceName']; ?>" 
                                         class="deal-image">
                                    <div class="deal-content">
                                        <h4><?php echo $row['ServiceName']; ?></h4>
                                        <div class="price-section">
                                            <span class="original-price"> Was Ksh <?php echo number_format($row['Cost'], 2); ?></span><br>
                                            <span class="final-price">NOW Ksh <?php echo number_format($discountedPrice); ?></span>
                                        </div><br>
                                        <a href="book-appointment.php?service_id=<?php echo $row['ID']; ?>" 
                                           class="btn logo-button">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="no-deals-message">
                        <h4>No deals available at the moment</h4>
                        <p>Check back later for exclusive member discounts!</p>
                    </div>
                <?php }
            } else { ?>
                <div class="member-login-prompt">
                    <h4>Member Exclusive Deals Available!</h4>
                    <p>Log in to view special discounts and offers available only to our members.</p>
                    <div class="prompt-buttons">
                        <a href="login.php" class="btn logo-button">Login</a>
                        <a href="signup.php" class="btn logo-button">Sign Up</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

  <?php include_once('includes/footer.php'); ?>
  <!-- move top -->
  <button onclick="topFunction()" id="movetop" title="Go to top">
    <span class="fa fa-long-arrow-up"></span>
  </button>
  <script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
      scrollFunction()
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("movetop").style.display = "block";
      } else {
        document.getElementById("movetop").style.display = "none";
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>
  <style>
    .homebanner {
      background-image: url("assets/my images/dark makeup.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      width: 100%;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;

    }
.landtext{
  color: purple;
  font-weight: 900;
}

    .sectiontitle {
      text-align: center;
      margin: 40px 0;
      font-size: 2.8rem;
      font-weight: 500;
      color: #333;
      /* margin-bottom:-3rem; */
    }

    .aelist {
      position: relative;
      color: purple;
      font-size: large;
    }

    .aelist li {
      margin: 0px 0;
    }

    h4 {
      font-size: 2rem;
      margin-bottom: 20px;
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }
  </style>
  <!-- /move top -->
</body>

</html>