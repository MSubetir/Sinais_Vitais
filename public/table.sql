SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+3:00";

CREATE TABLE `Users` (
  IdUser int(3) NOT NULL AUTO_INCREMENT,
  name varchar(25) NOT NULL,
  nascimento DATE NOT NULL,
  email varchar(100),
  telefone VARCHAR(25), NOT NULL,
  idade int(3),
  rua varchar(100) NOT NULL,
  numero varchar(25) NOT NULL,
  cidade varchar(50) NOT NULL,
  estado varchar(50) NOT NULL,
  cep VARCHAR(25),
  lat DECIMAL(11, 8) NOT NULL,
  lon DECIMAL(11, 8) NOT NULL,
  CONSTRAINT PK_User PRIMARY KEY (IdUser)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE Users AUTO_INCREMENT=1;

--add

ALTER TABLE users
ADD nascimento DATE;
ALTER TABLE users
ADD telefone varchar(25);
ALTER TABLE users
ADD rua varchar(100);
ALTER TABLE users
ADD numero varchar(25);
ALTER TABLE users
ADD cidade varchar(50);
ALTER TABLE users
ADD estado varchar(50);
ALTER TABLE users
ADD cep varchar(25);

CREATE TABLE `Access` (
  IdAccess int(3) NOT NULL,
  username varchar(25) NOT NULL,
  password varchar(255) NOT NULL,
  CONSTRAINT PK_Access PRIMARY KEY (IdAccess)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `NormalSigns` (
  IdNormalSigns int(3) NOT NULL AUTO_INCREMENT,
  idade int(3) NOT NULL,
  O2_min float(4) NOT NULL,
  O2_max float(4) NOT NULL,
  BPM_min float(4) NOT NULL,
  BPM_max float(4) NOT NULL,
  TEMPERATURA_min float(4) NOT NULL,
  TEMPERATURA_max float(4) NOT NULL,
  CONSTRAINT PK_NormalSigns PRIMARY KEY (IdNormalSigns)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `UsersXHistories` (idade, O2_min, O2_max, BPM_min, BPM_max, TEMPERATURA_min, TEMPERATURA_max) 
VALUES (0,90,100, 60, 120, 35.5, 38);

INSERT INTO `normalsigns` (idade, O2_min, O2_max, BPM_min, BPM_max, TEMPERATURA_min, TEMPERATURA_max) 
VALUES (0,90,100, 60, 120, 35.5, 38),
(18,90,100, 56, 82, 35.4, 38),
(25,90,100, 56, 82, 35.4, 38),
(35,90,100, 56, 82, 35.4, 38),
(45,90,100, 58, 84, 35.4, 38),
(55,90,100, 56, 82, 35.4, 38),
(65,90,100, 56, 80, 35.4, 38)
#hipotermia ou
#febre
#como asma, pneumonia, enfisema, insuficiência cardíaca ou doenças neurológicas e até uma complicação do Covid-19.
#bloqueio cardíaco ou disfunção do nódulo sinusal, principalmente se for acompanhada de tonturas, cansaço ou falta de ar.
#ansiedade, febre, esforço, pressão está alta, ingestão de grandes quantidades de álcool ou cafeína, doença cardíaca.

CREATE TABLE `Boards` (
  IdBoard int(3) NOT NULL,
  IdUser int(3) NOT NULL,
  CONSTRAINT PK_Board PRIMARY KEY (IdBoard),
	CONSTRAINT FK_Users_IdUser FOREIGN KEY (IdUser)	REFERENCES Users (IdUser)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Histories` (
  IdHistory int(3) NOT NULL,
  O2 float(4) NOT NULL,
  BPM float(4) NOT NULL,
  TEMPERATURA FLOAT(4) NOT NULL,
  date datetime NOT NULL,
  CONSTRAINT PK_History PRIMARY KEY (IdHistory)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `UsersXHistories` (
  IdUser int(3) NOT NULL,
  IdHistory int(3) NOT NULL,
  CONSTRAINT PK_UsersXHistories PRIMARY KEY (IdUser, IdHistory),
	CONSTRAINT PK_UsersXHistories2 FOREIGN KEY (IdUser)	REFERENCES Users (IdUser),
  CONSTRAINT PK_UsersXHistories3 FOREIGN KEY (IdHistory)	REFERENCES Histories (IdHistory)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `Access` VALUES (1, 'admin', '123456');
INSERT INTO `Users` VALUES (1, 'Maycon');
INSERT INTO `Boards` VALUES (6, 1);
INSERT INTO `Histories` VALUES (3, 24, 256, 626);
INSERT INTO `Histories` VALUES (5, 25, 252, 266);
INSERT INTO `Histories` VALUES (6, 212, 251, 266);
INSERT INTO `Histories` VALUES (7, 256, 2215, 266);
INSERT INTO `UsersXHistories` VALUES (1,3);
INSERT INTO `UsersXHistories` VALUES (1,5);


select * from users as us
	INNER JOIN usersxhistories as ushi
		ON us.idUser = ushi.IdUser
	INNER JOIN histories as hi
		ON ushi.IdHistory = hi.IdHistory





ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `user_data`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
