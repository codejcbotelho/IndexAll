CREATE TABLE  `imagens` (
 `id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `imagem` TEXT NOT NULL ,
 `endereco` TEXT NOT NULL ,
 `hits` INT( 10 ) NOT NULL ,
 `estado` INT( 1 ) NOT NULL
) ENGINE = INNODB;

CREATE TABLE  `enderecos` (
 `id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `endereco` TEXT NOT NULL
) ENGINE = INNODB;