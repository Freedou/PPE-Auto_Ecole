CREATE TABLE eleve(
	id_user int primary key AUTO_INCREMENT,
	date_insc date NOT NULL,
	date_naiss date NOT NULL,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL,
	coordonnee varchar(128) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE moniteur(
	id_user int primary key AUTO_INCREMENT,
	qualification varchar(32) NOT NULL,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE gestionnaire(
	id_user int primary key AUTO_INCREMENT,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE user(
	id_user int primary key AUTO_INCREMENT,
	date_heure_debut datetime primary key,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE cours(
	id_cours int primary key AUTO_INCREMENT,
	id_user int,
	type_cours varchar(32) NOT NULL,
	date_cours datetime,
	foreign key (id_user) references moniteur(id_user)
)ENGINE=InnoDB;

CREATE TABLE planning(
	id_user int,
	id_cours int,
	id_moniteur int,
	date_heure_debut datetime,
	heure_fin datetime NOT NULL,
	etat varchar(32) NOT NULL,
	foreign key (id_user) references eleve(id_user),
	foreign key (id_moniteur) references moniteur(id_user),
	foreign key (id_cours) references cours(id_cours)
)ENGINE=InnoDB;

/* Trigger heritage eleve, moniteur, gestionnaire vers user */

DROP TRIGGER deleteEleve;
DELIMITER //
CREATE TRIGGER deleteEleve
BEFORE DELETE ON eleve
FOR EACH ROW
BEGIN
	DELETE FROM user WHERE eleve=old.id_user;
END //
delimiter ;

DROP TRIGGER deleteMoniteur;
DELIMITER //
CREATE TRIGGER deleteMoniteur
BEFORE DELETE ON moniteur
FOR EACH ROW
BEGIN
	DELETE FROM user WHERE eleve=old.id_user;
END //
delimiter ;

DROP TRIGGER deleteGestionnaire;
DELIMITER //
CREATE TRIGGER deleteGestionnaire
BEFORE DELETE ON gestionnaire
FOR EACH ROW
BEGIN
	DELETE FROM user WHERE id_user=old.id_user;
END //
delimiter ;

DROP TRIGGER updateEleve;
DELIMITER //
CREATE TRIGGER updateEleve
BEFORE UPDATE ON eleve
FOR EACH ROW
BEGIN
	UPDATE user SET id_user=new.id_user, email=new.email, password=new.password, nom=new.nom, prenom=new.prenom WHERE id_user=new.id_user;
END //
delimiter ;

DROP TRIGGER updateMoniteur;
DELIMITER //
CREATE TRIGGER updateMoniteur
BEFORE UPDATE ON moniteur
FOR EACH ROW
BEGIN
	UPDATE user SET id_user=new.id_user, email=new.email, password=new.password, nom=new.nom, prenom=new.prenom WHERE id_user=new.id_user;
END //
delimiter ;

DROP TRIGGER updateGestionnaire;
DELIMITER //
CREATE TRIGGER updateGestionnaire
BEFORE UPDATE ON gestionnaire
FOR EACH ROW
BEGIN
	UPDATE user SET id_user=new.id_user, email=new.email, password=new.password, nom=new.nom, prenom=new.prenom WHERE id_user=new.id_user;
END //
delimiter ;

DROP TRIGGER addEleve;
DELIMITER //
CREATE TRIGGER addEleve
BEFORE INSERT ON eleve
FOR EACH ROW
BEGIN
	INSERT INTO user (id_user, email, password, nom, prenom) VALUES (new.id_user, new.email, new.password, new.nom, new.prenom);
END //
delimiter ;

DROP TRIGGER addMoniteur;
DELIMITER //
CREATE TRIGGER addMoniteur
BEFORE INSERT ON moniteur
FOR EACH ROW
BEGIN
	INSERT INTO user (id_user, email, password, nom, prenom) VALUES (new.id_user, new.email, new.password, new.nom, new.prenom);
END //
delimiter ;

DROP TRIGGER addGestionnaire;
DELIMITER //
CREATE TRIGGER addGestionnaire
BEFORE INSERT ON gestionnaire
FOR EACH ROW
BEGIN
	INSERT INTO user (id_user, email, password, nom, prenom) VALUES (new.id_user, new.email, new.password, new.nom, new.prenom);
END //
delimiter ;


declare x int;
	SELECT COUNT(*) INTO x FROM user WHERE id_user=new.id_user;
	IF x=0
	THEN
		INSERT INTO user VALUES (new.id_user);

INSERT INTO eleve (email, password, date_insc, date_naiss, nom, prenom, coordonnee) VALUES
('Freedou@live.fr', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', '2015-11-03', '1996-05-25', 'Billon', 'Joffray', '115 Rue du théatre 75015 Paris');
INSERT INTO moniteur (email, password, nom, prenom, qualification) VALUES
('freeboy-@hotmail.fr', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'Billon', 'Joffray', 'BTS SIO');
INSERT INTO gestionnaire (email, password, nom, prenom) VALUES
('joffray.billon@gmail.com', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 'Billon', 'Joffray');

CREATE TABLE eleve(
	id_user int primary key AUTO_INCREMENT,
	date_insc date NOT NULL,
	date_naiss date NOT NULL,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL,
	coordonnee varchar(128) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE moniteur(
	id_user int primary key AUTO_INCREMENT,
	qualification varchar(32) NOT NULL,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE gestionnaire(
	id_user int primary key AUTO_INCREMENT,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE user(
	id_user int primary key AUTO_INCREMENT,
	date_heure_debut datetime primary key,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE cours(
	id_cours int primary key AUTO_INCREMENT,
	id_user int AUTO_INCREMENT,
	type_cours varchar(32) NOT NULL,
	date_cours datetime,
	foreign key (id_user) references moniteur(id_user)
)ENGINE=InnoDB;

CREATE TABLE planning(
	id_user int primary key AUTO_INCREMENT,
	id_cours int primary key AUTO_INCREMENT,
	id_user_1 int primary key AUTO_INCREMENT,
	date_heure_debut datetime primary key,
	heure_fin datetime NOT NULL,
	etat varchar(32) NOT NULL,
	foreign key id_user references eleve(id_user),
	foreign key id_user_1 references moniteur(id_user),
	foreign key id_cours references cours(id_cours)
)ENGINE=InnoDB;

INSERT INTO planning(id_user, id_moniteur, date_heure_debut, etat) VALUES(2, 1, '2016-01-09 09:00:00', 'Prochainement');

SELECT * FROM planning WHERE id_moniteur=1 AND date_heure_debut like '2016-01-10 08%';

DROP TRIGGER addplanning;
DELIMITER //
CREATE TRIGGER addplanning
BEFORE INSERT ON planning
FOR EACH ROW
BEGIN
DECLARE nb int;
	SELECT COUNT(*) INTO nb FROM planning WHERE id_user=new.id_user AND id_moniteur=new.id_moniteur AND date_heure_debut=new.date_heure_debut;
	IF nb>0
	THEN
	SIGNAL SQLSTATE '45000';
END IF;
END //
delimiter ;

