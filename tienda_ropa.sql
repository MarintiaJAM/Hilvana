CREATE DATABASE tienda_ropa;

USE tienda_ropa;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2),
    imagen_principal VARCHAR(255),
    imagen_secundaria VARCHAR(255),
    categoria VARCHAR(100)
);
CREATE TABLE categorias (
    id_categoria INT PRIMARY KEY,
    nombre_categoria VARCHAR(100)
);

INSERT INTO productos (nombre_producto, descripcion, talla, color, precio, stock, categoria_id, imagen_principal, imagen_secundaria)
VALUES
('Conjunto de Ropa Estilo Vkei Azul y Negro', 'Conjunto elegante estilo Vkei azul y negro con shorts y sobrecapa.', 'M', 'Azul y negro', 4000.00, 10, 2, 'img/Black and Dark Blue Ouji Shorts with Overlay.jpg', 'img/c78ffdd6-c961-4909-a889-85566237c00e.jpg'),
('Camisa Cross Ribbon Sailor Lace Collar V1 y V2', 'Camisa estilo sailor con encaje y cinta cruzada.', 'S', 'Blanco', 350.00, 15, 5, 'img/Cross Ribbon Sailor Lace Collar Blouse_ Dear My Love.jpg', 'img/dd667753-bc0c-48e5-858b-a4674f988da4.jpg'),
('Capa Azul Estilo Vkei V1 y V2', 'Capa azul con detalles Vkei, ideal para conjuntos alternativos.', 'L', 'Azul', 700.00, 8, 8, 'img/8d6d4e4e-fef1-45b6-9a9f-4b89672b9bea.jpg', 'img/a8fdb29f-06f2-45e3-ac2a-4c281dd735de.jpg'),
('Cuello de Holanes Rosa Blanca, Moño Negro', 'Accesorio de cuello con holanes blancos y moño negro.', 'Única', 'Rosa y blanco', 150.00, 20, 9, 'img/c83d08db-3986-427c-9050-afb4ad899304.jpg', 'img/descarga (5).jpg'),

