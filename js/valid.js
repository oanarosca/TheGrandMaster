// valideaza numele de utilizator
function username (str) {
  if (str.length < 4 || str.length > 20)
    return 0;
  return 1;
}

// valideaza parola
function password (str) {
  if (str.length < 6 || str.length > 20)
    return 0;
  return 1;
}
