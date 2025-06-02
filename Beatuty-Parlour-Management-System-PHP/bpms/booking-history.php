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


        <title>Vio Salon and Spa| Booking History</title>

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
                        <li class="Booking History ">Booking History</li>
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
                            <!--<div class="table-content table-responsive cart-table-content m-t-30">
                                <h4 style="padding-bottom: 20px;text-align: center;color: blue;">Booking History</h4>
                                <table border="2" class="table">
                                    <thead class="gray-bg">
                                        <tr>
                                            <th>#</th>
                                            <th>Appointment Number</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Time</th>
                                            <th>Appointment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <?php
                                            $userid = $_SESSION['bpmsuid'];
                                            $query = mysqli_query($con, "select tbluser.ID as uid, tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tblbook.ID as bid,tblbook.AptNumber,tblbook.AptDate,tblbook.AptTime,tblbook.Message,tblbook.BookingDate,tblbook.Status from tblbook join tbluser on tbluser.ID=tblbook.UserID where tbluser.ID='$userid'");
                                            $cnt = 1;
                                            $count = mysqli_num_rows($query);
                                            if ($count > 0) {
                                                while ($row = mysqli_fetch_array($query)) { ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row['AptNumber']; ?></td>
                                            <td>
                                                <p> <?php echo $row['AptDate'] ?> </p>
                                            </td>
                                            <td><?php echo $row['AptTime'] ?></td>
                                            <td><?php $status = $row['Status'];
                                                    if ($status == '') {
                                                        echo "Waiting for confirmation";
                                                    } else {
                                                        echo $status;
                                                    }
                                                ?> </td>

                                            <td><a href="appointment-detail.php?aptnumber=<?php echo $row['AptNumber']; ?>" class="btn btn-primary">View</a></td>
                                        </tr><?php $cnt = $cnt + 1;
                                                }
                                            } else { ?>
                                    <tr>
                                        <th colspan="6" style="color:red">No Record Found</th>
                                    </tr>

                                <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                                            -->
                            <div class="booking-history-table">
                                <h4 class="history-title">Booking History</h4>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Appointment Number</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $userid = $_SESSION['bpmsuid'];
                                        $query = mysqli_query($con, "select tbluser.ID as uid, tbluser.FirstName,tbluser.LastName,tbluser.Email,tbluser.MobileNumber,tblbook.ID as bid,tblbook.AptNumber,tblbook.AptDate,tblbook.AptTime,tblbook.Message,tblbook.BookingDate,tblbook.Status from tblbook join tbluser on tbluser.ID=tblbook.UserID where tbluser.ID='$userid'");
                                        $cnt = 1;
                                        $count = mysqli_num_rows($query);
                                        if ($count > 0) {
                                            while ($row = mysqli_fetch_array($query)) { ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['AptNumber']; ?></td>
                                                    <td><?php echo $row['AptDate']; ?></td>
                                                    <td><?php echo $row['AptTime']; ?></td>
                                                    <td class="status-waiting">
                                                        <?php
                                                        $status = $row['Status'];
                                                        echo $status == '' ? "Waiting for confirmation" : $status;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="appointment-detail.php?aptnumber=<?php echo $row['AptNumber']; ?>"
                                                            class="btn-view">View</a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $cnt++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="6" style="text-align: center; color: #8B4B8B;">No Record Found</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    
                                </table>
                                 
                            </div>
                            
                        </div>
<a href="index.php" class="btn btn-danger">Done</a>
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
            .booking-history-table {
                box-shadow: 20px 20px 50px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                overflow: hidden;
                margin: 2rem 2rem;
            }

            .booking-history-table table {
                width: 100%;
                border-collapse: collapse;
                background: #fff;
            }

            .booking-history-table th {
                background: linear-gradient(100deg, #FF69B4, #FFB6C1);
                color: white;
                padding: 15px;
                text-align: left;
                font-weight: 600;
            }

            .booking-history-table td {
                padding: 12px 15px;
                border-bottom: 1px solid #f0f0f0;
            }

            .booking-history-table tbody tr:hover {
                background-color: #fcf3f9;
            }

            .booking-history-table .status-waiting {
                color: #8B4B8B;
                font-weight: 600;
            }

            .booking-history-table .btn-view {
                background: #FF69B4;
                color: white;
                padding: 8px 20px;
                border-radius: 5px;
                border: none;
                transition: all 0.3s ease;
            }

            .booking-history-table .btn-view:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(139, 75, 139, 0.3);
            }

            .history-title {
                color: #8B4B8B;
                text-align: center;
                margin-top: 20px;
                margin-bottom: 30px;
                font-size: 2rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            .w3l-contact-info-main .contact-sec {
                padding: 10px 0px 50px;
            }
        </style>
        <!-- /move top -->
    </body>

    </html><?php } ?>