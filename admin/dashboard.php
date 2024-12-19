<?php
include "components/header.php";

include('../includes/db.php'); 
// Fetch user profile data from the database
$query = "SELECT COUNT(*) AS user_count FROM users";
$stmt = $dsn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$user_count = $row['user_count'];


?>
<!-- Top bar with user profile -->
<div class="flex justify-between items-center bg-white p-4 mb-6 rounded-md shadow-md">
    <h2 class="text-lg font-semibold text-gray-700">Dashboard</h2>
    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-lg font-bold text-white">
        <?php
        echo substr(ucfirst($_SESSION['username']), 0, 1);
        ?>
    </div>
</div>

<!-- Dashboard Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6">
    <!-- Card for Total Customer -->
    <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
        <img src="assets/service.png" alt="students icon" class="mb-4 w-12 max-w-full" />
        <h3 class="text-gray-700 font-semibold text-lg">Total Customer</h3>
        <p class="text-blue-500 text-2xl font-bold count_users"><?=$user_count?></p>
    </div>

 
</div>



<?php
include "components/footer.php";
?>