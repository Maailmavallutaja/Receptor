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
    <!-- Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <title>Receptor</title>

</head>
<body>

<body>
<!-- navigation-->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#searchRecipe" id='searchRecipe'>Search a recipe</a>
  <a href="#addrecipe" id='addRecipe'>Add a recipe</a>
  <a href="#about" id='about'>About</a>
  <a href="#donate" id='donate'>Donate</a>
<!-- no need currently
  <p>Search</p>
  <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
    <input type="text" placeholder="Search.." name="search2">
    <button type="submit"><i class="fa fa-search"></i></button>
  </form>
-->
</div>
<div id="container">
  <h2 class='logo'>Receptor</h2>
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>


  <section id="searchRecipeSection">
      This is search
  </section>

  <section id="addRecipeSection">
      This is addrecipe
  </section>

  <section id='aboutSection'>
    About information
  </section>

  <section id='donationSection'>
    information about donation
  </section>
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
$(document).ready(function() {
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