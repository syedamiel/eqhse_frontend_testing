/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("active");
var i;

  for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("dropdown-component");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

/*
const addButton = document.getElementById('add-button');

addButton.addEventListener('click', () => {
let highestId = 0;
const whyElements = document.querySelectorAll('.form-group-1');

// Find the highest existing ID
whyElements.forEach(element => {
const currentId = parseInt(element.id.slice(3));
highestId = Math.max(highestId, currentId); // Update highestId if current is higher
});

const newId = highestId + 1;

const newWhyDiv = why1.cloneNode(true);
newWhyDiv.id = `why${newId}`; // Update the ID
newWhyDiv.querySelector('label').textContent = `Why ${newId}`; // Update label

why1.parentNode.appendChild(newWhyDiv);
}); */