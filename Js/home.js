let card = document.querySelectorAll(".card")
let box = document.getElementById("popup");


var myFunction = function() {
    var attribute = this.getAttribute("data-myattribute");
    alert(attribute);
};

card.forEach(el => el.addEventListener('click', event => {
    console.log(event.target.getAttribute("data-el"));
}));

box.addEventListener("click", () =>{
    box.classList.remove("visivel");
})