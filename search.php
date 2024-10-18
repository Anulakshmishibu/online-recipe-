<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
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
                    <li><a href="#">search Recipes</a></li>
                    <li><a href="UploadRecipes.php">Upload Recipes</a></li>
                    <li><a href="rating.php">View Rating</a></li>
                    <li><a href="view_preference.php">saved preference</a></li>
                    <li><a href="index.php">Log out</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="recipe-search">
            <h2>Search Recipes</h2>
            <form id="searchForm" action="#" method="GET">
                <div class="search-container">
                    <input type="text" id="searchInput" name="search" placeholder="Search recipes...">
                    <button type="submit" id="searchButton"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </section>
        
        <section id="recipes" class="recipes">
            <!-- Recipes will be dynamically inserted here -->
        </section>
    </main>

    <script src="scripts.js"></script>
    <script>
        // Sample recipes data (replace this with your actual data or fetch from API)
        const recipes = [
            { title: "Spaghetti Bolognese", description: "A classic Italian pasta dish.", },
            { title: "Grilled Chicken", description: "Juicy grilled chicken with spices.", },
            { title: "Veggie Salad", description: "A fresh, healthy veggie salad.", },
            { title: "Chocolate Cake", description: "Delicious, moist chocolate cake.", },
            { title: "Tacos", description: "Mexican tacos with beef and veggies.",}
        ];

        const recipesContainer = document.getElementById('recipes');

        // Function to display recipes based on search
        function displayRecipes(searchQuery = "") {
            recipesContainer.innerHTML = '';
            const filteredRecipes = recipes.filter(recipe => 
                recipe.title.toLowerCase().includes(searchQuery.toLowerCase())
            );

            if (filteredRecipes.length === 0) {
                recipesContainer.innerHTML = '<p>No recipes found</p>';
                return;
            }

            filteredRecipes.forEach(recipe => {
                const recipeElement = `
                    <div class="recipe-card">
                        <img src="${recipe.imageUrl}" alt="${recipe.title}">
                        <div class="recipe-info">
                            <h3>${recipe.title}</h3>
                            <p>${recipe.description}</p>
                            <a href="#" class="btn">View Recipe</a>
                        </div>
                    </div>
                `;
                recipesContainer.innerHTML += recipeElement;
            });
        }

        // Initial load: Display all recipes
        displayRecipes();

        // Event listener for form submission (search button click)
        const searchForm = document.getElementById('searchForm');
        searchForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            const searchQuery = document.getElementById('searchInput').value;
            displayRecipes(searchQuery); // Filter and display recipes
        });
    </script>
</body>
</html>
