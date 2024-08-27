use web_tennis;
create table users
(
	id int identity primary key,
	fullName varchar(100),
	email varchar(100),
	phone varchar(20),
	passWord varchar(50),
	forgotToken varchar(100),
	activeToken varchar(100),
	createAt datetime,
	updateAt datetime,
	status int default 0
)
create table loginToken
(
	id int identity primary key,
	idUser int,
	token varchar(100),
	createAt datetime
	foreign key(idUser) references users(id)
)
drop table users;
INSERT INTO users (id, fullName, email, phone, passWord, forgotToken, activeToken, createAt, updateAt) 
VALUES ( null,'Nguyễn Tâm Hy', 'Hynt@gmail.com', '0777777777', ('hy123456'), NULL, NULL, '2024-08-14 17:47:58', '2024-08-14 17:47:58');