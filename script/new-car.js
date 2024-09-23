/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("subnavbtn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}


/* document.getElementById('edit-btn').addEventListener('click', function() {
  const inputs = document.querySelectorAll('#pre-existing-form input');
  inputs.forEach(input => {
      if (input.readOnly) {
          input.readOnly = false;
          input.style.borderColor = '#e74c3c';
      } else {
          input.readOnly = true;
          input.style.borderColor = '#bdc3c7';
      }
  });
});

function changeLabel() 
{
    const button = document.getElementById("edit-btn");
    if (button.innerText == "Done") {
      button.innerText = "Edit";
    }
    else {
      button.innerText = "Done";
    }
} */
