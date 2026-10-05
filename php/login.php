<?php

session_start();

header("Content-Type: application/json");

require_once "db.php";


/* =====================================================
   GET LOGIN DATA
   ===================================================== */

$input = json_decode(
    file_get_contents("php://input"),
    true
);


if (!$input) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid request."
    ]);

    exit;
}


$email = trim($input["email"] ?? "");
$password = $input["password"] ?? "";


/* =====================================================
   VALIDATION
   ===================================================== */

if ($email === "" || $password === "") {

    echo json_encode([
        "success" => false,
        "message" => "Please enter your email and password."
    ]);

    exit;
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo json_encode([
        "success" => false,
        "message" => "Please enter a valid email address."
    ]);

    exit;
}


/* =====================================================
   FIND USER
   ===================================================== */

$query = $conn->prepare(
    "SELECT id, name, email, password
     FROM users
     WHERE email = ?"
);


$query->bind_param(
    "s",
    $email
);


$query->execute();


$result =
    $query->get_result();


/* =====================================================
   USER NOT FOUND
   ===================================================== */

if ($result->num_rows !== 1) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid email or password."
    ]);

    $query->close();
    $conn->close();

    exit;
}


$user =
    $result->fetch_assoc();


/* =====================================================
   VERIFY PASSWORD
   ===================================================== */

if (!password_verify(
    $password,
    $user["password"]
)) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid email or password."
    ]);

    $query->close();
    $conn->close();

    exit;
}


/* =====================================================
   CREATE LOGIN SESSION
   ===================================================== */

session_regenerate_id(true);


$_SESSION["user_id"] =
    $user["id"];

$_SESSION["user_name"] =
    $user["name"];

$_SESSION["user_email"] =
    $user["email"];


/* =====================================================
   SUCCESS
   ===================================================== */

echo json_encode([

    "success" => true,

    "message" => "Login successful!",

    "user" => [

        "id" =>
            $user["id"],

        "name" =>
            $user["name"],

        "email" =>
            $user["email"]

    ]

]);


$query->close();

$conn->close();

?>