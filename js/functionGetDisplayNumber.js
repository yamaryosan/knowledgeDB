function getCurrentPageDisplayNumber() {
  const displayNumberForm = document.querySelector("#display_number");
  const displayNumber = displayNumberForm.value;
  return displayNumber;
}

export default getCurrentPageDisplayNumber;
