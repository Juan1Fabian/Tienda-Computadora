CREATE TABLE computadoras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    procesador VARCHAR(255) NOT NULL,
    ram_gb INT NOT NULL,
    almacenamiento VARCHAR(255),
    tarjeta_grafica VARCHAR(255),
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    descripcion TEXT,
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO computadoras (
    nombre, marca, categoria, procesador, ram_gb, almacenamiento, 
    tarjeta_grafica, precio, stock, descripcion
) VALUES 
(
    'Laptop Gaming ROG Strix G15', 'ASUS', 'Gaming',
    'AMD Ryzen 7 5800H', 16, 'SSD NVMe 512GB',
    'NVIDIA GeForce RTX 3060', 1299.99, 15,
    'Laptop gaming de alto rendimiento'
),
(
    'Desktop Inspiron 3891', 'Dell', 'Desktop',
    'Intel Core i5-11400', 8, 'SSD 256GB + HDD 1TB',
    'Intel UHD Graphics 730', 699.99, 25,
    'PC de escritorio para oficina'
),
(
    'MacBook Air M2', 'Apple', 'Laptop',
    'Apple M2', 8, 'SSD 256GB',
    'Apple M2 GPU', 1199.99, 10,
    'Ultrabook premium con chip M2'
),
(
    'Workstation ThinkPad P1', 'Lenovo', 'Workstation',
    'Intel Core i7-12800H', 32, 'SSD NVMe 1TB',
    'NVIDIA RTX A2000', 2899.99, 5,
    'Estación de trabajo móvil'
);
