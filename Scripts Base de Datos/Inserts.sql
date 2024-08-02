-- Inserts para la tabla Rol
INSERT INTO Rol
    (Nombre_rol, Descripcion)
VALUES
    ('Admin', 'Administrador del sistema'),
    ('Manager', 'Gerente de operaciones'),
    ('User', 'Usuario estándar');

-- Inserts para la tabla Usuario
INSERT INTO Usuario
    (Nombre, Apellido, Email, Password, Id_rol)
VALUES
    ('Juan', 'Perez', 'juan@example.com', 'password123', 1),
    ('Maria', 'Gomez', 'maria@example.com', 'securepass', 2),
    ('Pedro', 'Rodriguez', 'pedro@example.com', '12345678', 3),
    ('Ana', 'Martinez', 'ana@example.com', 'anapass', 1),
    ('Luis', 'Sanchez', 'luis@example.com', 'password', 2);


-- Inserts para la tabla Cliente
INSERT INTO Cliente
    (Nombre, Apellido, Email, Pass, Telefono, Direccion)
VALUES
    ('Carlos', 'Gonzalez', 'carlos@gmail.com', 123, 123456789, 'Calle Principal 123'),
    ('Sofia', 'Lopez', 'sofia@gmail.com', 123, 987654321, 'Avenida Central 456'),
    ('Javier', 'Hernandez', 'javier@gmail.com', 123, 567890123, 'Paseo de las Flores 789'),
    ('Laura', 'Diaz', 'laura@gmail.com', 123, 345678901, 'Boulevard Norte 234'),
    ('Diego', 'Rojas', 'diego@gmail.com', 123, 789012345, 'Plaza Mayor 567');

-- Inserts para la tabla Categoria
INSERT INTO Categoria
    (Nombre_categoria, Descripcion)
VALUES
    ('Medicamentos', 'Productos relacionados con la salud'),
    ('Higiene', 'Productos de limpieza y cuidado personal'),
    ('Cremas', 'Cremas'),
    ('Sueros', 'Sueros'),
    ('Ropa', 'Prendas Medicas');

-- Inserts para la tabla Producto
INSERT INTO Producto
    (Nombre_producto, Descripcion, Precio, Fecha_expiracion, Id_categoria)
VALUES
    ('Paracetamol', 'Analgesico y antipiretico', 5.99, '2025-06-30', 1),
    ('Shampoo', 'Para cabello seco', 8.50, '2024-12-31', 2),
    ('Inyección', 'Planificación', 3.25, '2024-10-15', 3),
    ('Electrolit', 'Electrolit Uva', 299.99, '2024-10-15', 4),
    ('Mascarilla', 'Mascarilla KN95', 12.99, '2024-10-15', 5);

-- Inserts para la tabla Pedido
INSERT INTO Pedido
    (Id_cliente, Fecha_pedido, Estado, Total)
VALUES
    (1, '2024-07-16 10:30:00', 'pendiente', 25.50),
    (2, '2024-07-16 11:45:00', 'procesado', 45.75),
    (3, '2024-07-16 13:15:00', 'enviado', 30.00),
    (4, '2024-07-16 14:30:00', 'entregado', 15.25),
    (5, '2024-07-16 15:45:00', 'cancelado', 10.50);

-- Inserts para la tabla Detalle de Pedido
    INSERT INTO Detalle_Pedido (Id_pedido, Id_producto, Cantidad, Tipo_envio, Precio_unitario)
VALUES
    (1, 1, 2, 'estándar', 5.99),   
    (1, 2, 1, 'express', 8.50),    
    (2, 3, 5, 'estándar', 3.25),   
    (2, 4, 1, 'express', 299.99),  
    (3, 2, 3, 'express', 8.50),    
    (4, 5, 2, 'estándar', 12.99),  
    (5, 1, 1, 'estándar', 5.99);   

-- Inserts para la tabla Proveedor
INSERT INTO Proveedor
    (Nombre, Direccion, Telefono, Email)
VALUES
    ('Distribuidora A', 'Avenida Libertad 123', 123456789, 'contacto@distribuidoraA.com'),
    ('Mayorista B', 'Calle Comercial 456', 987654321, 'info@mayoristab.com'),
    ('Suministros C', 'Boulevard Industrial 789', 567890123, 'ventas@suministrosc.com'),
    ('Importadora D', 'Avenida Principal 234', 345678901, 'compras@importadorad.com'),
    ('Exportadora E', 'Calle Mayor 567', 789012345, 'export@exportadorae.com');

-- Inserts para la tabla Inventario
INSERT INTO Inventario
    (Id_producto, Cantidad)
VALUES
    (1, 100),
    (2, 50),
    (3, 200),
    (4, 10),
    (5, 75);

-- Inserts para la tabla Imagen
INSERT INTO Imagen
    (Id_producto, Imagen)
VALUES
    (4, LOAD_FILE('C:/xampp/htdocs/ProyectoIngSWIII/Proyecto/IMG/Productos/Electrolit.webp')),
    (3, LOAD_FILE('C:/xampp/htdocs/ProyectoIngSWIII/Proyecto/IMG/Productos/Inyeccion.jpg')),
    (5, LOAD_FILE('C:/xampp/htdocs/ProyectoIngSWIII/Proyecto/IMG/Productos/Mascarilla.avif')),
    (1, LOAD_FILE('C:/xampp/htdocs/ProyectoIngSWIII/Proyecto/IMG/Productos/Paracetamol.avif')),
    (2, LOAD_FILE('C:/xampp/htdocs/ProyectoIngSWIII/Proyecto/IMG/Productos/Shampoo.jpg'));