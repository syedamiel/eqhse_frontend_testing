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

/* const addButton = document.getElementById('add-button');

let correctionCount = 1; // Keep track of the correction count

addButton.addEventListener('click', () => {
correctionCount++; // Increment correction count

const formDesign = document.querySelector('.form-design');
const newFormDesign = formDesign.cloneNode(true); // Clone the entire form-design div

// Update the label of the new correction
const newLabel = newFormDesign.querySelector('label[for="issue-date"]');
newLabel.textContent = `Corrective Action ${correctionCount}`;

// Clear the values of the input fields in the cloned div
const inputs = newFormDesign.querySelectorAll('input, textarea');
inputs.forEach(input => input.value = '');

// Find the last correction section
const lastCorrection = document.querySelector(`.form-design:nth-of-type(${correctionCount - 1})`);

// Insert the new correction div right after the last one
lastCorrection.after(newFormDesign);
}); */