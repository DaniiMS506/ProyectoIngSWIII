$(document).ready(function () {
    // Btn Contactenos
    $('#Contactenos').on('click', async function (e) {
        e.preventDefault();
        //alert('OK');
        Swal.fire({
            title: "Contáctenos",
            html: '<i class="fas fa-envelope"></i> Email: TecnoFarma@gmail.com<br><i class="fas fa-phone"></i> Teléfono: 123-456-7890',
            icon: "info"
        });
    });

    // Btn Login
    $('#btn_Login').on('click', async function (e) {
        e.preventDefault();

        const {
            value: formValues
        } = await Swal.fire({
            title: "Login",
            html: '<input id="swal-input1" class="swal2-input" placeholder="Email">' +
                '<input id="swal-input2" type="password" class="swal2-input" placeholder="Password">',
            focusConfirm: false,
            showCancelButton: true,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value
                ];
            }
        });

        if (formValues) {
            const [email, password] = formValues;

            try {
                const response = await fetch('PHP/ValidaLoginCliente.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        title: 'Login Exitoso!',
                        text: `Bienvenido ${result.data.Nombre} ${result.data.Apellido}`,
                        icon: 'success'
                    });

                    // Update the navbar with the user's name
                    $('#navbarDropdownLogin').html(`<i class="fas fa-user fa-fw"></i> ${result.data.Nombre} ${result.data.Apellido}`);

                    // Optionally, you might want to hide or disable the login and registration links
                    $('#btn_Login').hide();
                    $('#btn_Registrarse').hide();
                } else {
                    Swal.fire({
                        title: 'Login Failed!',
                        text: result.message,
                        icon: 'error'
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    title: 'Error!',
                    text: `Request failed: ${error}`,
                    icon: 'error'
                });
            }
        }
    });





    // Btn Registro btn_Registrarse
    $('#btn_Registrarse').on('click', async function (e) {
        e.preventDefault();

        const {
            value: formValues
        } = await Swal.fire({
            title: 'Registro',
            html: `
        <input id="swal-input1" class="swal2-input" placeholder="Nombre">
        <input id="swal-input2" class="swal2-input" placeholder="Apellido">
        <input id="swal-input3" class="swal2-input" placeholder="Email">
        <input id="swal-input4" type="password" class="swal2-input" placeholder="Contraseña">
        <input id="swal-input5" class="swal2-input" placeholder="Teléfono">
        <input id="swal-input6" class="swal2-input" placeholder="Dirección">
    `,
            focusConfirm: false,
            showCancelButton: true,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value,
                    document.getElementById('swal-input3').value,
                    document.getElementById('swal-input4').value,
                    document.getElementById('swal-input5').value,
                    document.getElementById('swal-input6').value
                ];
            }
        });

        if (formValues) {
            const [nombre, apellido, email, password, telefono, direccion] = formValues;

            try {
                const response = await fetch('PHP/Inserts/insertCliente.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nombre,
                        apellido,
                        email,
                        password,
                        telefono,
                        direccion
                    })
                });

                // Asegúrate de que la respuesta sea JSON
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        title: 'Registro Exitoso!',
                        text: result.message,
                        icon: 'success'
                    });
                } else {
                    Swal.fire({
                        title: 'Registro Fallido!',
                        text: result.message,
                        icon: 'error'
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    title: 'Error!',
                    text: `Request failed: ${error.message}`,
                    icon: 'error'
                });
            }
        }
    });


}); //END


/************************************ Typed JS/Text Animations ************************************/
const typed = new Typed('.multiple-text1', {
    strings: ['Kendal Daniel Muñoz Solano', 'Daniel Alonso Meneses Chavarria', 'Alejandro Jesus Solis Rojas'],
    typeSpeed: 90,
    backSpeed: 60,
    backDelay: 1000,
    loop: true
});