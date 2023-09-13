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
        <title>Inner Page</title>
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
            <h1>Inner Page</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac quam sit amet neque maximus dictum.</p>
            <p>Mauris tempor risus lectus, et eleifend nisl dapibus nec. Phasellus lacus augue, tristique vel ante ut,
                faucibus pellentesque justo. Quisque sit amet luctus nulla, id aliquam sapien. Sed at enim at elit
                egestas pulvinar vel ac ligula. Cras non metus luctus, hendrerit tortor a, sollicitudin lorem.</p>
            <p>Etiam at pulvinar enim, at tincidunt erat.</p>
        </div>
    </body>
</html>
