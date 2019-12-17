var cash = 0;

function cashClick(number){
  cash = cash + number;
  document.getElementById("cash").innerHTML = cash;
};

var cursors = 0;

function buyCursor(){
  var cursorCost = Math.floor(10 * Math.pow(2,cursors));     //works out the cost of this cursor
  if(cash >= cursorCost){                                   //checks that the player can afford the cursor
      cursors = cursors + 1;                                   //increases number of cursors
  	cash = cash - cursorCost;                          //removes the cash spent
      document.getElementById('cursors').innerHTML = cursors;  //updates the number of cursors for the user
      document.getElementById('cash').innerHTML = cash;  //updates the number of cash for the user
  };
  var nextCost = Math.floor(10 * Math.pow(2,cursors));       //works out the cost of the next cursor
  document.getElementById('cursorCost').innerHTML = nextCost;  //updates the cursor cost for the user
};

var cats = 0;

function buyCats(){
  var catsCost = Math.floor(20 * Math.pow(4,cats));     //works out the cost of this cat
  if(cash >= catsCost){                                   //checks that the player can afford the cat
      cats = cats + 1;                                   //increases number of cats
  	cash = cash - catsCost;                          //removes the cash spent
      document.getElementById('cats').innerHTML = cats;  //updates the number of cats for the user
      document.getElementById('cash').innerHTML = cash;  //updates the number of cash for the user
  };
  var nextCost = Math.floor(20 * Math.pow(4,cats));       //works out the cost of the next cat
  document.getElementById('catsCost').innerHTML = nextCost;  //updates the cat cost for the user
};

var dogs = 0;

function buyDogs(){
  var dogsCost = Math.floor(40 * Math.pow(8,dogs));     //works out the cost of this dog
  if(cash >= dogsCost){                                   //checks that the player can afford the dog
      dogs = dogs + 1;                                   //increases number of dogs
  	cash = cash - dogsCost;                          //removes the cash spent
      document.getElementById('dogs').innerHTML = dogs;  //updates the number of dogs for the user
      document.getElementById('cash').innerHTML = cash;  //updates the number of cash for the user
  };
  var nextCost = Math.floor(40 * Math.pow(8,dogs));       //works out the cost of the next dog
  document.getElementById('dogsCost').innerHTML = nextCost;  //updates the dog cost for the user
};

var prestige = 0;

var clicksPerSec = 0;

function calcClicksPerSec() {
  clicksPerSec = cursors + (cats*2) + (dogs*4);
  document.getElementById('clicksPerSec').innerHTML = clicksPerSec;
};

//Enabling Buttons
/*function enableBuyCursor() {
  if (cash >= cursorCost) {
    document.getElementById("buy_btn").disabled = true;
  } else {
    document.getElementById("buy_btn").disabled = true;
  }
};*/

//Unhiding Upgrades
/*function unhideCat() {
  var catVis = document.getElementById("catsDIV");
  if (catVis.style.display === "none") {
    catVis.style.display = "block";
  } else {
    return;
  }
};*/

//Save Game
function save(){
  var save = {
    cash: cash,
    cursors: cursors,
    cats: cats,
    dogs: dogs,
    prestige: prestige,
    clicksPerSec: clicksPerSec
  };
  localStorage.setItem("save",JSON.stringify(save));
};

var savegame = JSON.parse(localStorage.getItem("save"));

//Load Game
function load(){
  if (typeof savegame.cash !== "undefined") cash = savegame.cash;
  if (typeof savegame.cursors !== "undefined") cursors = savegame.cursors;
  if (typeof savegame.cats !== "undefined") cats = savegame.cats;
  if (typeof savegame.dogs !== "undefined") dogs = savegame.dogs;
  if (typeof savegame.prestige !== "undefined") prestige = savegame.prestige;
  if (typeof savegame.clicksPerSec !== "undefined") clicksPerSec = savegame.clicksPerSec;
  document.getElementById('cursors').innerHTML = cursors;  //updates the number of cursors for the user
  document.getElementById('cats').innerHTML = cats;  //updates the number of cats for the user
  document.getElementById('dogs').innerHTML = dogs;  //updates the number of dogs for the user
  document.getElementById('cash').innerHTML = cash;  //updates the number of cash for the user
  document.getElementById('clicksPerSec').innerHTML = clicksPerSec;  //updates the number of clicksPerSec for the user
};

window.setInterval(function(){

	cashClick(cursors);
  cashClick(cats*2);
  cashClick(dogs*4);

}, 1000);
