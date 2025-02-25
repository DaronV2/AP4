const elements = {
    minusButton : document.getElementById('minusButton'),
    plusButton : document.getElementById('plusButton'),
    quantityInput : document.getElementById('inputCart'),
};

elements.minusButton.addEventListener("click", () => {
    if (elements.quantityInput.value > 1) {
        elements.quantityInput.value--;
    }
});

elements.plusButton.addEventListener("click", () => {
    if(elements.quantityInput.value < 99) {
        elements.quantityInput.value++;
    }
});