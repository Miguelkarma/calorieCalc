<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    
    // Get JSON data from request body
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data) {
        $maintainWeight = $data['maintainWeight'];
        $mildWeightLoss = $data['mildWeightLoss'];
        $weightLoss = $data['weightLoss'];
        $extremeWeightLoss = $data['extremeWeightLoss'];

        // Save these results in an associative array
        $calculation = [
            'Maintain Weight' => $maintainWeight,
            'Mild Weight Loss' => $mildWeightLoss,
            'Weight Loss' => $weightLoss,
            'Extreme Weight Loss' => $extremeWeightLoss
        ];

        $stmt = $conn->prepare("INSERT INTO calculation_history (user_id, calculation) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id,  json_encode($calculation));
        $stmt->execute();
    }
}
?>
