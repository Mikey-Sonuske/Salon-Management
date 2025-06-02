<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_GET['action']) && $_GET['action'] == 'cancel') {
  $aptnumber = $_GET['aptnumber'];
  $query = mysqli_query($con, "update tblbook set Status='Cancelled' where AptNumber='$aptnumber'");
  if ($query) {
    echo "<script>alert('Your appointment has been cancelled successfully.');</script>";
    echo "<script>window.location.href='booking-history.php'</script>";
  } else {
    echo "<script>alert('Something went wrong. Please try again later.');</script>";
  }
}

if (strlen($_SESSION['bpmsuid'] == 0)) {
  header('location:logout.php');
} else {



?>
  <!doctype html>
  <html lang="en">

  <head>


    <title>Beauty Parlour Management System | Booking History</title>

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
            <li class="right-side propClone"><a href="booking-history.php" class="">Booking History <span class="fa fa-angle-right" aria-hidden="true"></span></a>
                    </li>
            <li class="active ">Appointment details</li>
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
            <div class="cont-details">
              <div class="table-content table-responsive cart-table-content m-t-30">
                <h3 style="padding-bottom: 20px;text-align: center;color: purple;">Appointment Details</h4>
                <?php
                $cid = $_GET['aptnumber'];
                $ret = mysqli_query($con, "select tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tblbook.ID as bid,tblbook.AptNumber,tblbook.AptDate,tblbook.AptTime,tblbook.Message,tblbook.BookingDate,tblbook.Remark,tblbook.Status,tblbook.RemarkDate from tblbook join tbluser on tbluser.ID=tblbook.UserID where tblbook.AptNumber='$cid'");
                $cnt = 1;
                while ($row = mysqli_fetch_array($ret)) {

                ?>
                  <table class="table table-bordered">
                    <tr>
                      <th>Appointment Number</th>
                      <td><?php echo $row['AptNumber']; ?></td>
                    </tr>
                    <tr>
                      <th>Name</th>
                      <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                    </tr>

                    <tr>
                      <th>Email</th>
                      <td><?php echo $row['Email']; ?></td>
                    </tr>
                    <tr>
                      <th>Mobile Number</th>
                      <td><?php echo $row['MobileNumber']; ?></td>
                    </tr>
                    <tr>
                      <th>Appointment Date</th>
                      <td><?php echo $row['AptDate']; ?></td>
                    </tr>

                    <tr>
                      <th>Appointment Time</th>
                      <td><?php echo $row['AptTime']; ?></td>
                    </tr>


                    <tr>
                      <th>Apply Date</th>
                      <td><?php echo $row['BookingDate']; ?></td>
                    </tr>


                    <tr>
                      <th>Status</th>
                      <td> <?php
                            if ($row['Status'] == "") {
                              echo "Not Updated Yet";
                            }

                            if ($row['Status'] == "Selected") {
                              echo "Selected";
                            }

                            if ($row['Status'] == "Rejected") {
                              echo "Rejected";
                            }; ?></td>
                    </tr>
                    <tr>
                      <th>Action</th>
                      <td>
                        <?php if ($row['Status'] == "" || $row['Status'] == "Selected") { ?>
                          <a href="?aptnumber=<?php echo $row['AptNumber']; ?>&action=cancel"
                            onclick="return confirm('Are you sure you want to cancel this appointment?')"
                            class="btn btn-danger">Cancel Appointment</a>
                        <?php } else { ?>
                          <span class="text-danger">Appointment <?php echo $row['Status']; ?></span>
                        <?php } ?>
                      </td>
                    </tr>
                  </table><?php } ?>
              </div>
            </div>

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

    <style>
      .table-content {
        max-width: 800px;
        margin: auto auto;
        padding: 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      }

      .table-bordered {
        border: 2px solid purple;
      }

      .table-bordered th {
        color: b;
        padding: 15px;
        width: 200px;
        border: purple 2px solid;
      }

      .table-bordered td {
        padding: 15px;
        border: purple 2px solid;
        color: #666;
      }

      .appointment-title {
        color: #FF69B4;
        text-align: center;
        margin-bottom: 30px;
        font-size: 2rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
      }

      .btn-danger {
        background: #FF69B4;
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
      }

      .btn-danger:hover {
        background: #FF1493;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
      }

      .text-danger {
        color: #FF69B4;
        font-weight: 600;
      }

      .w3l-contact-info-main {
        background: #fdf6f8;
        padding: 10px 50;
      }
      .w3l-contact-info-main .contact-sec {
    padding: 10px 0px 50px;
}
    </style>
    <!-- /move top -->
  </body>

  </html><?php } ?>