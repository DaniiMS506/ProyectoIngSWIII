// Carrito de Compras JS

let cart = [];

// BTN Add to Cart
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
    const cartProducts = document.getElementById('cart-products'); // Modal Productos

    cartProducts.innerHTML = '';

    if (cart.length === 0) {
        cartProducts.innerHTML = '<p>No hay productos en el carrito.</p>';
    } else {
        let totalPrice = 0;

        cart.forEach(item => {
            const itemPrice = item.price * item.quantity;
            totalPrice += itemPrice;

            const productElement = document.createElement('div');
            productElement.className = 'cart-item';
            productElement.innerHTML = `
                <h5>${item.name}</h5>
                <p>${item.description}</p>
                <p>Precio: $${item.price.toFixed(2)}</p>
                <p>Cantidad: <br>
                    <button class="btn btn-sm btn-primary decrease-quantity" data-id="${item.id}"> - </button>
                    <span>${item.quantity}</span>
                    <button class="btn btn-sm btn-primary increase-quantity" data-id="${item.id}"> + </button>
                </p>
                <p>Subtotal: $${itemPrice.toFixed(2)}</p>
                <button class="btn btn-sm btn-danger remove-item" data-id="${item.id}">Eliminar</button>
                <hr>
            `;
            cartProducts.appendChild(productElement);
        });

        const totalElement = document.createElement('div');
        totalElement.innerHTML = `<h4>Total: $${totalPrice.toFixed(2)}</h4>`;
        cartProducts.appendChild(totalElement);

        // Asegúrate de que los botones sean accesibles en el momento de asignar los eventos
        setTimeout(assignCartModalEvents, 100); // Retrasar la asignación de eventos para asegurar que el DOM esté actualizado
    }

    Swal.fire({
        title: 'Carrito de Compras',
        html: document.getElementById('cart-container').innerHTML,
        showCancelButton: true,
        cancelButtonText: 'Cerrar',
        showConfirmButton: false
    });
}

// Asignar eventos de los botones dentro del modal
function assignCartModalEvents() {
    // AUMENTAR CANTIDAD
    document.querySelectorAll('.increase-quantity').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            const product = cart.find(item => item.id === productId);
            if (product) {
                product.quantity++;
                updateCartBadge();
                showCartModal(); // Actualizar el modal
            }
        });
    });

    // RESTAR CANTIDAD
    document.querySelectorAll('.decrease-quantity').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            const product = cart.find(item => item.id === productId);
            if (product) {
                if (product.quantity > 1) {
                    product.quantity--;
                } else {
                    cart = cart.filter(item => item.id !== productId);
                }
                updateCartBadge();
                showCartModal(); // Actualizar el modal
            }
        });
    });

    // ELIMINAR DEL CARRITO
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            cart = cart.filter(item => item.id !== productId);
            updateCartBadge();
            showCartModal(); // Actualizar el modal
        });
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
        console.log("Enviando datos al servidor:", JSON.stringify({ cart }));

        const response = await fetch('/ProyectoIngSWIII/Proyecto/PHP/Inserts/insertOrdenCarrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cart }) // Enviar cart envuelto en un objeto
        });

        const contentType = response.headers.get('Content-Type');
        if (contentType && contentType.includes('application/json')) {
            const result = await response.json();
            if (result.success) {
                cart = [];
                updateCartBadge();
                return true;
            } else {
                console.error(result.message);
                return false;
            }
        } else {
            const text = await response.text();
            console.error('Respuesta del servidor no es JSON:', text);
            return false;
        }

    } catch (error) {
        console.error('Error al procesar la solicitud:', error);
        return false;
    }
}
