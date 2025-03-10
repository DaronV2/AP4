const elements = {
    minusButton: document.getElementById('minusButton'),
    plusButton: document.getElementById('plusButton'),
    quantityInput: document.getElementById('inputCart'),
    cart: document.getElementById('addToCart'),
    idProduct: document.getElementById('idProduct')
};



elements.minusButton.addEventListener("click", () => {
    if (elements.quantityInput.value > 1) {
        elements.quantityInput.value--;
    }
});

elements.plusButton.addEventListener("click", () => {
    if (elements.quantityInput.value < 99) {
        elements.quantityInput.value++;
    }
});

elements.cart.addEventListener("click", async () => {
    await fetch("/ajax/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify({ quantity: elements.quantityInput.value, idProduct: elements.idProduct.value ? elements.idProduct.value : "" })
    }).then(response => response.json())
})