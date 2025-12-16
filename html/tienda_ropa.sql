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
('Cuello de Holanes Rosa Blanca, Moño Negro', 'Accesorio de cuello con holanes blancos y moño negro.', 'Única', 'Rosa y blanco', 150.00, 20, 11, 'img/c83d08db-3986-427c-9050-afb4ad899304.jpg', 'img/descarga (5).jpg'),
('Pantalones vaqueros vintage desgastados','pantalones holgados de cintura alta y pierna ancha.', 'M,G', 'Negro', 750.00, 12, 4, '../img/pantalon2.png', '../img/pantalon1.png'),
('Top Corset de Tirantes vino', 'Top corset de tirantes con moños y varillas. Colección de alta calidad y originalidad.', 'CH', 'Vino', 229.00, 20, 5, '../img/topestilocorset_rojo.webp', '../img/topestilocorset_rojo2.webp' ),
('Vestido de Manga Larga con Holanes Café', 'Vestido corto de manga larga, con holanes en la parte baja. El vestido perfecto para tus salidas y eventos.', 'CH,M,G', 'Café', 356.75, 23, 3, '../img/vestidomangalarga_holanescafé1.webp',  '../img/vestidomangalarga_holanescafé2.webp'),
('Falda tableada Gris Perla', 'Falda corta gris perla, con tablas y jareta ajustable con elástico en la cintura. Eleva tu outfit con faldas que nunca pasan de moda.', 'CH,M,G,L', 'Gris Perla', 195.30, 35, 9, '../img/Faldatableada_grisperla1.webp', '../img/Faldatableada_grisperla2.webp'),
('Falda a Cuadros Café', 'Chamarra café pesada bomber, con bordado, bolsas y botonadura frontal. Descubre la chamarra ideal para cada momento.', 'CH,M,G', 'Café', 139.50, 28, 9, '../img/faldaacuadros_café1.webp', '../img/faldaacuadros_café2.webp'),
('Chamarra Bomber Bordada Café', 'Chamarra café pesada bomber, con bordado, bolsas y botonadura frontal. Descubre la chamarra ideal para cada momento.', 'CH,M,G,L', 'Café', 539.10, 15, 8, '../img/Chamarrabomber_bordadacafé1.webp', '../img/Chamarrabomber_bordadacafé2.webp'),
('Chamarra Biker con Borrega Beige', 'Chamarra biker para mujer, con sherpa suave en puños, cuello e interior, bolsas al frente y cierre en diagonal frontal. El complemento ideal para esta temporada.', 'CH,M,G,L,EG', 'Beige', 759.00, 18, 8, '../img/Chamarrabikercon_borregabeige1.webp', '../img/Chamarrabikercon_borregabeige2.webp'),
('Chamarra con flecos negra', 'Chamarra pu negra para mujer, con flecos y solapa. Dale un toque diferente a tu outfit con esta prenda única.', 'CH,M,G,L', 'Negra', 799.00, 25, 8, '../img/Chamarraconflecos_negra1.webp', '../img/Chamarraconflecos_negra2.webp'),
('Chamarra Suede Vino', 'Chamarra suede vino para mujer, con detalles de polipiel.', 'CH,M,G', 'Vino', 599.00, 30, 8, '../img/Chamarrasuede_vino1.webp', '../img/Chamarrasuede_vino2.webp'),
('Pantalones cortos de cadena Kanji (gótico Y2K)', 'El gótico Y2K Kanji Chain Shorts une a lo distópico Y2K-Estética con elementos de streetwear gótico en una pieza única.', 'CH,M,G,EG', 'Gris', 1123.32, 37, 4, '../img/Goticoy2k_pantalonescortos_cadenaKanji1.webp', '../img/Goticoy2k_pantalonescortos_cadenaKanji2.jpg'),
('Y2K Pantalones de columna de dragón', 'El Y2K Los pantalones de columna de dragón encarnan la estética rebelde de la década de 2000 a través de su espectacular diseño de dragón y columna y la inmensidad característica.', 'CH,M,G', 'Negro', 1987.37, 27, 4, '../img/Y2KPantalonesde_columnadedragón1.webp', '../img/Y2KPantalonesde_columnadedragón2.webp'),
('Opium Anillo de metal largo', 'El Opium El anillo de metal longitude revoluciona el diseño minimalista a través de su característico detalle del anillo de metal y las costuras decorativas precisas.', 'CH,M','Negro', 1123.25, 12, 5, '../img/Opiumanillo_metallargo_negra1.webp', '../img/Opiumanillo_metallargo_negra2.webp'),
('Opium Chaleco de rebelión corporativa', 'Interpretación de vanguardia de la camisa de negocios tradicional con sus paneles interiores de rayas características y el corte de gran tamaño', 'CH, M, G, EG', 'Blanco', 1485.91, 38, 5, '../img/OpiumChaleco_rebelioncorporativa_blanco1.webp', '../img/OpiumChaleco_rebelioncorporativa_blanco2.webp'),
('Sudadera Táctica Con Capucha Warcore Distressed', 'La Sudadera Táctica con Capucha Warcore Distressed encarna la rebeldía urbana y la estética militar en perfecta armonía.', 'ECH, M, G,', 'Café', 1350.45, 23, 7, '../img/SudaderaTáctica_CapuchaWarcore_Distressed1.webp', '../img/SudaderaTáctica_CapuchaWarcore_Distressed2.webp'),
('Retro Star Patch Embroidered Denim Wide Leg Pants', 'Estos pantalones son perfectos para quienes quieren expresar su individualidad y abrazar el espíritu vibrante de Harajuku.', 'CH, M, G, EG', 'Azul', 952.40, 29, 4, '../img/RetroStar_DenimWideLegPants1.webp', '../img/RetroStar_DenimWideLegPants2.webp'), 
('Chamarra Bomber College Verde', 'Chamarra verde bomber, estilo college, con mangas blancas. Dale poder a tu outfit con chamarras perfectas para los días fríos o las noches llenas de estilo. ', 'CH, M, G', 'Verde', 503.20, 14, 8, '../img/ChamarraBomber_collegeverde1.webp', '../img/ChamarraBomber_collegeverde2.webp'),
('Set de Arracadas Doradas y Plata', 'Set arracadas doradas y plata.', 'Única', 'Dorado y plata', 63.92, 65, 11, '../img/SetArracadas_doradasyplata1.webp', '../img/SetArracadas_doradasyplata2.webp'),
('Vestido Corto Polo Azul Marino', 'Vestido corto azul marino para hombre, sin mangas, cuello polo y contrastes en blanco.', 'ECH, CH, M, G', 'Azul', 213.85, 37, 3, '../img/Vestidocorto_azulmarino1.webp', '../img/Vestidocorto_azulmarino2.webp'),
('Camisa de Algodón Negra', 'Camisa para hombre, de manga corta con botones al frente, diseñada para ofrecer frescura y estilo en cualquier ocasión.', 'ECH, CH, M, G', 'Negro', 255.20, 56, 5, '../img/Camisaalgodón_negro1.webp', '../img/Camisaalgodón_negro2.webp'),
('Polo Estampada Número 90 Negra', 'Playera para hombre, negra polo de manga corta, boxy, con estampado en pecho número 90 y diseño moderno y cómodo que aporta estilo urbano y frescura.', 'M,G,EG', 'Negro', 174.30, 34, 5, '../img/Poloestampada_90negro1.webp', '../img/Poloestampada_90negro2.webp'),
('Camisa Tejida Pesada Gris', 'Camisa tejida para hombre, de manga corta, con botones al frente, diseñada para ofrecer estilo en cualquier ocasión.', 'CH,M,G,EG', 'Gris', 279.20, 15, 5, '../img/Camisatejida_pesadgris1.webp', '../img/Camisatejida_pesadgris2.webp'),
('Jeans Rectos Azul Índigo', 'Jeans con fit recto azul índigo con desgastes lígeros.', 'M,G,EG', 'Azul', 287.20, 43, 4, '../img/Jeansrectos_azulmarino1.webp', '../img/Jeansrectos_azulmarino1.webp'),
('Jogger Cargo de Nylon Café', 'Jogger café de nylon para hombre con bolsillos cargo', 'CH,M,G,EG', 'Café', 265.30, 50, 4, '../img/Joggercargo_nyloncafé1.webp', '../img/Joggercargo_nyloncafé2.webp'),
('Falda Tableada a Cuadros Negra', 'Falda corta tableada, a cuadros negro con blanco. Nueva colección diseñada para destacar en fiestas y reuniones.', 'ECH,CH,M,G', 'Negro', 244.30, 35, 9, '../img/FaldaTableada_cuadrosnegro1.webp', '../img/FaldaTableada_cuadrosnegro2.webp'),
('Falda Mini de PU Negra', 'Mini falda de PU, con bolsas cargo y cinturón. Nueva colección diseñada para destacar en fiestas y reuniones.', 'CH,M', 'Negro', 258.30, 43, 9, '../img/Faldamini_PUnegro1.webp', '../img/Faldamini_PUnegro2.webp'),
('Top Estampado Negro', 'Top negro sin mangas, con alas de angel estampadas al frente. Descubre los tops que marcan tendencia esta temporada.', 'M,G,EG', 'Negro', 143.20, 56, 12, '../img/Topestampado_negro1.webp', '../img/Topestampado_negro2.webp'),
('Jeans Baggy Bleach Azul', 'Jeans baggy azul claro con efecto bleach.', 'CH,M,G', 'Azul', 279.20, 23, 4, '../img/JeansBaggy_beachazul1.webp', '../img/JeansBaggy_beachazul2.webp'),
('Top Tejido sin Mangas Blanco', 'Top tejido blanco con cuello redondo y ruedo en semicircular.', 'ECH,CH,M,G', 'Blanco', 139.30, 49, 12, '../img/Toptejido_sinmangasblanco1.webp', '../img/Toptejido_sinmangasblanco2.webp'),
('Bermuda a Rayas Negra', 'Bermuda a rayas diplomáticas para hombre, moderno y perfecto para días relajados.', 'M,G', 'Negro', 209.30, 36, 10, '../img/Bermudarayas_negro1.webp', '../img/Bermudarayas_negro2.webp'),
('Playera Harry Potter Slytherin Negra', 'Playera negra para mujer, de manga corta y cuello redondo, con franjas en contraste blanco, licencia Warner Harry Potter Slytherin. En esta temporada, regala las licencias más creativas.', 'CH,M,G', 'Negro', 139.30, 29, 6, '../img/PlayeraHarryPotterS_negro1.webp', '../img/PlayeraHarryPotterS_negro2.webp'),
('Playera Kuromi Negra', 'Playera negra para mujer manga corta, estampado licencia Sanrio Kuromi.', 'M,G', 'Negro', 104.30, 67, 6, '../img/PlayeraKuromi_negro1.webp', '../img/PlayeraKuromi_negro2.webp'),
('Falda Hearth Shape Negra', 'Lo último en modo Jiari Kei, llevate esta falda y unete a este bello estilo', 'CH, M', 'Negro', 567.30, 34, 9, '../img/FaldaHearthShape1.webp', '../img/FaldaHearthShape2.webp'),
('Bolsa con Asa Corta y Larga Negra', 'Bolsa negra con asas cortas y largas, ideal para llevar todo lo que necesitas. Medidas aproximadas: 16 cm de Alto x 25 cm de Ancho x 8 cm de Profundidad.', 'Única', 'Negro', 239.20, 23, 13, '../img/BolsaAsacorta_larganegro1.webp', 'BolsaAsacorta_larganegro2.webp')
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
