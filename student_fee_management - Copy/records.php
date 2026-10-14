<?php

require_once "db.php";


$sql =
    "SELECT * FROM payments
     ORDER BY id DESC";


$result =
    $conn->query($sql);

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width,
                   initial-scale=1.0">

    <title>Payment Records</title>

    <link rel="stylesheet"
          href="style.css">

</head>


<body>


<header>

    <h1>
        Student Fee Management System
    </h1>

    <p>
        Liyu College Campus
    </p>

</header>


<div class="container records-container">


    <h2>
        Student Payment Records
    </h2>


    <a href="pay_fees.html"
       class="btn">

        Add New Payment

    </a>


    <div class="table-wrapper">


        <table>


            <thead>

                <tr>

                    <th>ID</th>

                    <th>Student Name</th>

                    <th>Student ID</th>

                    <th>Department</th>

                    <th>Level</th>

                    <th>Fee Type</th>

                    <th>Amount</th>

                    <th>Payment Date</th>

                </tr>

            </thead>


            <tbody>


            <?php

            if (
                $result &&
                $result->num_rows > 0
            ):

                while (
                    $row =
                    $result->fetch_assoc()
                ):

            ?>


                <tr>


                    <td>

                        <?php
                        echo htmlspecialchars(
                            $row["id"]
                        );
                        ?>

                    </td>


                    <td>

                        <?php
                        echo htmlspecialchars(
                            $row["student_name"]
                        );
                        ?>

                    </td>


                    <td>

                        <?php
                        echo htmlspecialchars(
                            $row["student_id"]
                        );
                        ?>

                    </td>


                    <td>

                        <?php
                        echo htmlspecialchars(
                            $row["department"]
                        );
                        ?>

                    </td>


                    <td>

                        <?php
                        echo htmlspecialchars(
                            $row["level"]
                        );
                        ?>

                    </td>


                    <td>

                        <?php
                        echo htmlspecialchars(
                            $row["fee_type"]
                        );
                        ?>

                    </td>


                    <td>

                        ₦<?php

                        echo number_format(
                            $row["amount"],
                            2
                        );

                        ?>

                    </td>


                    <td>

                        <?php
                        echo htmlspecialchars(
                            $row["payment_date"]
                        );
                        ?>

                    </td>


                </tr>


            <?php

                endwhile;

            else:

            ?>


                <tr>

                    <td colspan="8">

                        No payment records found.

                    </td>

                </tr>


            <?php

            endif;

            ?>


            </tbody>


        </table>


    </div>


    <br>


    <a href="index.html"
       class="back">

        ← Back to Home

    </a>


</div>


</body>

</html>


<?php

$conn->close();

?>
