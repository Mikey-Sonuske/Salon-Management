<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsuid'] == 0)) {
  header('location:logout.php');
} else {



?>
  <!doctype html>
  <html lang="en">

  <head>


    <title>Vio salon and Spa | Thank You page</title>

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

    <!-- breadcrumbs -->
   <section class="w3l-inner-banner-main">
        <div class="breadcrumbs-sub">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a>
                        <p>
                    </li>
                    <li class="right-side propClone"><a href="book-appointment.php" class="">Book Now<span class="fa fa-angle-right" aria-hidden="true"></span></a>
                    </li>
                    <li class="active ">Thank you</li>
                </ul>
            </div>
        </div>
        </div>
    </section>
    <!-- breadcrumbs //-->
    <section class="w3l-contact-info-main" id="contact">
      <div class="contact-sec	">
        <div class="container">

          <div>


            <h4 class="w3ls_head">Thank you for applying. Your Appointment no is <?php echo $_SESSION['aptno']; ?> </h4><br>
            <p class="w3ls_para">We will contact you soon.</p><br>
            <p class="w3ls_para">You can check your appointment status in Booking history page.</p><br>
            <p class="w3ls_para">You can also check your appointment status by clicking the button below.</p><br>
            <a href="booking-history.php" class="btn logo-button top-margin">Check Appointment Status</a>

          </div>

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
    <!-- /move top -->
  </body>

  </html><?php } ?>