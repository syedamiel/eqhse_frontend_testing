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

const addButton = document.getElementById('add-button');
const deleteButtons = document.querySelectorAll('.delete-button');

addButton.addEventListener('click', () => {
const findings = document.querySelector('.form-design');
const newFindings = findings.cloneNode(true);
findings.parentNode.insertBefore(newFindings, findings.nextSibling);

// Clear the input value of the cloned findings
newFindings.querySelector('input').value = '';
});