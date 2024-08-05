let cart = [];

// BTN Add to Card
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-id');
        const productName = this.closest('.card').querySelector('.fw-bolder').innerText;
        const productPrice = parseFloat(this.closest('.card').querySelector('#precio').innerText.replace('$', ''));
        const productDescription = this.closest('.card').querySelector('#descripcion').innerText;

        const existingProduct = cart.find(item => item.id === productId);

        if (existingProduct) {
            existingProduct.quantity++;
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                description: productDescription,
                quantity: 1
            });
        }

        updateCartBadge();

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Producto agregado al Carrito de Compras',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

document.querySelector('.btn-outline-dark').addEventListener('click', function (event) {
    event.preventDefault();
    showCartModal();
});

function updateCartBadge() {
    const cartBadge = document.querySelector('.badge');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartBadge.textContent = totalItems;
}



// Mostrar Modal del Carrito de Compras
function showCartModal() {
    const cartContainer = document.getElementById('cart-container'); // Modal Inputs
    const cartProducts = document.getElementById('cart-products'); // Modal Productos

    cartProducts.innerHTML = '';

    if (cart.length === 0) {
        cartProducts.innerHTML = '<p>No hay productos en el carrito.</p>';
    } else {
        cart.forEach(item => {
            const productElement = document.createElement('div');
            productElement.className = 'cart-item';
            productElement.innerHTML = `
                <h5>${item.name}</h5>
                <p>${item.description}</p>
                <p>Precio: $${item.price.toFixed(2)}</p>
                <p>Cantidad: 
                    <button class="btn btn-sm btn-primary decrease-quantity" data-id="${item.id}"> - </button>
                    <span>${item.quantity}</span>
                    <button class="btn btn-sm btn-primary increase-quantity" data-id="${item.id}"> + </button>

                </p>
                <button class="btn btn-sm btn-danger remove-item" data-id="${item.id}">Eliminar</button>
                <hr>
            `;
            cartProducts.appendChild(productElement);
        });


        // AUMENTAR CANTIDAD
        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                const product = cart.find(item => item.id === productId);
                product.quantity++;
                showCartModal();
                updateCartBadge();
            });
        });


        // RESTAR CANTIDAD
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                const product = cart.find(item => item.id === productId);
                if (product.quantity > 1) {
                    product.quantity--;
                } else {
                    cart = cart.filter(item => item.id !== productId);
                }
                showCartModal();
                updateCartBadge();
            });
        });


        // ELIMINAR DEL CARRITO
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                cart = cart.filter(item => item.id !== productId);
                showCartModal();
                updateCartBadge();
            });
        });
    }

    Swal.fire({
        title: 'Carrito de Compras',
        html: cartContainer.innerHTML,
        showCancelButton: true,
        cancelButtonText: 'Cerrar',
        showConfirmButton: false
    });
}


document.addEventListener('click', function (event) {
    if (event.target && event.target.id === 'checkout-button') {
        Swal.fire({
            title: 'Procesando compra...',
            text: 'Espere un momento por favor...',
            didOpen: async () => {
                Swal.showLoading();
                const success = await checkoutCart();
                Swal.close();
                if (success) {
                    Swal.fire('Compra realizada', 'Su compra ha sido realizada con éxito', 'success');
                } else {
                    Swal.fire('Error', 'Hubo un problema al procesar su compra.', 'error');
                }
            }
        });
    }
});


// Insert Pedido y Detalle Pedido
async function checkoutCart() {
    try {
        const response = await fetch('../PHP/Inserts/insertOrdenCarrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cart)
        });
        const result = await response.json();
        if (result.success) {
            cart = [];
            updateCartBadge();
            return true;
        } else {
            console.error(result.message);
            return false;
        }
    } catch (error) {
        console.error(error);
        return false;
    }
}
