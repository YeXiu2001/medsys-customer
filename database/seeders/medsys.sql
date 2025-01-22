CREATE TABLE pharmacy_info (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNSIGNED,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    address VARCHAR(255) NOT NULL,
    logo_dir VARCHAR(50),
    latitude VARCHAR(50),
    longitude VARCHAR(50),
    o_time TIMESTAMP,
    c_time TIMESTAMP,
    enable TINYINT(1) DEFAULT 1,
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE payment_methods (
    pm_code VARCHAR(50) NOT NULL PRIMARY KEY,
    meaning VARCHAR(50) NOT NULL,
    enable TINYINT(1) DEFAULT 1,
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pharmacy_ads (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNSIGNED,
    pharmacy_id INT(11) NOT NULL FOREIGN KEY REFERENCES pharmacy_info(id) ON DELETE CASCADE,
    adpic_dir VARCHAR(50) NOT NULL,
    description VARCHAR(255),
    enable TINYINT(1) DEFAULT 1,
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_customers (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNSIGNED,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    enable TINYINT(1) DEFAULT 1,
    fault_count INT(11) DEFAULT 0,
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE medicines (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNSIGNED,
    name VARCHAR(100) NOT NULL,
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pharmacy_meds (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pharmacy_id INT(11) NOT NULL FOREIGN KEY REFERENCES pharmacy_info(id) ON DELETE CASCADE,
    med_id INT(11) NOT NULL FOREIGN KEY REFERENCES medicines(id) ON DELETE CASCADE,
    med_description VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    stocks INT(11) NOT NULL,
    is_prescribed TINYINT(1) DEFAULT 0,
    dosage VARCHAR(50),
    enable TINYINT(1) DEFAULT 1,
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE trans_adj_types (
    adj_code VARCHAR(50) NOT NULL PRIMARY KEY,
    meaning VARCHAR(50) NOT NULL,
    adj_type VARCHAR(10) NOT NULL, -- D, OC --
    rate_type VARCHAR(10) NOT NULL, -- M, P --
    rate DECIMAL(10,2),
    enable TINYINT(1) DEFAULT 1,
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE trans_order (
    order_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNSIGNED,
    pharmacy_id INT(11) NOT NULL FOREIGN KEY REFERENCES pharmacy_info(id) ON DELETE CASCADE,
    customer_id INT(11),
    trans_status VARCHAR(50) NOT NULL DEFAULT 'O', -- O, C, V --
    pay_status VARCHAR(50) NOT NULL DEFAULT 'U', -- P, U --
    prep_status VARCHAR(50) NOT NULL DEFAULT 'P', -- P for pending, O for Ongoing, C for Completed --
    pay_method VARCHAR(50) NOT NULL DEFAULT 'CA', -- C for Cash, P for Paypal --
    subtot_amt DECIMAL(10,2),
    total_discount DECIMAL(10,2),
    total_due DECIMAL(10,2),
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE trans_items (
    item_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNSIGNED,
    order_id INT(11) NOT NULL FOREIGN KEY REFERENCES trans_order(order_id) ON DELETE CASCADE,
    med_id INT(11),
    med_name VARCHAR(100),
    qty INT(11),
    base_price DECIMAL(10,2),
    total_price DECIMAL(10,2),
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE trans_bill_adj (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNSIGNED,
    order_id INT(11) NOT NULL,
    adj_code VARCHAR(50) NOT NULL,
    rate DECIMAL(10,2),
    adj_amt DECIMAL(10,2),
    created_by INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
