<?php
session_start(); // Move session_start to the top

include '../connection.php';

function validateDate($date)
{
    $dateFormat = 'Y-m-d';
    $dateObj = DateTime::createFromFormat($dateFormat, $date);
    return $dateObj && $dateObj->format($dateFormat) === $date;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['id'];
    $issueDates = $_POST['issue_date'];
    $dateExpires = $_POST['date_expire'];

    $updatedRecords = [];

    for ($i = 0; $i < count($ids); $i++) {
        $id = mysqli_real_escape_string($conn, $ids[$i]);
        $issueDate = mysqli_real_escape_string($conn, $issueDates[$i]);
        $dateExpire = mysqli_real_escape_string($conn, $dateExpires[$i]);

        $isValidDate = validateDate($dateExpire);

        $updateResult = false;

        if ($isValidDate) {
            $updateSql = "UPDATE issued_books SET issue_date = '$issueDate', date_expire = '$dateExpire' WHERE id = '$id'";
            $updateResult = mysqli_query($conn, $updateSql);

            if ($updateResult) {
                $updatedRecords[] = $id;
            } else {
                echo "Error updating record with ID $id: " . mysqli_error($conn) . "<br>";
            }
        }

        if (!$isValidDate && $updateResult) {
            echo "Invalid date format: $dateExpire. Record with ID $id not updated.<br>";
        }
    }

    if (!empty($updatedRecords)) {
        foreach ($updatedRecords as $recordId) {
            echo '<script>alert("Submitted records updated successfully. Record with ID ' . $recordId . ' updated successfully")</script>';
        }

        // Redirect to ccqr.php after database update
        header("Location: ccqr.php");
        exit();
    }
}
?>
<?php
include './admin-header.php';
?>
<style>
    .issued-books-table {
        width: 100%;
        border-collapse: collapse;
    }

    .issued-books-table th,
    .issued-books-table td {
        padding: 8px;
        border: 1px solid #ccc;
    }

    .issued-books-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .issued-books-table td input[type='text'],
    .issued-books-table td input[type='date'] {
        width: 100%;
        padding: 4px;
        box-sizing: border-box;
    }

    .issued-books-table td button {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    .issued-books-table td button:hover {
        background-color: #45a049;
    }
</style>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Book Details Table</h5>
                        <p>Total numbers of Books registered in the system</p>
                        <form method='POST' action=''>
                            <table class="table datatable issued-books-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr. No.</th>
                                        <th scope="col">Book Title</th>
                                        <th scope="col">User Email</th>
                                        <th scope="col">Issue Date</th>
                                        <th scope="col">Date Expire</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM issued_books WHERE issue_date IS NULL AND date_expire IS NULL";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        $rowNumber = 1;

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo "<td><input type='text' name='id[]' value='" . $row['id'] . "' readonly></td>";
                                            echo "<td><input type='text' name='book_title[]' value='" . $row['book_title'] . "' readonly></td>";
                                            echo "<td><input type='text' name='userEmail[]' value='" . $row['userEmail'] . "' readonly></td>";
                                            echo "<td><input type='date' name='issue_date[]' value='" . date('Y-m-d') . "' readonly></td>";
                                            echo "<td><input type='date' name='date_expire[]' min='" . date('Y-m-d') . "'></td>";
                                            echo "<td><button type='submit' name='submit_row[" . $rowNumber . "]'>Submit</button></td>";
                                            echo '</tr>';

                                            $rowNumber++;
                                            $_SESSION['vinayemail'] = $row['userEmail'];
                                            $_SESSION['vinayid']=$row['id'];
                                        }
                                    } else {
                                        echo "No records found.";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include './admin-footer.php';
?>
