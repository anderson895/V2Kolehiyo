<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

include('../includes/db.php');
$username = $_SESSION['username'];

// Fetch user profile data from the database
$query = "SELECT * FROM users WHERE user_name = ?";
$stmt = $dsn->prepare($query);
$stmt->bind_param("s", $username); // Bind the username to the query
$stmt->execute();
$result = $stmt->get_result();
$user_profile = $result->fetch_assoc(); // Fetch user profile data

if (!$user_profile) {
    // If no user profile is found, redirect to login page
    header("Location: ../login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#"><span>V2 </span>Kolehiyo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="#"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#about"><i class="fas fa-user"></i> About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#projects"><i class="fas fa-project-diagram"></i> Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#contact"><i class="fas fa-envelope"></i> Contact Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="update_profile.php"><i class="fas fa-envelope"></i> Update Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../login.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section class="home">
        <div class="home-content">
            <h3>Hi! I'm</h3>
            <span><h1 class="fw-bold"><?= htmlspecialchars($user_profile['user_name']) ?></h1></span>
            <h1><?= htmlspecialchars($user_profile['home_sec']) ?></h1>
            <br>
            <div class="btn-box">
                <button type="button" class="btn-1"><a href="#about">Learn More about Me</a></button>
            </div>
        </div>
        <div class="img-box">
        <img src="../upload/<?= $user_profile['profile_picture']; ?>">
        </div>
    </section>

    

    <section class="about" id="about"> <!-- ID added to About section -->
        <div class="about-img">
        <img src="../upload/<?= $user_profile['about_me_img']; ?>">
        </div>

        <div class="about-content">
            <h2 class="heading">About<span> Me</span></h2>
            <h3><span><?= htmlspecialchars($user_profile['about_me']) ?></span></h3>
            <p><?= htmlspecialchars($user_profile['about_me_p']) ?></p>
            <br>
        </div>
        <div class="btn-box">
                <button type="button" class="btn-2"><a href="#projects">Here are my Skills</button></a>
            </div>
    </section>

    <!-- Projects Section -->
    <section class="projects" id="projects">
    <h2 class="heading" style="font-weight: bold;">My Skills</h2>
    <div class="container">
        <div class="row">
        <div class="container">
    <div class="row">
        <!-- Project 1 -->
        <div class="col-md-4">
            <div class="project-item">
                <img src="../upload/<?= $user_profile['proj_img1']; ?>">
                <p><?php echo htmlspecialchars($user_profile["proj_img1_p"]); ?></p>
            </div>
        </div>

        <!-- Project 2 -->
        <div class="col-md-4">
        <div class="project-item">
                <img src="../upload/<?= $user_profile['proj_img2']; ?>">
                <p><?php echo htmlspecialchars($user_profile["proj_img2_p"]); ?></p>
            </div>
        </div>

        <!-- Project 3 -->
        <div class="col-md-4">
        <div class="project-item">
                <img src="../upload/<?= $user_profile['proj_img3']; ?>">
                <p><?php echo htmlspecialchars($user_profile["proj_img3_p"]); ?></p>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</section>

<section class="contact mt-5" id="contact">
    <div class="container">
        <h2 class="text-center mb-4" style="color: orangered; font-weight: bold;">Contact Me</h2>
        <div class="contact-content bg-black p-4 rounded shadow-lg">
            <form action="index.php" method="POST">
                <!-- Name Input -->
                <div class="form-group mb-3">
                    <label for="name" class="text-light">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required value="<?php echo isset($message) ? $message['name'] : ''; ?>">
                </div>
                
                <!-- Email Input -->
                <div class="form-group mb-3">
                    <label for="email" class="text-light">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required value="<?php echo isset($message) ? $message['email'] : ''; ?>">
                </div>

                <!-- Message Textarea -->
                <div class="form-group mb-3">
                    <label for="message" class="text-light">Your Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5" placeholder="Write your message here" required><?php echo isset($message) ? $message['message'] : ''; ?></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="submit" class="btn w-100" style="background-color: orangered; color: black; font-weight: bold;">
                    <?php echo isset($message) ? 'Update Message' : 'Send Message'; ?>
                </button>
            </form>
        </div>
    </div>
</section>
<br>

</body>
</html>
