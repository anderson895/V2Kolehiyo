<?php 

include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Common function to handle image uploads
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

    if ($_POST['requestType'] == 'Adduser') {
          // Get input fields for adding a new user
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $home_sec = $_POST['home_sec'];
    $about_me = $_POST['about_me'];
    $about_me_p = $_POST['about_me_p'];
    $proj_img1_p = $_POST['proj_img1_p'];
    $proj_img2_p = $_POST['proj_img2_p'];
    $proj_img3_p = $_POST['proj_img3_p'];

    // Directory for uploads
    $upload_dir = "../upload/";

    // Process image uploads
    $about_me_img = uploadImage($_FILES['about_me_img'], "", $upload_dir);
    $proj_img1 = uploadImage($_FILES['proj_img1'], "", $upload_dir);
    $proj_img2 = uploadImage($_FILES['proj_img2'], "", $upload_dir);
    $proj_img3 = uploadImage($_FILES['proj_img3'], "", $upload_dir);
    $profile_picture = uploadImage($_FILES['profile_picture'], "", $upload_dir);

    // Check if the username already exists
    $check_query = "SELECT COUNT(*) FROM users WHERE user_name = ?";
    $check_stmt = $dsn->prepare($check_query);
    $check_stmt->bind_param("s", $user_name);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Prepare query for inserting new user if username is unique
        $query = "INSERT INTO users 
                    (user_name, password, home_sec, about_me, about_me_p, about_me_img, 
                    proj_img1, proj_img1_p, proj_img2, proj_img2_p, proj_img3, proj_img3_p, profile_picture)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $dsn->prepare($query);
        $stmt->bind_param(
            "sssssssssssss", 
            $user_name, $password, $home_sec, $about_me, $about_me_p, $about_me_img, 
            $proj_img1, $proj_img1_p, $proj_img2, $proj_img2_p, 
            $proj_img3, $proj_img3_p, $profile_picture
        );

        if ($stmt->execute()) {
            echo "200";
        } else {
            echo $stmt->error;
        }
    }
    } else if ($_POST['requestType'] == 'Updateuser') {
          // Get input fields for updating user
          $users_id = $_POST['users_id'];
          $user_name = $_POST['user_name'];
          $password = $_POST['password'];
          $home_sec = $_POST['home_sec'];
          $about_me = $_POST['about_me'];
          $about_me_p = $_POST['about_me_p'];
          $proj_img1_p = $_POST['proj_img1_p'];
          $proj_img2_p = $_POST['proj_img2_p'];
          $proj_img3_p = $_POST['proj_img3_p'];
  
          // Directory for uploads
          $upload_dir = "../upload/";
  
          $query = "SELECT * FROM users WHERE users_id = ?";
          $stmt = $dsn->prepare($query);
          $stmt->bind_param("i", $users_id);
          $stmt->execute();
          $result = $stmt->get_result();
          $user_profile = $result->fetch_assoc();
  
          // Only upload images if files are provided, otherwise retain the current path
          $about_me_img = uploadImage($_FILES['about_me_img'], $user_profile['about_me_img'], $upload_dir);
          $proj_img1 = uploadImage($_FILES['proj_img1'], $user_profile['proj_img1'], $upload_dir);
          $proj_img2 = uploadImage($_FILES['proj_img2'], $user_profile['proj_img2'], $upload_dir);
          $proj_img3 = uploadImage($_FILES['proj_img3'], $user_profile['proj_img3'], $upload_dir);
          $profile_picture = uploadImage($_FILES['profile_picture'], $user_profile['profile_picture'], $upload_dir);
  
          // Only update password if a new one is provided
          $password = empty($password) ? "" : $password;
  
          // Prepare the query dynamically based on the inputs provided
          $query = "UPDATE users SET 
                      user_name = ?, 
                      home_sec = ?, 
                      about_me = ?, 
                      about_me_p = ?, 
                      proj_img1_p = ?, 
                      proj_img2_p = ?, 
                      proj_img3_p = ?, ";
  
          // Add the password and images conditionally
          if ($password) {
              $query .= "password = ?, ";
          }
          if ($about_me_img) {
              $query .= "about_me_img = ?, ";
          }
          if ($proj_img1) {
              $query .= "proj_img1 = ?, ";
          }
          if ($proj_img2) {
              $query .= "proj_img2 = ?, ";
          }
          if ($proj_img3) {
              $query .= "proj_img3 = ?, ";
          }
          if ($profile_picture) {
              $query .= "profile_picture = ?, ";
          }
  
          // Trim the trailing comma and add the WHERE condition
          $query = rtrim($query, ', ') . " WHERE users_id = ?";
  
          // Prepare the statement dynamically
          $stmt = $dsn->prepare($query);
  
          // Dynamically bind parameters based on the input data
          $param_types = "ssssssss"; // Base types (without optional parameters)
          $params = [
              $user_name, $home_sec, $about_me, $about_me_p, $proj_img1_p, $proj_img2_p, $proj_img3_p
          ];
  
          // Add optional parameters to the binding
          if ($password) {
              $param_types .= "s"; // Add 's' for password
              $params[] = $password;
          }
          if ($about_me_img) {
              $param_types .= "s"; // Add 's' for image path
              $params[] = $about_me_img;
          }
          if ($proj_img1) {
              $param_types .= "s"; // Add 's' for image path
              $params[] = $proj_img1;
          }
          if ($proj_img2) {
              $param_types .= "s"; // Add 's' for image path
              $params[] = $proj_img2;
          }
          if ($proj_img3) {
              $param_types .= "s"; // Add 's' for image path
              $params[] = $proj_img3;
          }
          if ($profile_picture) {
              $param_types .= "s"; // Add 's' for image path
              $params[] = $profile_picture;
          }
  
          $params[] = $users_id; // Add the users_id at the end for WHERE clause
  
          // Bind the parameters dynamically
          $stmt->bind_param($param_types, ...$params);
  
          if ($stmt->execute()) {
              echo "200";
          } else {
              echo $stmt->error;
          }
    }else if ($_POST['requestType'] == 'DeleteUser') {
                    // Get the user ID to remove
            $users_id = $_POST['remove_users_id'];

            // Prepare the DELETE query
            $query = "DELETE FROM users WHERE users_id = ?";

            // Create a prepared statement
            $stmt = $dsn->prepare($query);

            // Bind the parameter (ensure it's an integer)
            $stmt->bind_param("i", $users_id);

            // Execute the statement
            if ($stmt->execute()) {
                echo "200"; // Success
            } else {
                echo "Error: " . $stmt->error; // Error message
            }

            // Close the statement
            $stmt->close();
  }
}
?>
