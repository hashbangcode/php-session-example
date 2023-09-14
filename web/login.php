<?php

// Start the session to include the session variables.
session_start();

if (isset($_SESSION['user_id'])) {
    // If the 'user_id' session variable is present then the user is already
    // authenticated. In this case we redirect them to the homepage.
    header("Location: index.php");
    exit();
}

/**
 * Authenticate the user credentials against the values in the database.
 *
 * @param string $username
 *   The provided username.
 * @param string $password
 *   The provided password.
 * @param mysqli $mysqli
 *   The MySQL connection.
 *
 * @return string
 *   If an error was encountered then a string detailing the error is returned.
 *   Else we authenticate the user and redirect to the homepage.
 */
function authenticate(string $username, string $password, mysqli $mysqli):string {
    // Make sure the username and password fields have something in them.
    if (empty($username) && empty($password)) {
        return 'Please enter a username and password.';
    }

    // Search the database for the user based on their username.
    $result = $stmt = $mysqli->prepare("SELECT id, name FROM users WHERE username = ?;");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC) ?: null;

    if ($result === null) {
        return 'Username or password is incorrect.';
    }

    // Validate the password.
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    if (password_verify($password, $passwordHash) === false) {
        return 'Username or password is incorrect.';
    }

    // The password validates correctly, so add their username to
    // the $_SESSION variable, which will log the user in.
    $result = reset($result);
    $_SESSION['username'] = $username;
    $_SESSION['name'] = htmlspecialchars($result['name']);
    $_SESSION['user_id'] = $result['id'];

    // Redirect the user back to the homepage.
    header("Location: index.php");
    exit();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    // User credentials have been entered, trim them to prevent common
    // whitespace mistakes.
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Include the database connection.
    require_once '../database_connection.php';

    // Attempt to authenticate the user.
    $error = authenticate($username, $password, $mysqli);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <header class="d-flex flex-wrap py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <span class="fs-4">Authentication Example</span>
                </a>
            </header>
        </div>

        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form action="login.php" method="post">
                        <h2>Login</h2>
                        <?php if (empty($error) === false) { ?>
                            <p class="alert alert-danger"><?php echo $error; ?></p>
                        <?php } ?>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form-username">Username</label>
                            <input type="text" name="username" placeholder="Username" id="form-username" autocomplete="autocomplete" class="form-control" value="<?php echo $_POST['username'] ?? '';?>">
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form-password">Password</label>
                            <input type="password" name="password" placeholder="Password" id="form-password" autocomplete="autocomplete" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
