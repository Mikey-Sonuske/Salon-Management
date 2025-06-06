<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $contno = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $ret = mysqli_query($con, "select Email from tbluser where Email='$email' || MobileNumber='$contno'");
    $result = mysqli_fetch_array($ret);
    if ($result > 0) {

        echo "<script>alert('This email or Contact Number already associated with another account!.');</script>";
    } else {
        $query = mysqli_query($con, "insert into tbluser(FirstName, LastName, MobileNumber, Email, Password) value('$fname', '$lname','$contno', '$email', '$password' )");
         if ($query) {
            // Get the user ID of the newly registered user
            $userid = mysqli_insert_id($con);
            
            // Set session variables
            $_SESSION['bpmsuid'] = $userid;
            $_SESSION['login'] = $email;
            
            echo "<script>alert('You have successfully registered!');</script>";
            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>


    <title>Vio Salon and Spa | Signup Page</title>

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
            if (document.signup.password.value != document.signup.repeatpassword.value) {
                alert('Password and Repeat Password field does not match');
                document.signup.repeatpassword.focus();
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
                    <li class="active ">Sign up</li>
                </ul>
            </div>
        </div>
        </div>
    </section>
    <!-- breadcrumbs //-->
     <h3 class="sectiontitle">Sign up today!</h3>
    <section class="w3l-contact-info-main" id="contact">
        <div class="contact-sec	">
            <div class="container">

                <!--<div class="d-grid contact-view">
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
                        -->
                    <div class="details">
 <div class="map-content-9 mt-lg-0 mt-4">
    <p>If already registered, click<a href="login.php"> here</a> to login</p>
                        <p>Register with us to start enjoying the benefits of being a member!!</p>
                        <form method="post" name="signup" onsubmit="return checkpass();">

                            <div style="padding-top: 30px;">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required="">
                            </div>
                            <div style="padding-top: 30px;">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required="">
                            </div>
                            <div style="padding-top: 30px;">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Mobile Number" required="" name="mobilenumber" pattern="[0-9]+" maxlength="10">
                            </div>
                            <div style="padding-top: 30px;">
                                <label>Email address</label>
                                <input type="email" class="form-control" class="form-control" placeholder="Email address" required="" name="email">
                            </div>
                            <div style="padding-top: 30px;">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required="true">
                            </div>
                            <div style="padding-top: 30px;">
                                <label>Repeat password</label>
                                <input type="password" class="form-control" name="repeatpassword" placeholder="Repeat password" required="true">
                            </div>

                            <button type="submit" class="btn btn-contact" name="submit">Signup</button>
                        </form>
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
        .details {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);

        }

        .w3l-contact-info-main .contact-sec {
            padding: 100px 0px 100px;
        }

        .w3l-contact-info-main .twice-two {
            display: grid;
            grid-gap: 20px;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 40px;

        }

        .container {
            max-width: 70%;
        }

        .w3l-contact-info-main button.btn-contact {
            margin: 50px 0px;

        }

        .sectiontitle {
            text-align: center;
            font-size: 2rem;
            color: purple;
            padding: 20px 0px 0px;
        }

        .w3l-contact-info-main button.btn-contact {
            padding: 15px 30px;
            margin: 50px auto 0;
            color: #fff;
            background: rgba(221, 103, 245, 0.65);
        }


        .w3l-contact-info-main .contact-sec {
            padding: 20px 0px 100px;
        }

        p {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 20px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
    </style>


    <!-- /move top -->
</body>

</html>