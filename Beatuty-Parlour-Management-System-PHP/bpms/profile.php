<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsuid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $uid = $_SESSION['bpmsuid'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $query = mysqli_query($con, "update tbluser set FirstName='$fname', LastName='$lname' where ID='$uid'");


        if ($query) {
            echo '<script>alert("Profile updated successully.")</script>';
            echo '<script>window.location.href=profile.php</script>';
        } else {

            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        }
    }

    if (isset($_POST['change'])) {
        $userid = $_SESSION['bpmsuid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $query1 = mysqli_query($con, "select ID from tbluser where ID='$userid' and   Password='$cpassword'");
        $row = mysqli_fetch_array($query1);
        if ($row > 0) {
            $ret = mysqli_query($con, "update tbluser set Password='$newpassword' where ID='$userid'");

            echo '<script>alert("Your password successully changed.")</script>';
        } else {
            echo '<script>alert("Your current password is wrong.")</script>';
        }
    }



?>
    <!doctype html>
    <html lang="en">

    <head>


        <title>Vio Salon and Spa | Profile Page</title>

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
        <script type="text/javascript">
            function checkpass() {
                if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                    alert('New Password and Confirm Password field does not match');
                    document.changepassword.confirmpassword.focus();
                    return false;
                }
                return true;
            }
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
                        <li class="active ">Profile settings</li>
                    </ul>
                </div>
            </div>
            </div>
        </section>
        <!-- breadcrumbs //-->
        <section class="w3l-contact-info-main" id="contact">
            <div class="contact-sec	">
                <div class="container">                    
                        <!--<div class="d-grid contact-view"></div>
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
                        </div>-->
                        <div class="profile-container" style="display: flex; gap: 30px; margin-top: 30px;">
                            <!-- Password Change Section -->
                            <div class="profile-section">
                                <h3>Password Change</h3>
                                <form method="post" name="changepassword" onsubmit="return checkpass();">
                                    <div style="padding-top: 20px;">
                                        <label>Current Password</label>
                                        <input type="password" class="form-control" placeholder="Current Password" id="currentpassword" name="currentpassword" required="true">
                                    </div>
                                    <div style="padding-top: 20px;">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" placeholder="New Password" id="newpassword" name="newpassword" required="true">
                                    </div>
                                    <div style="padding-top: 20px;">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required="true">
                                    </div>
                                    <button type="submit" class="btn btn-contact" name="change">Update Password</button>
                                </form>
                            </div>
                            <div class="profile-section">
                                <h3>User Profile</h3>
                                <form method="post" name="signup">
                                    <?php
                                    $uid = $_SESSION['bpmsuid'];
                                    $ret = mysqli_query($con, "select * from tbluser where ID='$uid'");
                                    while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                        <div style="padding-top: 20px;">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="firstname" value="<?php echo $row['FirstName']; ?>" required="true">
                                        </div>
                                        <div style="padding-top: 20px;">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="lastname" value="<?php echo $row['LastName']; ?>" required="true">
                                        </div>
                                        <div style="padding-top: 20px;">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control" name="mobilenumber" value="<?php echo $row['MobileNumber']; ?>" readonly="true">
                                        </div>
                                        <div style="padding-top: 20px;">
                                            <label>Email address</label>
                                            <input type="text" class="form-control" name="email" value="<?php echo $row['Email']; ?>" readonly="true">
                                        </div>
                                        <div style="padding-top: 20px;">
                                            <label>Registration Date</label>
                                            <input type="text" class="form-control" name="regdate" value="<?php echo $row['RegDate']; ?>" readonly="true">
                                        </div>
                                    <?php } ?>
                                    <button type="submit" class="btn btn-contact" name="submit">Update Profile</button>
                                </form>
                            </div>
                        </div>

                        <!--  <div class="map-content-9 mt-lg-0 mt-4">
                            <h3>User Profile!!</h3>
                            <form method="post" name="signup" onsubmit="return checkpass();">
                                <?php
                                $uid = $_SESSION['bpmsuid'];
                                $ret = mysqli_query($con, "select * from tbluser where ID='$uid'");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {

                                ?>
                                    <div style="padding-top: 30px;">
                                        <label>First Name</label>

                                        <input type="text" class="form-control" name="firstname" value="<?php echo $row['FirstName']; ?>" required="true">
                                    </div>
                                    <div style="padding-top: 30px;">
                                        <label>Last Name</label>

                                        <input type="text" class="form-control" name="lastname" value="<?php echo $row['LastName']; ?>" required="true">
                                    </div>
                                    <div style="padding-top: 30px;">
                                        <label>Mobile Number</label>

                                        <input type="text" class="form-control" name="mobilenumber" value="<?php echo $row['MobileNumber']; ?>" readonly="true">
                                    </div>
                                    <div style="padding-top: 30px;">
                                        <label>Email address</label>

                                        <input type="text" class="form-control" name="email" value="<?php echo $row['Email']; ?>" readonly="true">
                                    </div>
                                    <div style="padding-top: 30px;">
                                        <label>Registration Date</label>

                                        <input type="text" class="form-control" name="regdate" value="<?php echo $row['RegDate']; ?>" readonly="true">
                                    </div>

                                <?php } ?>
                                <button type="submit" class="btn btn-contact" name="submit">Save Change</button>
                            </form>
                        </div>-->                  

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
       <!-- <style>
            .profile-container {
                display: flex;
                flex-wrap: wrap;
                gap: 30px;
                margin: 30px auto;
                max-width: 1200px;
            }

            .profile-section {
                flex: 1;
                min-width: 300px;
                background: white;
                padding: 25px;
                border-radius: 8px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .profile-section h3 {
                color: #FF69B4;
                margin-bottom: 20px;
                font-size: 1.5rem;
                text-align: center;
            }

            .btn-contact {
                background: #FF69B4;
                color: white;
                border: none;
                padding: 10px 25px;
                border-radius: 25px;
                margin-top: 20px;
                transition: all 0.3s ease;
            }

            .btn-contact:hover {
                background: #FF1493;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
            }

            .form-control {
                margin-top: 5px;
            }

            label {
                color: #666;
                font-weight: 500;
            }
        </style>-->
        <style>
.profile-container {
    display: flex;
    flex-direction: row;  /* Force horizontal layout */
    justify-content: space-between;  /* Space between sections */
    gap: 30px;
    margin: 30px auto;
    max-width: 1200px;
}

.profile-section {
    flex: 0 1 48%;  /* Don't allow sections to grow, but allow shrink, take 48% width */
    min-width: 300px;
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

/* Ensure responsiveness */
@media (max-width: 768px) {
    .profile-container {
        flex-direction: column;
    }
    
    .profile-section {
        flex: 1 1 100%;
        margin-bottom: 20px;
    }
}

/* Rest of your existing styles remain the same */
.profile-section h3 {
    color: #FF69B4;
    margin-bottom: 20px;
    font-size: 1.5rem;
    text-align: center;
}

.btn-contact {
    background: #FF69B4;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 25px;
    margin-top: 20px;
    transition: all 0.3s ease;
    width: 100%;  /* Make buttons full width */
}

.btn-contact:hover {
    background: #FF1493;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
}

.form-control {
    margin-top: 5px;
    width: 100%;
}

label {
    color: #666;
    font-weight: 500;
    display: block;
}
</style>
        <!-- /move top -->
    </body>

    </html><?php } ?>