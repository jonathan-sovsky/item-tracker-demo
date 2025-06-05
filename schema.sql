CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255),
    vendor VARCHAR(100),
    status VARCHAR(50),
    start_date DATE,
    end_date DATE,
    units_sold INT,
    units_returned INT
);

INSERT INTO items (item_name, vendor, status, start_date, end_date, units_sold, units_returned) VALUES
('Widget Alpha', 'Acme Corp', 'Active', '2024-12-01', '2024-12-31', 4123, 12),
('Widget Beta', 'Globex Inc.', 'Paused', '2024-11-15', '2024-12-15', 1012, 30),
('Widget Gamma', 'Initech', 'Discontinued', '2024-10-01', '2024-10-31', 5890, 85);
