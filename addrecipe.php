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
</div>

<div class="addRecipe">
<?php //post recipe

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
<form action="" method='POST' enctype='multipart/form-data'>
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