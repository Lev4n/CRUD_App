
// Getting references to the select element and all inputHide elements
const productTypeSelect = document.querySelector("select[name='productType']");
const inputHideElements = document.querySelectorAll(".inputHide");

// Listening for changes to the productTypeSelect element
productTypeSelect.addEventListener("change", () => {
    // Hiding all inputHide elements by default
    inputHideElements.forEach((el) => {
        el.style.display = "none";
        // Making all input fields optional
        const inputs = el.querySelectorAll("input");
        inputs.forEach((input) => (input.required = false));
    });

    // Showing the selected inputHide element
    const selectedInputHide = document.querySelector(`#${productTypeSelect.value}`);
    if (selectedInputHide) {
        selectedInputHide.style.display = "block";
        // Making the input field in the selected inputHide element required
        const input = selectedInputHide.querySelector("input");
        if (input) {
            input.required = true;
        }
    }
});



