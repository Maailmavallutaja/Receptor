<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Handlee|Pacifico|Indie+Flower" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="dunno.css">
    <!-- Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <title>Receptor</title>
    <script language="JavaScript">
    function showInput() {
      document.getElementById('display').innerHTML =
        document.getElementById("user_input").value;
    }
  </script>
</head>
<body>
<div id="container">
  <div class="row">
  <div class="col col2">
  <!-- navigation-->
    <div id="mySidenav" class="sidenav">
      
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="#searchRecipe" id='searchRecipe'>Search a recipe</a>
      <a href="#addrecipe" id='addRecipe'>Add a recipe</a>
      <a href="#about" id='about'>About</a>
      <a href="#donate" id='donate'>Donate</a>
        </div>

    <div class='smallbutton'>
      <span style="font-size:30px;cursor:pointer" onclick="openNav()"> <img src="justbutton.png" onmouseover="this.src='activebutton.png';" onmouseout="this.src='justbutton.png';"></span>
        </div>
        
  <div class="imageContainer">.
    <h1 class='logo'>Receptor</h1>
     </div>


  <section id="searchRecipeSection">

    <form method='GET' action='' autocomplete='off'>
        <div class="form-group">
            <label for='searchWord'></label>
            <input type="text" name="searchWord" id="searchWord">
            <button class="btn btn-primary" type="submit" >Search</button>
        </div>
    </form>
    <?php
    //connect trough PDO
    ini_set('display_errors', 'on');
    $db = new PDO('mysql:host=127.0.0.1:3306;dbname=receptor', 'root', '');

    //get the results based on search
    $searchWord = '';
    if (!empty($_GET['searchWord'])){
      $searchWord = $_GET['searchWord'];
      $getRecipes = $db-> prepare("SELECT * FROM recipes WHERE recipeName LIKE '%$searchWord%'");
      $getRecipes -> execute();
      $recipes = $getRecipes->fetchAll();

      //display the recipies
      foreach ($recipes as $recipe): ?>
              
                <h2><?php echo $recipe['recipeName']; ?></h2>
                <?php $path = 'uploads/';
                  $location =  $path . $recipe['imageName'];
                echo '<img src= "'.$location.'" alt="Recipe image" />' ?>

                <h3>Preparation time <div class="recipeContent"><?php echo $recipe['prepTime']; ?></div></h3><br>
                <h3>Cooking time <div class="recipeContent"><?php echo $recipe['cookTime']; ?></div></h3><br>
                <h3>Ingredients<br>
                    <div class="recipeContent"><?php echo $recipe['ingredients']; ?></div></h3><br>
              <p>Instructions<br>
                <div class="recipeContent"><?php echo $recipe['instructions']; ?></div></p><br>
              <p>Optional add ons 
              <div class="recipeContent"><?php echo $recipe['optAddOns']; ?></div></p><br>
          
      <?php
      endforeach;
      // if no recipies returned, display notification
      if($recipes == false){
        echo 'Your search returned 0 results';
      }
    }
     ?>
  </section>

  <section id="addRecipeSection">
    <?php 

    //!add recipe name, image(optional)
    //! image type in database
    // https://stackoverflow.com/questions/9153224/how-to-limit-file-upload-type-file-size-in-php 
    //connect to database
    ini_set('display_errors', 'on');
    $db = new PDO('mysql:host=127.0.0.1:3306;dbname=receptor', 'root', '');

    if(!empty($_POST)){ // if fields are not empty
      
      $recipeName = $_POST['recipeName'];
      $prepTime = $_POST['prepTime'];
      $cookTime = $_POST['cookTime'];
      $instructions = $_POST['instructions'];
      $ingredients = $_POST['ingredients'];
      $optAddOns = $_POST['optAddOns'];
      
      if(isset($_FILES['upload_img']) === true && //if there is an image
          (($_FILES["upload_img"]["type"] == "image/gif") || //check type
          ($_FILES["upload_img"]["type"] == "image/jpeg") || 
          ($_FILES["upload_img"]["type"] == "image/jpg") ||
          ($_FILES["upload_img"]["type"] == "image/pjpeg") || 
          ($_FILES["upload_img"]["type"] == "image/png") &&
          ($_FILES["upload_img"]["size"] < 2097152)) ){ // if file size is under 2 MB
              $imageName = addslashes($_FILES['upload_img']['name']); 
              $targetDir = "uploads/";
              $fileName = basename($_FILES["upload_img"]["name"]);
              $targetFilePath = $targetDir . $imageName;
              move_uploaded_file($_FILES["upload_img"]["tmp_name"], $targetFilePath);
          } else {
              echo '<script>alert("Please upload image of gif/jpeg/pjpeg/png type and of size under 2 MB");</script>';
              exit();
      };

      $recipe = $db->prepare('
      INSERT INTO recipes (recipeName, prepTime, cookTime, instructions, ingredients, optAddOns, imageName)
      VALUES (:recipeName, :prepTime, :cookTime, :instructions, :ingredients, :optAddOns, :imageName)
      ');

      //assign values to the keys and execute
      $recipe -> execute ([
          'recipeName' => $recipeName,
          'prepTime' => $prepTime,
          'cookTime' => $cookTime,
          'instructions' => $instructions,
          'ingredients' => $ingredients,
          'optAddOns' => $optAddOns,
          'imageName' => $imageName
      ]);
      
    }

    ?>

    <!-- Form for recipe-->
    <form action="" method='POST' enctype='multipart/form-data' autocomplete='off'>
    <div class="form-group">
        <label for='recipeName'>Name</label>
        <input type="text" name="recipeName" id="recipeName">
    </div>
    <div class="form-group">
        <label for='prepTime'>Preparations Time</label>
        <input class="form-control" type='number' name='prepTime' id='cookTime'>
    </div>
    <div class="form-group">
        <label for='cookTime'>Cooking Time</label>
        <input class="form-control" type='number' name='cookTime' id='cookTime' >
    </div>
    <div class="form-group">
        <label for ='instructions'>Cooking instructions</label>
        <input class="form-control" type="textarea" name="instructions" id="instructions">
    </div>
    <div class="form-group">
        <label for ='ingredients'>Ingredients</label>
        <input class="form-control" type="text" name="ingredients" id="ingredients">
        <small class='form-text'>Please separate with space</small>

    </div>
    <div class="form-group">
        <label for ='optAddOns'>Additional ingredients</label>
        <input class="form-control" type="text" name="optAddOns" id="optAddOns">
        <small class='form-text'>Adding additional ingredients is optional</small>
    </div>
    <div class="form-group">
        <input type="file" name="upload_img">
        <small class='form-text'>Adding image is optional. Maximum file size is 2MB</small>
    </div>
    
    <button class="btn btn-primary" type="submit" >Send</button>
    </form>

  </section>
  <section id='aboutSection'>
   <p> Receptor is an open-source application </p>
   <p> Current release 0.0.1 (Alpha) </p>
   <p> Codebase available <a href='https://github.com/Maailmavallutaja/Receptor'>here </a><p>
    <br>
   <h4> Created by</h4><br>
   <p>arch666</p>
   <p>&&</p>
   <p>maailmavallutaja</p>
   <p>&&</p>
   <p>HHenryRoos</p>
  </section>

  <section id='donationSection'>
      <p> You can donate to us (Maailmavallutaja) </p>
      <p>
      <img src="ethereum.svg" alt="ETH logo"><span><a href=https://etherscan.io/address/0xbeeb87e3914d3a7ca25344a09f2ef2815f202d9f> 0xbeEB87e3914d3A7cA25344A09F2ef2815f202d9F</a></span><br>
      <img src='bitcoin.svg'alt='BTC logo'><span><a href='https://www.blockchain.com/btc/address/1CpjwPKQG5N4VQf6AtFpdoJCVxsovxzeGG'>  1CpjwPKQG5N4VQf6AtFpdoJCVxsovxzeGG</a></span>
  </section>

  <!-- End for row, col2 -->
  </div>
  </div>

<script>
  //Navigation open/close
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

  
  //Section switch hidden/visible
  // To do -> make into for loop
  // Reset searchWord when opening new tab
    $(document).ready(function() {
      
      // $(document).on('click', function(){
      //   if(document.getElementById("mySidenav").style.width == "250px"){
      //   closeNav();
      //   }
      // });  
        $('#searchRecipe').on('click', function() {
            $('#searchRecipeSection').show();
            $('#addRecipeSection').hide();
            $('#aboutSection').hide();
            $('#donationSection').hide();
            closeNav();
        });

        $('#addRecipe').on('click', function() {
          $('#searchRecipeSection').hide();
          $('#addRecipeSection').show();
          $('#aboutSection').hide();
          $('#donationSection').hide();
          closeNav();
        });

        $('#about').on('click', function() {
          $('#searchRecipeSection').hide();
          $('#addRecipeSection').hide();
          $('#aboutSection').show();
          $('#donationSection').hide();
          closeNav();
        });
        $('#donate').on('click', function() {
          $('#searchRecipeSection').hide();
          $('#addRecipeSection').hide();
          $('#aboutSection').hide();
          $('#donationSection').show();
          closeNav();
        });        
    });

</script>
<!-- bootstrap CS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> 
</body>
</html>