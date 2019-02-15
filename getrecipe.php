<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=980, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="dunno.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Receptor</title>

</head>
<body>

<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
   
  <a href="addrecipe.php">Add a recipe</a>
  <a href="#">Recipies</a>
  <!--<a href="#">My Shelf</a>
  <a href="#">About</a>
  <a href="#">Contact</a>
  <a href="#">Donate</a> -->
  <p>Search</p>
  <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
    <input type="text" placeholder="Search.." name="search2">
    <button type="submit"><i class="fa fa-search"></i></button>
  </form>

</div>
<div class="container">
  <h2 class='logo'>Receptor</h2>
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

<form method='GET' action='' autocomplete='off'>
    <div class="form-group">
        <label for='searchWord'></label>
        <input type="text" name="searchWord" id="searchWord">
        <button class="btn btn-primary" type="submit" >Send</button>
    </div>
</form>
<?php

ini_set('display_errors', 'on');
$db = new PDO('mysql:host=127.0.0.1:3306;dbname=receptor', 'root', '');


//get the result of query

if (!empty($_GET['searchWord'])){
  $searchWord = $_GET['searchWord'];
  //$getQuery = 
  $getRecipes = $db-> prepare("SELECT * FROM recipes WHERE recipeName = '$searchWord'");
  $getRecipes -> execute();
  $recipes = $getRecipes->fetchAll();
}
 foreach ($recipes as $recipe): ?>
        <div class="displayRecipe" id='<?php echo $recipe['id'] . "recipe";?>'>
            <h2><?php echo $recipe['recipeName']; ?></h2>
            <?php $path = 'uploads/';
                  $location =  $path . $recipe['imageName'];
            echo '<img src= "'.$location.'" alt="Recipe image"/>' ?>
            <h3>Preparation time<?php echo $recipe['prepTime']; ?></h3><br>
            <h3>Cooking time<?php echo $recipe['cookTime']; ?></h3><br>
            <h3>Ingredients<?php echo $recipe['ingredients']; ?></h3><br>
            <p>Instructions<br><?php echo $recipe['instructions']; ?></p><br>
            <p>Optional add ons<?php echo $recipe['optAddOns']; ?></p><br>
        </div>
<?php endforeach; ?>
</div>


<script>
  //Navigation open/close
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }  
</script>
<!-- bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> 
</body>
</html>