// Every time you click the button, getRndInteger(min, max) returns a random number between min and max (both included):
function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min + 1) ) + min;
}