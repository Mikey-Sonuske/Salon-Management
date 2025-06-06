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


    <title>Vio Salon and Spa| Invoice History</title>

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
            </li>
            <li class="active ">Invoice History</li>
          </ul>
        </div>
      </div>
      </div>
    </section>

    <!-- breadcrumbs //-->
          <section class="w3l-contact-info-main" id="contact">
            <div class="contact-sec	">
              <div class="container">
                <p>You receive an invoice immediately after you have been served at our salon</p>
                <br>
                <div>
                  <div class="cont-details">
                    <div class="table-content table-responsive cart-table-content">
                      <h4 style="padding-bottom: 20px;text-align: center;color: purple;">Invoice History</h4>
                      <table class="table" border="1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Invoice Id</th>
                            <th>Customer Name</th>
                            <th>Customer Mobile Number</th>
                            <th>Invoice Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <tr>
                            <?php
                            $userid = $_SESSION['bpmsuid'];
                            $query = mysqli_query($con, "select distinct tbluser.ID as uid, tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tblinvoice.BillingId,date(tblinvoice.PostingDate) as PostingDate  from  tbluser   
    join tblinvoice on tbluser.ID=tblinvoice.Userid where tbluser.ID='$userid'order by tblinvoice.ID desc");
                            $cnt = 1;
                            $count = mysqli_num_rows($query);
                            if ($count > 0) {
                              while ($row = mysqli_fetch_array($query)) { ?>
                          <tr>
                            <th scope="row"><?php echo $cnt; ?></th>
                            <td><?php echo $row['BillingId']; ?></td>
                            <td><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
                            <td><?php echo $row['MobileNumber']; ?></td>
                            <td><?php echo $row['PostingDate']; ?></td>
                            <td><a href="view-invoice.php?invoiceid=<?php echo $row['BillingId']; ?>" class="btn btn-info">View</a></td>

                          </tr><?php $cnt = $cnt + 1;
                              }
                            } else { ?>
                        <tr>
                          <th colspan="6" style="color:red">No Record Found</th>
                        </tr>

                      <?php } ?>

                        </tbody>
                      </table>
                      <p><a href="index.php" class="btn btn-danger">Done</a></p>
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
          <!-- /move top -->
  </body>

  </html><?php } ?>