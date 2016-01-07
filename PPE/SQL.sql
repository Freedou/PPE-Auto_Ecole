CREATE TABLE IF NOT EXISTS user (
  id_user varchar(32) NOT NULL,
  nom varchar(32) NOT NULL,
  prenom varchar(32) NOT NULL,
  email varchar(128) NOT NULL,
  password varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  date_inscription date DEFAULT NULL,
  type int(1) NOT NULL DEFAULT 1 COMMENT 1 = eleve, 2 = prof, 3 = gestionnaire,
  PRIMARY KEY (id_user),
  UNIQUE KEY e_mail (e_mail)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO user (id_user, e_mail, password, date_inscription, type) VALUES
('El Barto', 'Freedou@live.fr', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 2015-11-03, 1),
('Freedou', 'freeboy-@hotmail.fr', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 2015-06-18, 3),
('Joffray', 'joffray.billon@gmail.com', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 2015-06-18, 2);

/* ajouter une contrainte exclusion*/

CREATE TABLE eleve(
	id_user varchar(32) NOT NULL,
	primary key (id_user),
	foreign key id_user references user(id_user),
)ENGINE=InnoDB;

CREATE TABLE prof(
	id_user varchar(32) NOT NULL,
	primary key (id_user),
	foreign key id_user references user(id_user),
)ENGINE=InnoDB;

CREATE TABLE planning(
	id_cours int AUTO_INCREMENT NOT NULL,
	date_cours datetime UNIQUE,
	eleve varchar(32) NOT NULL,
	prof varchar(32) NOT NULL,
	type int(3) NOT NULL,
	primary key(id_cours),
	foreign key eleve references eleve(id_user),
	foreign key prof references prof(id_user)
)ENGINE=InnoDB;

DROP TRIGGER deleteUser;
DELIMITER //
CREATE TRIGGER deleteUser
BEFORE DELETE ON user
FOR EACH ROW
BEGIN
	DELETE FROM planning WHERE eleve=old.id_user OR prof=old.id_user;
END //
delimiter ;



declare x int;
	SELECT COUNT(*) INTO x FROM user WHERE id_user=new.id_user;
	IF x=0
	THEN
		INSERT INTO user VALUES (new.id_user);