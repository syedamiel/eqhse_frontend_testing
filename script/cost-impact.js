function formatNumber(input) {
  // Format the value with two decimal places
  input.value = parseFloat(input.value).toFixed(2);
}


const form = document.getElementById('pre-existing-form');
const totalDisplay = document.getElementById('total-display'); // Select the element after "Total" label

// Function to calculate and update the total
function updateTotal() {
  let total = 0;
  const inputs = form.querySelectorAll('input[type="number"]'); // Select all number inputs

  // Loop through each input and add its value to the total
  inputs.forEach(input => {
    total += parseFloat(input.value) || 0; // Handle empty inputs (convert to 0)
  });

  // Update the display text with the calculated total
  totalDisplay.textContent = total;
}

// Update total initially
updateTotal();

// Add event listeners to all number inputs for real-time updates
form.querySelectorAll('input[type="number"]').forEach(input => {
  input.addEventListener('input', updateTotal); // Update on input change
});