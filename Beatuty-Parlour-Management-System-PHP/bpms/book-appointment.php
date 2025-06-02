<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsuid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {

        $uid = $_SESSION['bpmsuid'];
        $adate = $_POST['adate'];
        $atime = $_POST['atime'];
        $msg = $_POST['message'];
        $service = $_POST['service'];
        $aptnumber = mt_rand(100000000, 999999999);

        $query = mysqli_query($con, "insert into tblbook(UserID,AptNumber,AptDate,AptTime,Message) values('$uid','$aptnumber','$adate','$atime','$msg')");

        if ($query) {
            $ret = mysqli_query($con, "select AptNumber from tblbook where tblbook.UserID='$uid' order by ID desc limit 1;");
            $result = mysqli_fetch_array($ret);
            $_SESSION['aptno'] = $result['AptNumber'];
            echo "<script>window.location.href='thank-you.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
?>
    <!doctype html>
    <html lang="en">

    <head>


        <title>Vio salon | Appointment Page</title>

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
                        <li class="active ">Book appointment</li>
                    </ul>
                </div>
            </div>
            </div>
        </section>
        <!-- breadcrumbs //-->
        <section class="w3l-contact-info-main" id="contact">
            <div class="contact-sec	">
                <div class="container">
                    <div class="d-grid contact-view">
                        <div class="cont-details">
                            <?php

                            $ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($ret)) {

                            ?>
                                <div class="cont-top">
                                    <div class="cont-left text-center">
                                        <span class="fa fa-phone text-primary"></span>
                                    </div>
                                    <div class="cont-right">
                                        <h6>Call Us</h6>
                                        <p class="para"><a href="tel:+44 99 555 42">+<?php echo $row['MobileNumber']; ?></a></p>
                                    </div>
                                </div>
                                <div class="cont-top margin-up">
                                    <div class="cont-left text-center">
                                        <span class="fa fa-envelope-o text-primary"></span>
                                    </div>
                                    <div class="cont-right">
                                        <h6>Email Us</h6>
                                        <p class="para"><a href="mailto:example@mail.com" class="mail"><?php echo $row['Email']; ?></a></p>
                                    </div>
                                </div>
                                <div class="cont-top margin-up">
                                    <div class="cont-left text-center">
                                        <span class="fa fa-map-marker text-primary"></span>
                                    </div>
                                    <div class="cont-right">
                                        <h6>Address</h6>
                                        <p class="para"> <?php echo $row['PageDescription']; ?></p>
                                    </div>
                                </div>
                                <div class="cont-top margin-up">
                                    <div class="cont-left text-center">
                                        <span class="fa fa-map-marker text-primary"></span>
                                    </div>
                                    <div class="cont-right">
                                        <h6>Time</h6>
                                        <p class="para"> <?php echo $row['Timing']; ?></p>
                                        
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="map-content-9 mt-lg-0 mt-4">
                            <form method="post">
                                <!--I added this part later-->
                                <div style="padding-top: 30px;">
                                    <label>Select Service</label>
                                    <select name="service" id="service" required class="form-control">
                                        <option value="">Choose Service</option>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT * FROM tblservices");
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>
                                            <option value="<?php echo $row['ID']; ?>" data-price="<?php echo $row['Cost']; ?>">
                                                <?php echo $row['ServiceName']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div style="padding-top: 30px;">
                                    <label>Price</label>
                                    <input type="text" class="form-control" id="price" name="price" readonly>
                                </div>
                                <div style="padding-top: 30px;">
                                    <label>Appointment Date</label>
                                    <input type="date" class="form-control appointment_date" placeholder="Date" name="adate" id='adate' required="true">
                                </div>
                                <div style="padding-top: 30px;">
                                    <label>Appointment Time</label><select name="atime" required class="form-control">
                                        <option value="8:00 am">8:00 am</option>
                                        <option value="9:00 am">9:00 am</option>
                                        <option value="10:00 am">10:00 am</option>
                                        <option value="11:00 am">11:00 am</option>
                                        <option value="12:00 pm">12:00 pm</option>
                                        <option value="2:00 pm">2:00 pm</option>
                                        <option value="3:00 pm">3:00 pm</option>
                                        <option value="4:00 pm">4:00 pm</option>
                                        <option value="5:00 pm">5:00 pm</option>
                                        <option value="6:00 pm">6:00 pm</option>
                                        <option value="7:00 pm">7:00 pm</option>
                                    </select>
                                </div>

                                <div style="padding-top: 30px;">
                                    <textarea class="form-control" id="message" name="message" placeholder="Message" required=""></textarea>
                                </div>

                                <button type="submit" class="btn btn-contact" name="submit">Make an Appointment</button>
                            </form>
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
            $(function() {
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                var maxDate = year + '-' + month + '-' + day;
                $('#adate').attr('min', maxDate);
            });
            $(document).ready(function() {
                $('#service').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var price = selectedOption.data('price');
                    $('#price').val(price ? 'KSH ' + price : '');
                });
            });
        </script>
        <!-- /move top -->
    </body>

    </html><?php } ?>