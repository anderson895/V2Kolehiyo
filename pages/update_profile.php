<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include('../includes/db.php'); 
$username = $_SESSION['username'];

// Fetch user profile data from the database
$query = "SELECT * FROM users WHERE user_name = ?";
$stmt = $dsn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user_profile = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update text fields
    $home_sec = $_POST['home_sec'];
    $about_me = $_POST['about_me'];
    $about_me_p = $_POST['about_me_p'];
    $proj_img1_p = $_POST['proj_img1_p'];
    $proj_img2_p = $_POST['proj_img2_p'];
    $proj_img3_p = $_POST['proj_img3_p'];

    // Directory for uploads
    $upload_dir = "../upload/";

    // Function to handle image uploads
    function uploadImage($file, $current_file_path, $upload_dir) {
        if (isset($file) && $file['error'] == UPLOAD_ERR_OK) {
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $unique_name = uniqid() . "." . $extension;
            $destination = $upload_dir . $unique_name;

            // Delete existing file if it exists
            if (!empty($current_file_path) && file_exists($current_file_path)) {
                unlink($current_file_path);
            }

            // Move the uploaded file
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                return $destination; // Return the new file path
            } else {
                echo "<div class='alert alert-danger text-center'>Failed to upload image: " . $file['name'] . "</div>";
            }
        }
        return $current_file_path; // Retain the current file path if no new file is uploaded
    }

    // Process image uploads
    $about_me_img = uploadImage($_FILES['about_me_img'], $user_profile['about_me_img'], $upload_dir);
    $proj_img1 = uploadImage($_FILES['proj_img1'], $user_profile['proj_img1'], $upload_dir);
    $proj_img2 = uploadImage($_FILES['proj_img2'], $user_profile['proj_img2'], $upload_dir);
    $proj_img3 = uploadImage($_FILES['proj_img3'], $user_profile['proj_img3'], $upload_dir);
    $profile_picture = uploadImage($_FILES['profile_picture'], $user_profile['profile_picture'], $upload_dir);

    // Prepare update query
    $query = "UPDATE users 
              SET home_sec = ?, about_me = ?, about_me_p = ?, about_me_img = ?, 
                  proj_img1 = ?, proj_img1_p = ?, proj_img2 = ?, proj_img2_p = ?, 
                  proj_img3 = ?, proj_img3_p = ?, profile_picture = ? 
              WHERE user_name = ?";
    $stmt = $dsn->prepare($query);
    $stmt->bind_param(
        "ssssssssssss", 
        $home_sec, $about_me, $about_me_p, $about_me_img, 
        $proj_img1, $proj_img1_p, $proj_img2, $proj_img2_p, 
        $proj_img3, $proj_img3_p, $profile_picture, $username
    );

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Profile updated successfully!</div>";
        header("Location: portfolio.php"); // Redirect to portfolio
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Error updating profile: " . $stmt->error . "</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                <a href="portfolio.php" class="btn btn-outline-light btn-sm mt-2">Go Back to Portfolio</a>

                    <h3>Update Your Profile</h3>
                </div>
                <div class="card-body">
                    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                        
                        <!-- Profile Picture -->
                        <div class="form-group mb-3">
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" class="form-control" name="profile_picture" id="profile_picture" accept="image/*">
                        </div>
                        
                        <!-- Home Section -->
                        <div class="form-group mb-3">
                            <label for="home_sec">Home Section</label>
                            <input type="text" class="form-control" name="home_sec" id="home_sec" value="<?= htmlspecialchars($user_profile['home_sec']) ?>" required>
                        </div>

                        <!-- About Me Section -->
                        <div class="form-group mb-3">
                            <label for="about_me">About Me</label>
                            <input type="text" class="form-control" name="about_me" id="about_me" value="<?= htmlspecialchars($user_profile['about_me']) ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="about_me_p">About Me Paragraph</label>
                            <textarea class="form-control" name="about_me_p" id="about_me_p" rows="5" required><?= htmlspecialchars($user_profile['about_me_p']) ?></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="about_me_img">About Me Image</label>
                            <input type="file" class="form-control" name="about_me_img" id="about_me_img" accept="image/*">
                        </div>

                        <!-- Project 1 -->
                        <div class="form-group mb-3">
                            <label for="proj_img1">Project Image 1</label>
                            <input type="file" class="form-control" name="proj_img1" id="proj_img1" accept="image/*">
                        </div>
                        <div class="form-group mb-3">
                            <label for="proj_img1_p">Project 1 Description</label>
                            <input type="text" class="form-control" name="proj_img1_p" id="proj_img1_p" value="<?= htmlspecialchars($user_profile['proj_img1_p']) ?>">
                        </div>

                        <!-- Project 2 -->
                        <div class="form-group mb-3">
                            <label for="proj_img2">Project Image 2</label>
                            <input type="file" class="form-control" name="proj_img2" id="proj_img2" accept="image/*">
                        </div>
                        <div class="form-group mb-3">
                            <label for="proj_img2_p">Project 2 Description</label>
                            <input type="text" class="form-control" name="proj_img2_p" id="proj_img2_p" value="<?= htmlspecialchars($user_profile['proj_img2_p']) ?>">
                        </div>

                        <!-- Project 3 -->
                        <div class="form-group mb-3">
                            <label for="proj_img3">Project Image 3</label>
                            <input type="file" class="form-control" name="proj_img3" id="proj_img3" accept="image/*">
                        </div>
                        <div class="form-group mb-3">
                            <label for="proj_img3_p">Project 3 Description</label>
                            <input type="text" class="form-control" name="proj_img3_p" id="proj_img3_p" value="<?= htmlspecialchars($user_profile['proj_img3_p']) ?>">
                        </div>


                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark">Update Profile</button>
                            <a href="portfolio.php" class="btn btn-outline-secondary">Go Back to Portfolio</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
