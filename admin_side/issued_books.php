<?php 
include './admin-header.php';
include '../connection.php';

?>

<main id="main">
    <!-- issued books table section -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Issued Books Table</h5>
              <p>This table give the information about the books that are issued to the different users </p>

              <?php

              $sql="SELECT * FROM issued_books
              WHERE issue_date IS NOT NULL AND date_expire IS NOT NULL";
            //   $sql="select * from  issued_books";
              $query=mysqli_query($conn,$sql);
              $row=mysqli_num_rows($query);
              
              ?>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Sr. No.</th>
                    <th scope="col">Book Title</th>
                    <th scope="col">User Email</th>
                    <th scope="col">Issue Date</th>
                    <th scope="col">Returned Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>


                <tbody>
                <?php

                // initialising the counter variable 
                $counter= 1;    
                    while($result = mysqli_fetch_assoc($query))
                    {
                    echo  "<tr>
                    <td>" . $counter . "</td>
                    <td>".$result['book_title']."</td>
                    <td>".$result['userEmail']."</td>
                    <td>".$result['issue_date']."</td>
                    <td>".$result['date_expire']."</td>
                    
                    
                    </tr>";

                    // Increment the counter
                    $counter++; 
                    
                
                    
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

  <!-- ends issued books table section -->



</main>

<?php 

include './admin-footer.php';
?>