<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
   <header class="header">
    <a href="#" class="logo"><span>Jan</span>ur</a>
    <nav class="navbar">
        <a href="#">Home</a>
        <a href="#about">About Me</a>
        <a href="#projects">Projects</a>
        <a href="#contact">Contact Me</a>
    </nav>
    <a href="#" class="logout-btn">Logout</a> <!-- Styled Logout Button -->
</header>

    <section class="home">
        <div class="home-content">
            <h3>Hi</h3>
            <h1>I'm <span>Janur <br></span>a Photographer and Cinematographer</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            <div class="btn-box">
                <button class="btn-1">Edit Profile</button>
            </div>
        </div>
        <div class="img-box">
            <img src="../assets/images/jpic.jpg" alt="">
        </div>
    </section>

    <section class="about" id="about"> <!-- ID added to About section -->
        <div class="about-img">
            <img src="../assets/images/jpic2.jpg" alt="">
        </div>

        <div class="about-content">
            <h2 class="heading">About<span> Me</span></h2>
            <h3>Freelance<span> Photographer</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects" id="projects">
    <h2 class="heading">My Projects</h2>
    <div class="container">
        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-4">
                <div class="project-item">
                    <img src="../assets/images/p3.png" alt="Project 1">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="col-md-4">
                <div class="project-item">
                    <img src="../assets/images/p1.jpg" alt="Project 2">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>

            <!-- Column 3 -->
            <div class="col-md-4">
                <div class="project-item">
                    <img src="../assets/images/p2.jpg" alt="Project 3">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </div>
</section>

 <section class="contact" id="contact">
        <h2 class="heading">Contact</h2>
        <div class="contact-content">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn-1">Send Message</button>
            </form>
        </div>
    </section>

</body>
</html>
