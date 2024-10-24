<?php
session_start();
include('../includes/conn.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

// Check if the calorie ID is provided
if (isset($_GET['calorie'])) {
    $calorieId = $_GET['calorie'];

    // Fetch the specific calorie data for editing
    $stmt = $conn->prepare("SELECT * FROM tbl_calorie WHERE tbl_calorie_id = ?");
    $stmt->execute([$calorieId]);
    $calorie = $stmt->fetch();

    if (!$calorie) {
        echo "Calorie entry not found!";
        exit();
    }
} else {
    echo "No calorie ID provided!";
    exit();
}

// Update the calorie entry
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newDate = $_POST['calorie_date'];
    $newAmount = $_POST['calorie_amount'];

    $stmt = $conn->prepare("UPDATE tbl_calorie SET calorie_date = ?, calorie_amount = ? WHERE tbl_calorie_id = ?");
    $stmt->execute([$newDate, $newAmount, $calorieId]);

    header('Location: ../pages/tracker.php'); // Redirect back to the history page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Calorie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3>Edit Calorie Entry</h3>
        <form method="POST">
            <div class="form-group">
                <label for="calorieDate">Calorie Date:</label>
                <input type="date" class="form-control" id="calorieDate" name="calorie_date" value="<?php echo $calorie['calorie_date']; ?>" required>
            </div>
            <div class="form-group">
                <label for="calorieAmount">Calorie Amount (in grams):</label>
                <input type="number" class="form-control" id="calorieAmount" name="calorie_amount" value="<?php echo $calorie['calorie_amount']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
