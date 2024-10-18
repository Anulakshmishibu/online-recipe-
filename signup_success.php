

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* General page layout */
        main {
            display: grid;
            grid-template-columns: 1fr 3fr; /* Two columns: sidebar 1fr, main content 3fr */
            gap: 20px;
        }

        /* Sidebar styling */
        .sidebar {
            display: flex;
            width: 100%;
            height: 350px;
           
        }
        .sidebar.preferences-card.recipe .slider img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        /* Preferences button card style */
        .preferences-card {
            background-color: #f9f9f9;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .preferences-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .preferences-card a {
            display: inline-block;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .preferences-card a:hover {
            background-color: #45a049;
        }

        /* Main content styling */
        .recipes {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Automatically fit as many columns as possible */
            gap: 1rem;
        }

        .recipe {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 0.875rem;
        }

        .recipe .slider img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .recipes {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .recipes {
                grid-template-columns: 1fr;
            }

            /* Move sidebar below main content on mobile */
            main {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto;
            }
        }
    </style>
    <title>Recipe On Board</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-lQIj1Mj5rKwN2gjy5sSmLIyZBhG6KDfXJ28OG3sNv1ABuvyYb34qA6NYYA2H0V6nR29cUHhM2OZ8cFyvACRPOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div class="header-container">
            <h1><i class="fas fa-utensils"></i>Recipe On Board</h1>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="login.php">Recipes</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="login.php">Upload Recipes</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Log In</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div id="content">
					<div>
						<div>
							<center><h4>Successfully Registered!</h4></center>
							<p>
								<center>Now you are the part of cooking website <a href="login.php">click here</a> to login.</center>
							</p>

							
						</div>
					</div>
				</div>
    <main>
        <!-- Sidebar: Your Preferences -->
        <aside class="sidebar">
            <div class="preferences-card">
                <div class="recipe">
                <div class="slider">
                    <img src="img/food1.avif" alt="" >
                    <img src="img/food2.avif" alt="" >
                    <img src="img/food3.avif" alt="">
                    
                </div>
                <a href="user_preference.php">Personalize your cuisines</a>
            </div>
        </aside>

        <!-- Main Content: Featured Recipes -->
        <section class="recipes">
            <h2>Featured Recipes</h2>
            <div class="user-recipes-container">
                <?php
                // Connect to the database
                $db = mysqli_connect('localhost', 'root', '', 'recipe');

                // Check the database connection
                if (!$db) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Query to fetch data from 'recipes' table and 'registration' table using 'reg_id'
                $sql = "SELECT firstname, recipename, description, ingredients, image 
                        FROM recipes 
                        INNER JOIN registration USING (reg_id)";

                $result = $db->query($sql);

                // Check if the query was successful
                if (!$result) {
                    die("Query failed: " . mysqli_error($db));
                }

                if ($result->num_rows > 0) {
                    // Output data of each row in the same card format as static recipes
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='recipe'>
                                <div class='slider'>
                                    <img src='" . $row["image"] . "' alt='Recipe Image'>
                                </div>
                                <div class='recipe-info'>
                                    <h3>" . $row["recipename"] . "</h3>
                                    <p><strong>By:</strong> " . $row["firstname"] . "</p>
                                    <p>" . $row["description"] . "</p>
                                    <a href='login.php' class='btn'>View Recipe</a>
                                </div>
                              </div>";
                    }
                } else {
                    echo "No results found.";
                }

                // Close the connection
                $db->close();
                ?>
            </div>
        </section>
    </main>

    <script src="scripts.js"></script>
</body>
</html>
