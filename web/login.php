<?php

// Start the session to include the session variables.
session_start();
function escapeString(string $data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error = FALSE;

if (isset($_POST['username']) && isset($_POST['password'])) {
    // User credentials have been entered.
    $username = escapeString($_POST['username']);
    $password = escapeString($_POST['password']);

    require_once '../database_connection.php';

    if ($username !== '' && $password !== '') {

        $result = $stmt = $mysqli->prepare("SELECT id, name FROM users WHERE username = ?;");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC) ?: NULL;

        if ($result !== NULL) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            if (password_verify($password, $passwordHash)) {
                $result = reset($result);
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $result['name'];
                $_SESSION['user_id'] = $result['id'];
                header("Location: index.php");
                exit();
            }
            else {
                $error = 'Username or password is incorrect.';
            }
        }
        else {
            $error = 'Username or password is incorrect.';
        }
    } else {
        $error = 'Please enter a username and password.';
    }
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
                        <?php if ($error) { ?>
                            <p class="alert alert-danger"><?php echo $error; ?></p>
                        <?php } ?>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form-username">Username</label>
                            <input type="text" name="username" placeholder="Username" id="form-username" autocomplete="autocomplete" class="form-control">
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
