CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255)
);

CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  photo VARCHAR(255),
  role_id INT NOT NULL,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

INSERT INTO roles (title) VALUES ('admin');
INSERT INTO roles (title) VALUES ('user');

INSERT INTO users (first_name, last_name, email, password, role_id)
VALUES ('admin', 'admin', 'zhenyakiprenko@gmail.com','admin', 1);