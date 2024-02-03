function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "header-right") {
    x.className += " responsive";
  } else {
    x.className = "header-right";
  }
}