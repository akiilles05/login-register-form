function validateForm() {
  const username = document.getElementById("username").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const password2 = document.getElementById("confirm_password").value;

  document.getElementById("name-error").innerHTML = "";
  document.getElementById("email-error").innerHTML = "";
  document.getElementById("password-error").innerHTML = "";
  document.getElementById("password2-error").innerHTML = "";

  let isValid = true;

  if (username === "") {
    document.getElementById("name-error").innerHTML =
      "*Felhasználónév nem maradhat üresen ";
    isValid = false;
  }

  if (email === "") {
    document.getElementById("email-error").innerHTML =
      "*Email cím nem maradhat üresen ";
    isValid = false;
  }

  if (password === "") {
    document.getElementById("password-error").innerHTML =
      "*Jelszó nem maradhat üresen";
    isValid = false;
  }

  if (password !== password2) {
    document.getElementById("password2-error").innerHTML =
      "Nem egyezik meg a két jelszó";
    isValid = false;
  }

  return isValid;
}
