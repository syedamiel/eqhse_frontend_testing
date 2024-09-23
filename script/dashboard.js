// Assuming you have a div with the ID "user-info"
const userInfoDiv = document.getElementById('user-info');

if (typeof $_SESSION['user_id'] !== 'undefined') {
  userInfoDiv.textContent = "Logged in as: " + $_SESSION['user_id'];

  // Update the URL with the user ID
  const url = window.location.href;
  const newUrl = url.replace(/\/$/, '') + '/' + $_SESSION['user_id'];
  history.pushState({}, document.title, newUrl);
}