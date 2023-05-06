
<?php
include 'C:\xampp\htdocs\food2\navbar.php';
?>

<!doctype html>
<html lang="en">

<head>
    <style>
        .cardcont {
            width: 100vw;
            display: grid;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            /* grid-template-columns: repeat(3,1fr);
            grid-template-rows: repeat(5,1fr); */
        }

        .card {
            margin: 20px 0px 0px 20px;
            border-radius: 20px;
        }

        .card-img-top {
            height: 250px;
            width: 100px;
        }

        .addcart {
            color: aliceblue;
            background-color: #F17766;
            border-radius: 7px;
            border: none;
            font-size: 20px;
            ;
            font-family: 'Fjalla One', sans-serif;
        }

        .addcart:hover {
            box-shadow: 0px 2px 2px black;
        }

        .addcart:focus {
            box-shadow: none;
            outline: none;
            border: outset;
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap|Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>guj</title>
</head>

<body>
    <br>
    <div class="jumbotron" style="background-color:#F17766">
        <h1 class="display-4">Gujrati Dishes</h1>
        <hr class="my-3" style="font-family:'Lobster',sans-serif">
        <p>Whether you are a lifelong fan of Gujarati cuisine or trying it for the first time, our site is the perfect place to savor the flavors and textures of this unique regional cuisine. So come and join us for a culinary journey through the tastes and traditions of Gujarat!</p>
    </div>
    <h4>Choose Your food and cold-drinks ...</h4>
    <hr>
    <div class="recsec">

        <?php

        // session_start();
        //connecting to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "RBH";
        //creating a connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("sorry we failed to connect:" . mysqli_connect_error());
        } else {
            // echo "connected successfully  ";
            echo "<br>";
        }

        //add to cart scripts
        if(!isset($_SESSION['totalItems'])){
            $_SESSION['totalItems'] = 0;
            }
        if (isset($_POST['addcart'])) {

            if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart']) || empty($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
                

                $myItems=array_column($_SESSION['cart'],'name');
                if(in_array($_POST['name'],$myItems)){
                    echo'<script >alert("This item is already Exist in cart");</script>';
                }
                else{
                    
                $item = array(
                    'id' => $_POST['id'],
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'file_path' => $_POST['file_path'],
                    // 'available' =>  $_POST['available'],
                    'quantity' => 1

                );
                $_SESSION['totalItems']++;
        
                $_SESSION['cart'][] = $item;
                echo '<script >alert("Item Successfully added to Cart");</script>';
                
                //  header('Location: ["PHP_SELF"]');
                // exit();
            }
        }
    



        $sql = "SELECT * FROM `gujarati_items`";
        $result = mysqli_query($conn, $sql);

        //find the number of records if greater than zero we will do further process
        $num = mysqli_num_rows($result);
        if ($num) {
            // start of container
            echo '<div class="recsec" >';
            echo '<div class="cardcont"">';
            // loop through the records and create a card for each one
            while ($row = mysqli_fetch_assoc($result)) {

                echo '<div class="card" style="width: 18rem;">';
                echo '<img class="card-img-top" src="' . $row['file_path'] . '" alt="' . $row['name'] . '">';
                echo '<div class="card-body">';
                echo '<form method="post">';
                echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                echo '<p class="card-text">' . '&#8377;' . $row['price'] . '</p>';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '" />';
                echo '<input type="hidden" name="name" value="' . $row['name'] . '" />';
                echo '<input type="hidden" name="price" value="' . $row['price'] . '" />';
                echo '<input type="hidden" name="file_path" value="' . $row['file_path'] . '" />';
                echo '<input type="hidden" name="available" value="' . $row['available'].'" />';

                if ($row['available'] == 1) {

                    echo ' <button class="addcart" type="submit" name="addcart" class="btn btn-secondary">Add to Cart</button>';
                } else {
                    echo '<p class="card-text"><span class="stock" style="color:red">Out of Stock</span></p>';
                }
                echo '</form>';




                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
            echo '</div>';
        }
        ?>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<script>
    // let btn=document.querySelector('.addcart');
    // btn.addEventListener('click',()=>{
    //     location.reload();
    // });
</script>
</html>