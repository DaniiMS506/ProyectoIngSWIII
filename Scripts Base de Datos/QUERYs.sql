/* Crear la base de datos FarmaciaProyecto si no existe */
CREATE DATABASE IF NOT EXISTS FarmaciaProyecto;
USE FarmaciaProyecto;


/* Tabla Roles */
CREATE TABLE Rol (
    Id_rol INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Nombre_rol VARCHAR(10) NOT NULL,
    Descripcion VARCHAR(30)
);

/* Tabla Usuarios */
CREATE TABLE Usuario (
    Id_usuario INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Nombre VARCHAR(10) NOT NULL,
    Apellido VARCHAR(25) NOT NULL,
    Email VARCHAR(25),
    Password VARCHAR(25) NOT NULL,
    Id_rol INT,
    CONSTRAINT FK_Usuarios_Roles FOREIGN KEY (Id_rol) REFERENCES Rol(Id_rol)
);

/* Tabla Clientes */
CREATE TABLE Cliente (
    Id_cliente INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Nombre VARCHAR(10) NOT NULL,
    Apellido VARCHAR(25) NOT NULL,
    Email VARCHAR(25),
    Telefono INT NOT NULL,
    Direccion VARCHAR(25) NOT NULL
);

/* Tabla Categoria */
CREATE TABLE Categoria (
    Id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_categoria VARCHAR(15) NOT NULL,
    Descripcion VARCHAR(30)
);

/* Tabla Productos */
CREATE TABLE Producto (
    Id_producto INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_producto VARCHAR(15) NOT NULL,
    Descripcion VARCHAR(30),
    Precio DECIMAL(10, 2) NOT NULL,
    Fecha_expiracion DATE,
    Id_categoria INT,
    CONSTRAINT FK_Producto_Categoria FOREIGN KEY (Id_categoria) REFERENCES Categoria(Id_categoria)
);

/* Tabla Pedidos */
CREATE TABLE Pedido (
    Id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    Id_cliente INT,
    Fecha_pedido DATETIME NOT NULL,
    Estado VARCHAR(20) NOT NULL, /* 'pendiente', 'procesado', 'enviado', 'entregado', 'cancelado' */
    Total DECIMAL(10, 2) NOT NULL,
    CONSTRAINT FK_Pedidos_Cliente FOREIGN KEY (Id_cliente) REFERENCES Cliente(Id_cliente)
);

/* Tabla Detalle Pedido */
CREATE TABLE Detalle_Pedido (
    Id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    Id_pedido INT,
    Id_producto INT,
    Cantidad INT NOT NULL,
    Tipo_envio VARCHAR(15) NOT NULL,
    Precio_unitario DECIMAL(10, 2) NOT NULL,
    CONSTRAINT FK_Detalle_Pedido_Pedido FOREIGN KEY (Id_pedido) REFERENCES Pedido(Id_pedido),
    CONSTRAINT FK_Detalle_Pedido_Producto FOREIGN KEY (Id_producto) REFERENCES Producto(Id_producto)
);

/* Tabla Proveedores */
CREATE TABLE Proveedor (
    Id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(15) NOT NULL,
    Direccion VARCHAR(50),
    Telefono INT,
    Email VARCHAR(25)
);

/* Tabla Inventario */
CREATE TABLE Inventario (
    Id_inventario INT AUTO_INCREMENT PRIMARY KEY,
    Id_producto INT,
    Cantidad INT NOT NULL,
    CONSTRAINT FK_Inventario_Producto FOREIGN KEY (Id_producto) REFERENCES Producto(Id_producto)
);
