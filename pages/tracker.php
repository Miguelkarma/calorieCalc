<?php
session_start();
include('../includes/conn.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: ../login.php');
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch user info from the session
$query = "SELECT username, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Fetch calorie data for the logged-in user for table display
$stmt = $conn->prepare("SELECT * FROM tbl_calorie WHERE user_id = ? ORDER BY calorie_date");
$stmt->execute([$user_id]);
$result = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracker</title>
    <link rel="icon" type="image/x-icon" href="../images/icon1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/trackerstyle.css">
    <style>
        body {
            padding-top: 60px; 
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-transparent">
        <div class="container">
            <!-- logo -->
            <a class="navbar-brand display-1 fw-normal" href="#">Calorie<span class="rounded-pill" style="color: #f1683a; background-color: #2c3336;">Calc</a></span>
            <!-- toggle -->
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-white fs-2" id="offcanvasDarkNavbarLabel">Calorie<span class="rounded-pill" style="color: #f1683a; background-color: #2c3336;">Calc</span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Display Profile Picture -->
                    <div class="text-center mb-3">
                        <?php if ($user['profile_picture']): ?>
                            <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" class="rounded-circle" width="100" height="100">
                        <?php else: ?>
                            <img src="../images/1.png" alt="Default Profile Picture" class="rounded-circle" width="100" height="100">
                        <?php endif; ?>
                    </div>

                    <!-- Display Username -->
                    <h5 class="text-center text-white mb-3"><?php echo htmlspecialchars($user['username']); ?></h5>

                    <!-- Menu Items -->
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="tracker.php">Tracker</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Calculator
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="calculator.php">Calculator</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="history.php">Calculation History</a></li>
                            </ul>
                        </li>
                    </ul>
                    <br>
                    <div class="hi mt-auto">
            <a class="nav-link text-danger " href="logout.php">Logout</a>
        </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="main">
        <div class="calories-container">
            <div class="header">
                <h3>Daily Calories Monitoring Tool</h3>
                <button type="button" class="btn btn-sm btn-primary add-calorie-btn" data-toggle="modal" data-target="#addcalorieModal">+ Add Calorie Intake</button>

                <!-- Modal -->
                <div class="modal fade" id="addcalorieModal" tabindex="2" aria-labelledby="addcalorie" aria-hidden="true" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addcalorie">Add Calorie Intake</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../includes/add-calorie.php" method="POST">
                                    <div class="form-group">
                                        <label for="calorieDate">Calorie Date:</label>
                                        <input type="date" class="form-control" id="calorieDate" name="calorie_date" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="calorieAmount">Calorie Amount (in grams):</label>
                                        <input type="number" class="form-control" id="calorieAmount" name="calorie_amount" required>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-graph-container">
                <div class="table-container">
                    <table class="table text-center table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Calories (g)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="calorieTableBody">
                            <?php
                                // Display logged-in user's calories
                                foreach ($result as $row) {
                                    $calorieId = $row['tbl_calorie_id'];
                                    $calorieDate = $row['calorie_date'];
                                    $calorieAmount = $row['calorie_amount'];

                                    echo '<tr class="calorieList">';
                                    echo '<th hidden>' . $calorieId . '</th>';
                                    echo '<td>' . $calorieDate . '</td>';
                                    echo '<td>' . $calorieAmount . '</td>';
                                    
                                    echo '<td style="background-color: transparent;">';
                                    echo '<button type="button" class="btn btn-sm btn-light" onclick="editcalorie(' . $calorieId . ')">Edit</button> ';
                                    echo '<button type="button" class="btn btn-sm btn-danger" onclick="removecalorie(' . $calorieId . ')">Delete</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="graph-container">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>   

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <?php
    // Fetch calorie data for the logged-in user and sum calories for each date
    $stmt = $conn->prepare("SELECT calorie_date, SUM(calorie_amount) AS total_calories FROM tbl_calorie WHERE user_id = ? GROUP BY calorie_date");
    $stmt->execute([$user_id]);
    $calorieData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare data for Chart.js
    $dates = [];
    $calories = [];
    foreach ($calorieData as $data) {
        $dates[] = $data['calorie_date'];
        $calories[] = $data['total_calories'];
    }
    ?>

    <script>
        
    const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Calories',
            data: <?php echo json_encode($calories); ?>,
            borderColor: '#f1683a',
            backgroundColor: '#f1683a',
            borderWidth: 1,
            pointRadius: 6, 
            fill: false
        }]
    },
    options: {
        maintainAspectRatio: false, // This ensures the height is respected
        scales: {
            x: {
                ticks: {
                    color: '#eee'
                },
                grid: {
                    color: '#eee' // Color of the x-axis grid lines
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#eee'
                },
                grid: {
                    color: '#eee' // Color of the y-axis grid lines
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: '#eee' // Color of the legend labels
                }
            }
        }
    }
});

        function editcalorie(calorieId) {
            // Implement your edit calorie function here
            console.log("Edit calorie with ID:", calorieId);
        }

        function removecalorie(calorieId) {
            // Implement your remove calorie function here
            console.log("Remove calorie with ID:", calorieId);
        }
    </script>
</body>
</html>
