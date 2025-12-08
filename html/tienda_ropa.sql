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
('Pantalones vaqueros vintage desgastados','pantalones holgados de cintura alta y pierna ancha.', 'M,G', 'Negro', 750.00, 12, 4, '../img/pantalon2.png', '../img/pantalon1.png'),
('Top Corset de Tirantes vino', 'Top corset de tirantes con moños y varillas. Colección de alta calidad y originalidad.', 'CH', 'Vino', 229.00, 20, 5, '../img/topestilocorset_rojo.webp', '../img/topestilocorset_rojo2.webp' ),
('Vestido de Manga Larga con Holanes Café', 'Vestido corto de manga larga, con holanes en la parte baja. El vestido perfecto para tus salidas y eventos.', 'CH,M,G', 'Café', 356.75, 23, 3, '../img/vestidomangalarga_holanescafé1.webp',  '../img/vestidomangalarga_holanescafé2.webp'),
('Falda tableada Gris Perla', 'Falda corta gris perla, con tablas y jareta ajustable con elástico en la cintura. Eleva tu outfit con faldas que nunca pasan de moda.', 'CH,M,G,L', 'Gris Perla', 195.30, 35, 3, '../img/Faldatableada_grisperla1.webp', '../img/Faldatableada_grisperla2.webp'),
('Falda a Cuadros Café', 'Chamarra café pesada bomber, con bordado, bolsas y botonadura frontal. Descubre la chamarra ideal para cada momento.', 'CH,M,G', 'Café', 139.50, 28, 3, '../img/faldaacuadros_café1.webp', '../img/faldaacuadros_café2.webp'),
('Chamarra Bomber Bordada Café', 'Chamarra café pesada bomber, con bordado, bolsas y botonadura frontal. Descubre la chamarra ideal para cada momento.', 'CH,M,G,L', 'Café', 539.10, 15, 8, '../img/Chamarrabomber_bordadacafé1.webp', '../img/Chamarrabomber_bordadacafé2.webp'),
('Chamarra Biker con Borrega Beige', 'Chamarra biker para mujer, con sherpa suave en puños, cuello e interior, bolsas al frente y cierre en diagonal frontal. El complemento ideal para esta temporada.', 'CH,M,G,L,EG', 'Beige', 759.00, 18, 8, '../img/Chamarrabikercon_borregabeige1.webp', '../img/Chamarrabikercon_borregabeige2.webp'),
('Chamarra con flecos negra', 'Chamarra pu negra para mujer, con flecos y solapa. Dale un toque diferente a tu outfit con esta prenda única.', 'CH,M,G,L', 'Negra', 799.00, 25, 8, '../img/Chamarraconflecos_negra1.webp', '../img/Chamarraconflecos_negra2.webp'),
('Chamarra Suede Vino', 'Chamarra suede vino para mujer, con detalles de polipiel.', 'CH,M,G', 'Vino', 599.00, 30, 8, '../img/Chamarrasuede_vino1.webp', '../img/Chamarrasuede_vino2.webp'),
('Pantalones cortos de cadena Kanji (gótico Y2K)', 'El gótico Y2K Kanji Chain Shorts une a lo distópico Y2K-Estética con elementos de streetwear gótico en una pieza única.', 'CH,M,G,EG', 'Gris', 1123.32, 37, 4, '../img/Goticoy2k_pantalonescortos_cadenaKanji1.webp', '../img/Goticoy2k_pantalonescortos_cadenaKanji2.jpg')
--Para asignar talla a una prenda de ropa con su id de esa ropa
INSERT INTO producto_tallas (id_producto, talla) VALUES
(5, 'CH'),
(5, 'M'),
(5, 'G'),
(5, 'EG'),
(5, 'Extra G'),
(5, 'Única');

--Para asignar color a una prenda de ropa con su id de esa ropa
INSERT INTO producto_colores (id_producto, color) VALUES
(5, 'Negro'),
(5, 'Rosa pastel'),
(5, 'Verde olivo'),
(5, 'Multicolor'),
(5, 'Azul marino');

--Para revisar si los cambios si fueron realizados
SELECT * FROM producto_tallas WHERE id_producto = 5;
SELECT * FROM producto_colores WHERE id_producto = 5;
