//save form input
var localIngredients = []; // declare new array
var addedIngredient = document.getElementById('addedIngredient').innerHTML; // get ingredient from form input

var addButton = document.getElementById('saveIngredientButton');// declare Addbutton
var removeButton = document.getElementById('removeIngredientButton');


//to display new added ingredient

function displayIngredient(localIngredient) {
    
    var displayLocalIngredients = document.createElement('p'); //create the element
    displayLocalIngredients.innerHTML = localIngredient; //declare the content of the element
    document.getElementById('ingredientsDisplay').appendChild(displayLocalIngredients); // add created HTML element to document
    var createRemoveButton = document.createElement()
}

function getIngredientId(){
    
}
//fuction to add ingredient to localIngredients array
addButton.onclick = function addIngredient(ingredient) {
    localIngredients.push(ingredient); // add ingredient to array (array push method)
    displayIngredient(ingredient); // display the ingredient
    document.getElementById('addedIngredient').reset(); // resets the input field
};

//fuction to add ingredient to localIngredients array
addButton.onclick = function addIngredient(ingredient) {
    localIngredients.push(ingredient); // add ingredient to array (array push method)
    displayIngredient(ingredient); // display the ingredient
    document.getElementById('addedIngredient').reset(); // resets the input field
};
// Should use form submit() function instead?
//https://www.w3schools.com/jsref/met_form_submit.asp


//function to create removing button
removeButton.onclick = function removeIngredient() {
    localIngredients.pop();
};

class Ingredient{
    constructor(name){
        this.name = name;
        
    }
    //to display new added ingredient
    
}

// So I have functions to add new item to ingredients array and to display it. I want to add a button to the display that you can press
// in order to remove the item from display. How can I define that this particular button click will remove this particular HTML tag form the screen and also string from array.

/*
Necessary functions:
- Create ingredient Id
- Create form for ingredient
- Onsubmit of form
- add ingredient to array(name, id)
- remove ingredient from array
-