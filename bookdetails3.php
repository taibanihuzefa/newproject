<?php

include './header.php';
include './connection.php';

?>
<head>

</head>
<style>
    .myimage{
        height: 40rem;
        width: 32rem;
    }

    .rightdiv{
        margin-left: -40px;
        /* font-size: 0; */
        padding-left: 0px;
    }

    .btn{
        height: 50px;
        width: 150px;
        margin-bottom: 10px;
    }
    .btnprice{
        background-color: #f85a40;
        border-color: #f85a40;
        font-size: 25px;
        height: 55px;
        width: auto;
    }
    .issuediv{
        display: inline-grid;
    }
    .issuediv a{
        font-size: 20px;
        padding-top: 8px;
        text-align: center;
    }
    .instock{
        display: flex;
        width: 400px;
        align-items: center;
        text-align: center;
        justify-content: center;
        margin-top: -30px;
        margin-bottom: 10px;

        border: 5px solid;
        border-radius: 8px;

        animation: blink 1s;
        animation-iteration-count: infinite;
    }
    @keyframes blink { 50% { border-color: #ff0000; }  }

    .outofstock{
        display: flex;
        width: 400px;
        align-items: center;
        text-align: center;
        justify-content: center;
        margin-top: -30px;
        margin-bottom: 10px;

        border: 5px solid;
        border-radius: 8px;

        animation: blink 1s;
        animation-iteration-count: infinite;
    }
    @keyframes blink { 50% { border-color: #ff0000; }  }

    .fewleft{
        display: flex;
        width: 400px;
        align-items: center;
        text-align: center;
        justify-content: center;
        margin-top: -30px;
        margin-bottom: 10px;

        border: 5px solid;
        border-radius: 8px;

        animation: blink 1s;
        animation-iteration-count: infinite;
    
    /* height:40px;
    width:40px; */
    }
    @keyframes blink { 50% { border-color: #ff0000; }  }
    .stock h3{
        /* padding-top: 10px;
        padding-left: 5px; */
    }
</style>

<?php 
    include './connection.php';
    $book_id=$_GET['bookid'];

    // $sql ="SELECT book_details.*, author.Author_Name, publisher.Publisher_Name, edition.Edition_Name, languages.Language_Name, book_price.Book_price, 
    //     FROM book_details
    //     JOIN book_author ON book_details.Book_id = book_author.Book_id 
    //     JOIN author ON book_author.Author_id = author.Author_id
        
    //     JOIN book_publisher ON book_details.Book_id = book_publisher.Book_id
    //     JOIN publisher ON book_publisher.Publisher_id = publisher.Publisher_id
        
    //     JOIN book_edition ON book_details.Book_id = book_edition.Book_id
    //     JOIN edition ON book_edition.Edition_id = edition.Edition_id

    //     JOIN book_language ON book_details.Book_id = book_language.Book_id
    //     JOIN languages ON book_language.language_id = languages.Language_id

    //     Join book_price On book_details.Book_id= book_price.Book_id


    //     WHERE book_details.Book_id = $book_id";


$sql = "SELECT book_details.*, author.Author_Name, publisher.Publisher_Name, edition.Edition_Name, languages.Language_Name, book_price.Book_price,
        sub_category.sub_category_id, sub_category.sub_category_name, category.category_id, category.category_name
        FROM book_details

        JOIN book_author ON book_details.Book_id = book_author.Book_id 
        JOIN author ON book_author.Author_id = author.Author_id

        JOIN book_publisher ON book_details.Book_id = book_publisher.Book_id
        JOIN publisher ON book_publisher.Publisher_id = publisher.Publisher_id
        
        JOIN book_edition ON book_details.Book_id = book_edition.Book_id
        JOIN edition ON book_edition.Edition_id = edition.Edition_id
        
        JOIN book_language ON book_details.Book_id = book_language.Book_id
        JOIN languages ON book_language.Language_id = languages.Language_id
        
        JOIN book_price ON book_details.Book_id = book_price.Book_id

        JOIN category ON book_details.Book_id = category.Book_id
        
        JOIN sub_category ON category.category_id = sub_category.category_id
        
        WHERE book_details.Book_id = $book_id";


           

        
        // $sql = "select * from book_details where Book_id = $book_id";

        $record = mysqli_query($conn, $sql);

        if ($record) {
            if (mysqli_num_rows($record) > 0) {
                $row = mysqli_fetch_assoc($record);
                
                $id = $row['Book_id'];
                $isbn = $row['ISBN'];
                $bookname = $row['Book_Title'];
                $no_of_pages = $row['No_Of_Page'];
                $year = $row['Publication_Year'];
                $author = $row['Author_Name'];
                $publisher = $row['Publisher_Name'];
                $edition = $row['Edition_Name'];
                $language = $row['Language_Name'];
                $price = $row['Book_price'];
                $category = $row['category_name'];
                $subcategory = $row['sub_category_name'];
        
                $imagedisplay = base64_encode($row['image']);
            } else {
                echo "No records found.";
            }
        } else {
            // Query execution failed
            $errorMessage = mysqli_error($conn);
            echo "Query Error: " . $errorMessage;
        }
        
            
                
    ?>



<div class="breadcrumbs">
      <!-- <div class="page-header d-flex align-items-center" style="background-image: url('./images/0_aT9-nA8YKeHL43V9.jpg');"> -->
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <!-- <h2>Blog</h2>
              <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
             -->
            </div>
          </div>
        </div>
      <!-- </div> -->
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="booklist.php">Book Details</a></li>
            <li><?php echo "$category"; ?> </li>
            <li><?php echo "$subcategory"; ?> </li>
            <li><?php echo "$bookname"; ?> </li>
          </ol>
        </div>
      </nav>
</div><!-- End Breadcrumbs -->


   
        <!-- Product section-->
    
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">

                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="myimage card-img-top mb-5 mb-md-0" src="data:image/jpg;base64, <?php echo "$imagedisplay"?> " alt="..." /></div>
                    
                    <div class="rightdiv col-md-6">
                        <!-- <div class="small mb-1"><?php echo "<b>ID:</b> $id "; ?> </div> -->
                        <h1 class="display-5 fw-bolder"><?php echo "$bookname"; ?> </h1>
                        
                        <div class="fs-5 mb-5">
                            <!-- <span class="text-decoration-line-through">$45.00</span> -->
                            <button type="button" class="btn btnprice btn-primary">
                                <span><?php echo " ₹ $price "; ?></span>
                            </button>
                        </div>

                        <?php

                        $quantityQuery ="Select Quantity_id, Quantity from book_quantity where Book_id = $id";

                        $quantityRecord = mysqli_query($conn, $quantityQuery);

                        if ($quantityRecord) {
                            if (mysqli_num_rows($quantityRecord) > 0) {
                                $row = mysqli_fetch_assoc($quantityRecord);

                                $quantityid = $row['Quantity_id'];
                                $quantity = $row['Quantity'];

                                // echo $quantityid;
                                // echo" ";
                                // echo $quantity;

                            }else{
                                echo "No records found.";
                            }
                        } else {
                            // Query execution failed
                            $errorMessage = mysqli_error($conn);
                            echo "Query Error: " . $errorMessage;
                        }
                        ?>


                        <p class="fs-5 mb-5"><?php echo "<b>ISBN:</b> $isbn "; ?></br>
                            <?php echo "<b>Author:</b> $author "; ?></br>
                            <?php echo "<b>Publisher:</b> $publisher "; ?></br>
                            <?php echo "<b>Edition:</b> $edition "; ?></br>
                            <?php echo "<b>Publication Year:</b> $year"; ?></br>
                            <?php echo "<b>No Of Pages:</b> $no_of_pages"; ?></br>
                            <?php echo "<b>Language:</b> $language "; ?></br>
                            <?php echo "<b>No Of Pages:</b> $no_of_pages"; ?>


                           

                           
                        </p>

                        <?php

                        if ($quantity <= 0 ) {
                            ?>
                            <div class="outofstock">
                            <img src="./images/outofstock2.png" alt="">
                            <h4>Currently book is not available</h4>
                        </div>
                        <?php
                        } elseif ($quantity >= 1 && $quantity <= 5) {
                            ?>
                            <div class="fewleft">
                            <img src="./images/fewleft.png" alt="">
                            <h4>Hurry Up! Only few books are left</h4>
                        </div>
                        <div class="issuediv">
                            <!-- <input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" style="max-width: 3rem" /> -->
                            <a href="issuebook.php?bookTitle=<?php echo urlencode($bookname); ?>" class="btn btn-primary flex-shrink-0">Issue Book</a>
                            <a href="wish.php?bookid=<?php echo $row['ISBN'] ?>&bookname=<?php echo $row['Book_Title']?>&auth=<?php echo $row['Author_Name']?>&year=<?php echo $row['Publication_Year']?>" class="btn btn-primary flex-shrink-0"><i class="bi bi-heart me-1"></i></a>
                        </div>
                            <?php
                        } else {
                            ?>
                             <div class="instock">
                                <img src="./images/instock.png" alt="">
                                <h3>Book is available</h3>
                            </div>
                            <div class="issuediv">
                            <!-- <input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" style="max-width: 3rem" /> -->
                            <a href="issuebook.php?bookTitle=<?php echo urlencode($bookname); ?>" class="btn btn-primary flex-shrink-0">Issue Book</a>
                            <a href="wish.php?bookid=<?php echo $row['ISBN'] ?>&bookname=<?php echo $row['Book_Title']?>&auth=<?php echo $row['Author_Name']?>&year=<?php echo $row['Publication_Year']?>" class="btn btn-primary flex-shrink-0"><i class="bi bi-heart me-1"></i></a>
                        </div>
                            <?php
                        }

                            ?>

                        
                        
                       

                    </div>

                </div>
            </div>
        </section>


        <?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'apnabook';

// Category value from your PHP variables
// $category = $_POST['category']; // Assuming you get the category from a form

// Establish a database connection
$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die('Connection Error: ' . $mysqli->connect_error);
}
// echo $category;
// echo '<br>';



// SQL query to retrieve related books
$query = "SELECT bd.Book_Title, bd.ISBN, bd.image, bd.Publication_Year, bd.Book_id
          FROM category AS c
          JOIN book_details AS bd ON c.Book_id = bd.Book_id
          WHERE c.category_name = ?";

if ($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param('s', $category);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

      
       
?>
<section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related Books</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php 

                 while ($row = $result->fetch_assoc()) {
                    $newboookid = $row['Book_id'];
                    // echo $newboookid;
        
                    $imagedisplay = base64_encode($row['image']);
                    // echo '<img src = "data:image/jpg;base64,' . $imagedisplay . '" width = "60px">';
                    
                    // echo '<li>' . $row['Book_Title'] . ' (ISBN: ' . $row['ISBN'] . ')</li>';
                    ?>

                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <?php
                            echo '<img src = "data:image/jpg;base64,' . $imagedisplay . '" width = "268px" height= "350px"/>';
                            ?>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                        <?php    
                                        echo '<h5 class="fw-bolder">' . $row["Book_Title"] . '</h5>';
                                        ?> 
                                    <!-- Product author-->
                                    <?php    
                                        echo 'Year : ' . $row["Publication_Year"] . '';
                                        ?> 
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                           <?php echo '<a href="bookdetails3.php?bookid='.$row["Book_id"].'" style="margin:40px; margin-top :-5px;"; " class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="View">View</a>';

                            ?>
                            </div>
                        </div>
                    </div>
        
        
                <?php    
                }
?>

                

                    



                    
                </div>
            </div>
        </section>








<?php

        
        // echo '</ul>';
    } else {
        echo 'Query execution failed: ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo 'Query preparation failed: ' . $mysqli->error;
}

//$mysqli->close();
?>
        
        <!-- Related items section-->

        <?php 
       

                // $record = mysqli_query($conn, $sql);

                // if ($record) {
                //     if (mysqli_num_rows($record) > 0) {
                //         $row = mysqli_fetch_assoc($record);
                       
                        

                //     } else {
                //         echo "No records found.";
                //     }
                // } else {
                //     // Query execution failed
                //     $errorMessage = mysqli_error($conn);
                //     echo "Query Error: " . $errorMessage;
                // }
        ?>


        
    
    </body>
</html>


<?php

include './footer.php';

?>

