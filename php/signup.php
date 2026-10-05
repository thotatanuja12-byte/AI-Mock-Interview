<?php

header("Content-Type: application/json");

require_once "db.php";


/* =====================================================
   GET REQUEST DATA
   ===================================================== */

$input = json_decode(
    file_get_contents("php://input"),
    true
);


/* =====================================================
   CHECK DATA
   ===================================================== */

if (!$input) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid request."
    ]);

    exit;
}


$name = trim($input["name"] ?? "");
$email = trim($input["email"] ?? "");
$password = $input["password"] ?? "";


/* =====================================================
   VALIDATION
   ===================================================== */

if ($name === "" || $email === "" || $password === "") {

    echo json_encode([
        "success" => false,
        "message" => "Please fill in all required fields."
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


if (strlen($password) < 6) {

    echo json_encode([
        "success" => false,
        "message" => "Password must contain at least 6 characters."
    ]);

    exit;
}


/* =====================================================
   CHECK WHETHER EMAIL ALREADY EXISTS
   ===================================================== */

$checkQuery = $conn->prepare(
    "SELECT id FROM users WHERE email = ?"
);

$checkQuery->bind_param(
    "s",
    $email
);

$checkQuery->execute();

$checkResult =
    $checkQuery->get_result();


if ($checkResult->num_rows > 0) {

    echo json_encode([
        "success" => false,
        "message" => "An account with this email already exists."
    ]);

    $checkQuery->close();

    exit;
}

$checkQuery->close();


/* =====================================================
   HASH PASSWORD
   ===================================================== */

$hashedPassword =
    password_hash(
        $password,
        PASSWORD_DEFAULT
    );


/* =====================================================
   INSERT USER
   ===================================================== */

$insertQuery = $conn->prepare(
    "INSERT INTO users (name, email, password)
     VALUES (?, ?, ?)"
);


$insertQuery->bind_param(
    "sss",
    $name,
    $email,
    $hashedPassword
);


if ($insertQuery->execute()) {

    echo json_encode([
        "success" => true,
        "message" => "Account created successfully!"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Unable to create the account. Please try again."
    ]);

}


$insertQuery->close();

$conn->close();

?>