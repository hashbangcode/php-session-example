<?php

// Start the session to include the session variables.
session_start();

if (!isset($_SESSION['user_id'])) {
    // If 'user_id' isn't set then the user isn't authenticated. Redirect them
    // to the login.php page.
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <header class="d-flex flex-wrap py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <span class="fs-4">Authentication Example</span>
                </a>

                <ul class="nav nav-pills">
                    <li class="nav-item"><a href=/logout.php#" class="nav-link">Log out</a></li>
                </ul>
            </header>
        </div>

        <div class="container">
            <h1>Homepage</h1>
            <p>Welcome <?php echo $_SESSION['name']; ?></p>
            <p><a href="/page.php">Visit inner page.</a></p>
        </div>
    </body>
</html>
