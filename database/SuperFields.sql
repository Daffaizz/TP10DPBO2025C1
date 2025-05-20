CREATE DATABASE IF NOT EXISTS SuperField;
USE SuperField;

CREATE TABLE IF NOT EXISTS fields (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    price_per_hour DECIMAL(10,2) NOT NULL
);


CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    field_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
    FOREIGN KEY (field_id) REFERENCES fields(id) ON DELETE CASCADE
);

INSERT INTO fields (name, type, price_per_hour) VALUES
('Lapangan Futsal A', 'futsal', 100000),
('Lapangan Basket B', 'basket', 120000),
('Lapangan Badminton C', 'badminton', 90000),
('Lapangan Tenis D', 'tenis', 150000);

INSERT INTO customers (name, phone, email) VALUES
('Isa', '081234567890', 'isa@gmail.com'),
('Putra', '082345678901', 'putra@gmail.com'),
('Bintang', '083456789012', 'bintang@gmail.com'),
('Hasbi', '084567890123', 'hasbi@gmail.com');

INSERT INTO bookings (customer_id, field_id, start_time, end_time, total_price) VALUES
(1, 1, '2025-05-21 08:00:00', '2025-05-21 10:00:00', 200000),
(2, 2, '2025-05-21 09:00:00', '2025-05-21 11:00:00', 240000),
(3, 3, '2025-05-22 14:00:00', '2025-05-22 15:00:00', 90000),
(4, 4, '2025-05-22 16:00:00', '2025-05-22 18:00:00', 300000);