function showSelectedInput() {
  const productTypeSelect = document.querySelector(
    "select[name='productType']"
  );
  const inputHideElements = document.querySelectorAll(".inputHide");

  inputHideElements.forEach((el) => {
    el.style.display = "none";
    const inputs = el.querySelectorAll("input");
    inputs.forEach((input) => (input.required = false));
  });

  const selectedInputHide = document.querySelector(
    `#${productTypeSelect.value}`
  );
  if (selectedInputHide) {
    selectedInputHide.style.display = "block";
    const input = selectedInputHide.querySelector("input");
    if (input) {
      input.required = true;
    }
  }
}

// Listening for changes to the productTypeSelect element
const productTypeSelect = document.querySelector("select[name='productType']");
productTypeSelect.addEventListener("change", handleProductTypeChange);
