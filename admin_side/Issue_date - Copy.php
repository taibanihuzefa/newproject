
<?php 
include './admin-header.php';
include '../connection.php';

?>

<style>
.issued-books-table {
    width: 100%;
    border-collapse: collapse;
}

.issued-books-table th, .issued-books-table td {
    padding: 8px;
    border: 1px solid #ccc;
}

.issued-books-table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.issued-books-table td input[type='text'], .issued-books-table td input[type='date'] {
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


    <?php



    // Retrieve records with null Issue Date and Date Expire
    // $sql = "SELECT * FROM issued_books WHERE issue_date IS NULL AND date_expire IS NULL";
    // $result = mysqli_query($conn, $sql);

    // // Check if any records are found
    // if (mysqli_num_rows($result) > 0) {
    //     echo "<form method='POST' action='submit.php'>";
    //     echo "<table class='issued-books-table'>";
    //     echo "<tr><th>ID</th>
    //     <th>Book Title</th>
    //     <th>User Email</th>
    //     <th>Issue Date</th>
    //     <th>Date Expire</th>
    //     <th>Action</th>
    //     </tr>";

    //     // Initialize row counter
    //     $rowNumber = 1;

    //     // Loop through each row of data and display it in the table
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         echo "<tr>";
    //         echo "<td><input type='text' name='id[]' value='" . $row['id'] . "'></td>";
    //         echo "<td><input type='text' name='book_title[]' value='" . $row['book_title'] . "'></td>";
    //         echo "<td><input type='text' name='userEmail[]' value='" . $row['userEmail'] . "'></td>";
    //         echo "<td><input type='date' name='issue_date[]' value='" . date('Y-m-d') . "' readonly></td>";
    //         echo "<td><input type='date' name='date_expire[]' min='" . date('Y-m-d') . "'></td>";
    //         echo "<td><button type='submit' name='submit_row[" . $rowNumber . "]'>Submit</button></td>";
    //         echo "</tr>";

    //         // Increment row counter
    //         $rowNumber++;
    //     }

    //     echo "</table>";
    //     echo "</form>";
    // } else {
    //     echo "No records found.";
    // }

    // Close the database connection
    // mysqli_close($conn);
    ?>



<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Book Details Table</h5>
                    <p>Total numbers of Books registered in the system</p>
                    <!-- Table with stripped rows -->
                    <?php 
                    echo "<form method='POST' action='submit.php'>"; 
                    ?>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No.</th>
                                <!-- <th scope="col">Book Image</th> -->
                                <!-- <th scope="col">ISBN</th> -->
                                <th scope="col">Book Title</th>
                                <th scope="col">User Email</th>
                                <th scope="col">Issue Date</th>
                                <th scope="col">Date Expire</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                // Retrieve records with null Issue Date and Date Expire
                                $sql = "SELECT * FROM issued_books WHERE issue_date IS NULL AND date_expire IS NULL";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {

                                    // Initialize row counter
                                    $rowNumber = 1;

                                    // // Loop through each row of data and display it in the table
                                    // while ($row = mysqli_fetch_assoc($result)) {
                                    //     echo "<tr>";
                                    //     echo "<td><input type='text' name='id[]' value='" . $row['id'] . "'></td>";
                                    //     echo "<td><input type='text' name='book_title[]' value='" . $row['book_title'] . "'></td>";
                                    //     echo "<td><input type='text' name='userEmail[]' value='" . $row['userEmail'] . "'></td>";
                                    //     echo "<td><input type='date' name='issue_date[]' value='" . date('Y-m-d') . "' readonly></td>";
                                    //     echo "<td><input type='date' name='date_expire[]' min='" . date('Y-m-d') . "'></td>";
                                    //     echo "<td><button type='submit' name='submit_row[" . $rowNumber . "]'>Submit</button></td>";
                                    //     echo "</tr>";

                                    //     // Increment row counter
                                    //     $rowNumber++;
                                    // }

                                $counter=1;
                                while ($row = mysqli_fetch_assoc($result)) {

                                    // $id = $row['id'];
                                    // $BookTitle = $row['book_title'];
                                    // $UserEmail = $row['userEmail'];
                                    // $IssueDate = date('Y-m-d');
                                    // $DateExpire = $row['date_expire'];

                                    
                                    
                                    // echo '<td><img src="data:image/jpg;base64,' . $row["image"] . '" width="60px"></td>';
                                    // echo "<td><input name='issue_date[]' value='" . date('Y-m-d') . "' readonly></td>";
                                    
                                    // echo '<td>' . $row["userEmail"] . '</td>';

                                     // // echo "<td> $counter </td>";
                                    // echo "<td><input type='text' name='id[]' value='" . $row['id'] . "'></td>";
                                    // echo "<td> $BookTitle </td>";
                                    // echo "<td> $UserEmail </td>";
                                    // echo "<td> $IssueDate </td>";
                                    // // echo '<td>' . date('Y-m-d') . '</td>';
                                    // echo "<td><input type='date' name='date_expire[]' min='" . date('Y-m-d') . "'></td>";
                                    // // echo '<a href="submit.php?id=' . $row["id"] . '&issue_date=' . $row["issue_date"] . '&date_expire=' . $row["date_expire"] . '" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="View">View</a>';
                                    // // echo '<a href="submit.php?ids='.$row["id"]. '" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="View">View</a>';







                                    echo '<tr>';

                                        echo "<td><input type='text' name='id[]' value='" . $row['id'] . "'readonly></td>";
                                        echo "<td><input type='text' name='book_title[]' value='" . $row['book_title'] . "'readonly></td>";
                                        echo "<td><input type='text' name='userEmail[]' value='" . $row['userEmail'] . "'readonly></td>";
                                        echo "<td><input type='date' name='issue_date[]' value='" . date('Y-m-d') . "' readonly></td>";
                                        echo "<td><input type='date' name='date_expire[]' min='" . date('Y-m-d') . "'></td>";
                                        // echo "<td><button type='submit' name='submit_row[" . $rowNumber . "]'>Submit</button></td>";
                                    echo "<td> <button id='myButton' class='btn btn-success' data-toggle='tooltip' data-placement='bottom' title='Submit' type='submit' name ='submit_row[" . $rowNumber . "]'> Submit </button></td>";
                                    echo '</tr>';
                                

                                     // Increment row counter
                                     $rowNumber++;
                                    //  $counter++;    
                                }
                                echo "</form>";
                            } else {
                                echo "No records found.";
                            }   
                            ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>


</main>

<!-- <button id="myButton" onclick="redirectToSubmitPage()">Click me</button> -->

<!-- <script>
  function redirectToSubmitPage() {
    window.location.href = 'submit.php';
  }
</script> -->








<?php 

include './admin-footer.php';
?>