CREATE TABLE eleve(
	id_user int primary key AUTO_INCREMENT,
	date_insc date NOT NULL,
	date_naiss date NOT NULL,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL,
	coordonnee varchar(128) NOT NULL
)ENGINE=InnoDB

CREATE TABLE moniteur(
	id_user int primary key AUTO_INCREMENT,
	qualification varchar(32) NOT NULL,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL
)ENGINE=InnoDB

CREATE TABLE gestionnaire(
	id_user int primary key AUTO_INCREMENT,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL
)ENGINE=InnoDB

CREATE TABLE user(
	id_user int primary key AUTO_INCREMENT,
	nom varchar(32) NOT NULL,
	prenom varchar(32) NOT NULL,
	password varchar(40) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
	email varchar(128) NOT NULL
)ENGINE=InnoDB

CREATE TABLE planning(
	id_user int primary key AUTO_INCREMENT,
	id_cours int primary key AUTO_INCREMENT,
	id_user_1 int primary key AUTO_INCREMENT,
	date_heure_debut datetime primary key,
	heure_fin datetime NOT NULL,
	etat varchar(32),
	foreign key id_user references eleve(id_user),
	foreign key id_user_1 references moniteur(id_user),
	foreign key id_cours references cours(id_cours)
)ENGINE=InnoDB

CREATE TABLE cours(
	id_cours int primary key AUTO_INCREMENT,
	id_user int AUTO_INCREMENT,
	type_cours varchar(32),
	date_cours datetime,
	foreign key id_user references moniteur(id_user)
)ENGINE=InnoDB


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
BEFORE DELETE ON eleve
FOR EACH ROW
BEGIN
	UPDATE user SET id_user=new.id_user, email=new.email, password=new.password, nom=new.nom, prenom=new.prenom WHERE id_user=new.id_user;
END //
delimiter ;

DROP TRIGGER updateMoniteur;
DELIMITER //
CREATE TRIGGER updateMoniteur
BEFORE DELETE ON moniteur
FOR EACH ROW
BEGIN
	UPDATE user SET id_user=new.id_user, email=new.email, password=new.password, nom=new.nom, prenom=new.prenom WHERE id_user=new.id_user;
END //
delimiter ;

DROP TRIGGER updateGestionnaire;
DELIMITER //
CREATE TRIGGER updateGestionnaire
BEFORE DELETE ON gestionnaire
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
	INSERT INTO user (id_user, email, password, nom, prenom) VALUES (new.id_user, new.email, new.password, new.nom, new.prenom)
END //
delimiter ;

DROP TRIGGER addMoniteur;
DELIMITER //
CREATE TRIGGER addMoniteur
BEFORE INSERT ON moniteur
FOR EACH ROW
BEGIN
	INSERT INTO user (id_user, email, password, nom, prenom) VALUES (new.id_user, new.email, new.password, new.nom, new.prenom)
END //
delimiter ;

DROP TRIGGER addGestionnaire;
DELIMITER //
CREATE TRIGGER addGestionnaire
BEFORE INSERT ON gestionnaire
FOR EACH ROW
BEGIN
	INSERT INTO user (id_user, email, password, nom, prenom) VALUES (new.id_user, new.email, new.password, new.nom, new.prenom)
END //
delimiter ;


declare x int;
	SELECT COUNT(*) INTO x FROM user WHERE id_user=new.id_user;
	IF x=0
	THEN
		INSERT INTO user VALUES (new.id_user);

INSERT INTO user (id_user, e_mail, password, date_inscription, type) VALUES
('1', 'Freedou@live.fr', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 2015-11-03, 1),
('2', 'freeboy-@hotmail.fr', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 2015-06-18, 2),
('3', 'joffray.billon@gmail.com', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', 2015-06-18, 3);