<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsuid'] == 0)) {
    header('location:logout.php');
} else {
    $userid = $_SESSION['bpmsuid'];

    // Get user statistics including visit count and total spent
    $query = mysqli_query($con, "SELECT u.*, 
        (SELECT COUNT(DISTINCT ID) FROM tblinvoice WHERE Userid = u.ID) as visit_count,
        (SELECT COALESCE(SUM(Cost), 0) FROM tblinvoice i 
         JOIN tblservices s ON FIND_IN_SET(s.ID, i.ServiceId) 
         WHERE i.Userid = u.ID) as total_spent
        FROM tbluser u 
        WHERE u.ID = '$userid'") or die(mysqli_error($con));
    
    $row = mysqli_fetch_array($query);
    
    // Calculate loyalty points (1 point per 100 shillings spent)
    $loyaltyPoints = floor($row['total_spent'] / 100);
    
    // Update user's loyalty points
    mysqli_query($con, "UPDATE tbluser SET LoyaltyPoints = $loyaltyPoints WHERE ID = '$userid'");
    
    // Get service history with proper joins
    $history_query = mysqli_query($con, "
        SELECT 
            i.PostingDate,
            GROUP_CONCAT(s.ServiceName SEPARATOR ', ') as Services,
            SUM(s.Cost) as TotalAmount,
            FLOOR(SUM(s.Cost)/100) as PointsEarned
        FROM tblinvoice i
        JOIN tblservices s ON FIND_IN_SET(s.ID, i.ServiceId)
        WHERE i.Userid = '$userid'
        GROUP BY i.ID, i.PostingDate
        ORDER BY i.PostingDate DESC
    ") or die(mysqli_error($con));
?>

    <!doctype html>
    <html lang="en">
    <head>
        <title>Vio Salon | My Profile</title>
        <link rel="stylesheet" href="assets/css/style-starter.css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    </head>
    <body id="home">
        <?php include_once('includes/header.php'); ?>

        <section class="w3l-inner-banner-main">
            <div class="breadcrumbs-sub">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a></li>
                        <li class="active">My Profile</li>
                    </ul>
                </div>
            </div>
        </section>

       <div class="dashboard-container">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fa fa-star"></i>
                    <div class="stat-value"><?php echo $loyaltyPoints; ?></div>
                    <div class="stat-label">Loyalty Points</div>
                </div>

                <div class="stat-card">
                    <i class="fa fa-calendar-check-o"></i>
                    <div class="stat-value"><?php echo $row['visit_count']; ?></div>
                    <div class="stat-label">Total Visits</div>
                </div>

                <div class="stat-card">
                    <i class="fa fa-money"></i>
                    <div class="stat-value">Ksh <?php echo number_format($row['total_spent'], 2); ?></div>
                    <div class="stat-label">Total Spent</div>
                </div>

                <div class="stat-card">
                    <i class="fa fa-gift"></i>
                    <?php
                    $nextRewardAmount = ceil($loyaltyPoints/500)*500;
                    $pointsToNext = $nextRewardAmount - $loyaltyPoints;
                    $progress = ($loyaltyPoints % 500) / 5;
                    ?>
                    <div class="stat-value"><?php echo $pointsToNext; ?></div>
                    <div class="stat-label">Points until next reward</div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo $progress; ?>%"></div>
                    </div>
                </div>
            </div>

            <div class="history-section">
                <h3>Service History</h3>
                <div class="service-history">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Services</th>
                                <th>Amount</th>
                                <th>Points Earned</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($service = mysqli_fetch_array($history_query)) {
                                echo "<tr>";
                                echo "<td>" . date('d M Y', strtotime($service['PostingDate'])) . "</td>";
                                echo "<td>" . $service['Services'] . "</td>";
                                echo "<td>Ksh " . number_format($service['TotalAmount'], 2) . "</td>";
                                echo "<td>" . $service['PointsEarned'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <?php include_once('includes/footer.php'); ?>
        <script src="assets/js/script.js"></script>
        <style>
            .dashboard-container {
                padding: 40px 0;
            }

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                margin-bottom: 40px;
            }

            .stat-card {
                background: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .stat-card i {
                font-size: 2rem;
                color: #FF69B4;
                margin-bottom: 10px;
            }

            .stat-value {
                font-size: 2rem;
                font-weight: bold;
                color: #333;
                margin: 10px 0;
            }

            .stat-label {
                color: #666;
            }

            .history-section {
                background: white;
                border-radius: 10px;
                padding: 25px;
                margin-top: 30px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .service-history {
                margin-top: 20px;
            }

            .service-history table {
                width: 100%;
                border-collapse: collapse;
            }

            .service-history th,
            .service-history td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            .service-history th {
                background: #FF69B4;
                color: white;
            }

            .progress-bar {
                background: #f0f0f0;
                border-radius: 10px;
                height: 20px;
                margin-top: 10px;
            }

            .progress-fill {
                background: #FF69B4;
                height: 100%;
                border-radius: 10px;
                transition: width 0.3s ease;
            }
        </style>
    </body>
    </html>
<?php } ?>