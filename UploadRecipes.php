<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'recipe');

// Check if form is submitted
if (isset($_POST['submit'])) {
    $recipename = $_POST['recipename'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $directions=$_POST['directions'];
    $cuisiens=$_POST['cuisiens'];
    $dietary_restrictions=$_POST['dietary_restrictions'];
    
    // Handling the image upload
    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    
    extract($_POST);

    $dir = "img/";
    $file = $_FILES['image']['name'];
    $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $target = $dir . uniqid("image_") . "." . $file_type;
    
    // Full path to store the image
    // $path = $location . basename($image); 
    
    // Store the user session ID
    $reg_id = $_SESSION['reg_id'];
    
    // Move the uploaded file to the specified directory
    if (move_uploaded_file($temp_name, $target)) {
        // SQL query to insert recipe data along with image path
        $sql = "INSERT INTO `recipes`(reg_id, recipename, description, ingredients,directions, image, cuisiens,dietary_restrictions) 
                VALUES ('$reg_id', '$recipename', '$description', '$ingredients',''$directions, '$target', '$cuisiens', '$$dietary_restrictions')";
        $query = mysqli_query($db, $sql);
        
        if ($query) {
            header('location: home.php');
        } else {
            echo "Error: " . mysqli_error($db);
        }
    } else {
        echo "Failed to upload the image.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Upload Recipe</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
   
</head>
<body>
<header>
    <div class="header-container">
        <h1><i class="fas fa-utensils"></i> Recipe Search</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="recipes.php">Recipes</a></li>
                <li><a href="#">Upload Recipes</a></li>
                <li><a href="rating.php">Rating</a></li>
                <li><a href="view_preference.php">saved preference</a></li>
                <li><a href="index.html">Log out</a></li>
            </ul>
        </nav>
    </div>
</header>

    <main>
        <section class="upload-form">
            <center>
            <h2>Upload Your Recipe</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">

                    <input type="text" id="recipeName" name="recipename"placeholder="Recipe Name" class="form-control" required>
                </div>
                <div class="form-group">

                    <textarea id="description" name="description" placeholder="Description"class="form-control" required></textarea>
                </div>
                <div class="form-group">

                    <textarea id="ingredients" name="ingredients" placeholder="Ingredients" class="form-control"required></textarea>
                </div>
                <div class="form-group">
                    <textarea id="directions" name="directions" placeholder="Directions" class="form-control"required></textarea>
                </div>
                <div class="form-group">
                    <textarea id="cuisiens" name="cuisiens" placeholder="Cuisiens" class="form-control"required></textarea>
                </div>
                <div class="form-group">
                    <textarea id="dietary_restrictions" name="dietary_restrictions" placeholder="Dietary_restrictions" class="form-control"required></textarea>
                </div>
                <div class="form-group">
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Submit Recipe</button>
            </form>
            </center>
        </section>
    </main>
</body>
</html>
