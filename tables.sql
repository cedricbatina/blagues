CREATE TABLE blagues (
 id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 texte_blague text,
 date_blague datetime NOT NULL,
 id_auteur int
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE auteurs (
 id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
 nom varchar(255),
 mail varchar(255)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE mails (
 id INT NOT NULL AUTO_INCREMENT,
 mail VARCHAR(255),
 id_auteur INT,
 PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE categories (
 id INT NOT NULL AUTO_INCREMENT,
 nom VARCHAR(255) NOT NULL,
 PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE blague_categ (
 id_blague INT NOT NULL AUTO_INCREMENT,
 id_categ INT NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (id_blague, id_categ)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;