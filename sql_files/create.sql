CREATE TABLE IF NOT EXISTS products (
    product_id INT NOT NULL AUTO_INCREMENT,
    product_name VARCHAR(255) NOT NULL,
    price DOUBLE NOT NULL,
    product_desc TEXT,
    img_thumb VARCHAR(255),
    img_full VARCHAR(255),
    PRIMARY KEY (product_id)
);

CREATE TABLE IF NOT EXISTS orders (
    order_id INT NOT NULL AUTO_INCREMENT,
    order_status VARCHAR(255) NOT NULL,
    PRIMARY KEY (order_id)
);
CREATE TABLE IF NOT EXISTS ordered_products (
    order_id INT NOT NULL AUTO_INCREMENT,
    product_id INT NOT NULL,
    product_quantity VARCHAR(255) NOT NULL,
    PRIMARY KEY (order_id , product_id),
    FOREIGN KEY (product_id)
        REFERENCES Products (product_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (order_id)
        REFERENCES Orders (order_id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS users (
    email VARCHAR(255) NOT NULL,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    tel VARCHAR(255),
    payment_method VARCHAR(255),
    user_password VARCHAR(255) NOT NULL,
    user_role VARCHAR(255) NOT NULL DEFAULT 'customer',
    img VARCHAR(255),
    PRIMARY KEY (email)
);
CREATE TABLE IF NOT EXISTS users_orders (
    email VARCHAR(255) NOT NULL,
    order_id INT NOT NULL,
    PRIMARY KEY (email , order_id),
    FOREIGN KEY (order_id)
        REFERENCES Orders (order_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (email)
        REFERENCES Users (email)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS addresses (
    address_id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    address_type VARCHAR(255) NOT NULL,
    address_line1 VARCHAR(255) NOT NULL,
    address_line2 VARCHAR(255),
    city VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    postcode VARCHAR(255) NOT NULL,
    PRIMARY KEY (address_id , email),
    FOREIGN KEY (email)
        REFERENCES Users (email)
        ON UPDATE CASCADE ON DELETE CASCADE
);