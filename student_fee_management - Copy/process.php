<?php

require_once "db.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: pay_fees.html");

    exit();

}


$student_name =
    trim($_POST["student_name"] ?? "");

$student_id =
    trim($_POST["student_id"] ?? "");

$department =
    trim($_POST["department"] ?? "");

$level =
    trim($_POST["level"] ?? "");

$fee_type =
    trim($_POST["fee_type"] ?? "");

$amount =
    $_POST["amount"] ?? "";

$payment_date =
    $_POST["payment_date"] ?? "";


if (
    $student_name === "" ||
    $student_id === "" ||
    $department === "" ||
    $level === "" ||
    $fee_type === "" ||
    $amount === "" ||
    $payment_date === ""
) {

    die("Please fill in all fields.");

}


if (!is_numeric($amount) || $amount <= 0) {

    die("Please enter a valid payment amount.");

}


$sql = "INSERT INTO payments
        (
            student_name,
            student_id,
            department,
            level,
            fee_type,
            amount,
            payment_date
        )
        VALUES (?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);


if (!$stmt) {

    die("Database error: " . $conn->error);

}


$stmt->bind_param(
    "sssssss",
    $student_name,
    $student_id,
    $department,
    $level,
    $fee_type,
    $amount,
    $payment_date
);


if ($stmt->execute()) {

?>

<!DOCTYPE html>

<html>

<head>

    <title>Payment Saved</title>

    <link rel="stylesheet"
          href="style.css">

</head>

<body>


<div class="success-card">

    <h2>
        Payment Saved Successfully
    </h2>

    <p>
        The student's fee record has been saved.
    </p>


    <a href="pay_fees.html"
       class="btn">

        Add Another Payment

    </a>


    <a href="records.php"
       class="btn secondary">

        View Records

    </a>

</div>


</body>

</html>

<?php

} else {

    echo "Error saving payment: "
         . $stmt->error;

}


$stmt->close();

$conn->close();

?>