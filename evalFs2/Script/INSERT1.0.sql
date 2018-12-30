
INSERT INTO USERS(pseudo,mail,password) VALUES('Admin','rosiek.hugo@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User1','brandon.dead-kill@hotmail.fr','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User2','sa.bennacoeur@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User3','user3@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User4','user4@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User5','user5@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User6','user6@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User7','user7@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User8','user8@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User9','user9@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User10','user10@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User11','user11@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User12','user12@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User13','user13@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User14','user14@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User15','user15@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User16','user16@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User17','user17@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User18','user18@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User19','user19@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User20','user20@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User21','user21@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User22','user22@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User23','user23@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');
INSERT INTO USERS(pseudo,mail,password) VALUES('User24','user24@gmail.com','cd98bf0202ef07e38e87f6bd9445e5e7331e2c78');

INSERT INTO PLATOONS(name,status,userID) VALUES('Hatford\'s Bar','Welcome !!',(SELECT ID FROM USERS WHERE pseudo like 'Admin'));
INSERT INTO PLATOONS(name,status,userID) VALUES('Jupiter','HELLO WORLD!',(SELECT ID FROM USERS WHERE pseudo like 'User1'));
INSERT INTO PLATOONS(name,status,userID) VALUES('Esteren','Public test',(SELECT ID FROM USERS WHERE pseudo like 'User2'));
INSERT INTO PLATOONS(name,status,userID) VALUES('4RL3K1','Oungoulou goulouh Ati te POKO',(SELECT ID FROM USERS WHERE pseudo like 'User3'));

INSERT INTO CATEGORYS(name) VALUES('Fun');
INSERT INTO CATEGORYS(name) VALUES('Dance');
INSERT INTO CATEGORYS(name) VALUES('Rock');
INSERT INTO CATEGORYS(name) VALUES('Weird');
INSERT INTO CATEGORYS(name) VALUES('Hip Hop');
INSERT INTO CATEGORYS(name) VALUES('Rap');
INSERT INTO CATEGORYS(name) VALUES('Classic');
INSERT INTO CATEGORYS(name) VALUES('Fight');
INSERT INTO CATEGORYS(name) VALUES('Sport');
INSERT INTO CATEGORYS(name) VALUES('Other');

INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Weird'),(SELECT ID FROM PLATOONS WHERE name like 'Hatford\'s Bar'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Sport'),(SELECT ID FROM PLATOONS WHERE name like 'Hatford\'s Bar'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Dance'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Rock'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Hip Hop'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Classic'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Other'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Weird'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Fight'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Other'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Weird'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Other'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));

INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'Admin'),(SELECT ID FROM PLATOONS WHERE name like 'Hatford\'s Bar'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User1'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User1'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User2'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User3'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User4'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User5'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User6'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User7'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User8'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User9'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User10'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User11'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User12'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User13'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User14'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User15'),(SELECT ID FROM PLATOONS WHERE name like '4RL3K1'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User16'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User17'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User18'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User19'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User20'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User21'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User22'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User23'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User24'),(SELECT ID FROM PLATOONS WHERE name like 'Jupiter'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User2'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User3'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User4'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User5'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User6'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User7'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User8'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User9'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES((SELECT ID FROM USERS WHERE pseudo like 'User10'),(SELECT ID FROM PLATOONS WHERE name like 'Esteren'));
INSERT INTO SUBSCRIBERS(userID,platoonID) VALUES(1,1);
INSERT INTO BELONGS(categoryID,platoonID) VALUES((SELECT ID FROM CATEGORYS WHERE name like 'Relax'),(SELECT ID FROM PLATOONS WHERE name like 'Sid Room'));


INSERT INTO `backgrounds` (`ID`, `name`, `backPath`) VALUES 
(NULL, 'Hugo Cat', 'V/_template/img/cat.jpg'), 
(NULL, 'Forest', 'V/_template/img/forest.jpg'), 
(NULL, 'Magic', 'V/_template/img/magic.jpg'), 
(NULL, 'Nebula', 'V/_template/img/nebuleuse.jpg'), 
(NULL, 'Lake', 'V/_template/img/mountainLake.jpg'), 
(NULL, 'Sea', 'V/_template/img/sea.jpg'), 
(NULL, 'Stars', 'V/_template/img/stars.jpg'), 
(NULL, 'Storm', 'V/_template/img/storm.jpg'), 
(NULL, 'Sunset', 'V/_template/img/sunset.jpg'), 
(NULL, 'Iceberg', 'V/_template/img/iceberg.jpg');















