<?php

// Start the session to include the session variables.
session_start();

// Unset the session variables.
session_unset();

// Destroy the session.
session_destroy();

// Redirect the user to the index page.
header("Location: index.php");
