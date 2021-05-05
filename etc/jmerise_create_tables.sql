#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        id     Int  Auto_increment  NOT NULL ,
        hash   Varchar (50) NOT NULL ,
        login  Varchar (50) NOT NULL ,
        pseudo Varchar (100) NOT NULL
	,CONSTRAINT User_AK UNIQUE (login)
	,CONSTRAINT User_PK PRIMARY KEY (id)
	,INDEX User_Idx (pseudo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Photo
#------------------------------------------------------------

CREATE TABLE Photo(
        id      Int  Auto_increment  NOT NULL ,
        title   Varchar (100) NOT NULL ,
        created Datetime NOT NULL ,
        file    Varchar (255) NOT NULL ,
        id_User Int NOT NULL
	,CONSTRAINT Photo_AK UNIQUE (file)
	,CONSTRAINT Photo_PK PRIMARY KEY (id)

	,CONSTRAINT Photo_User_FK FOREIGN KEY (id_User) REFERENCES User(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Comment
#------------------------------------------------------------

CREATE TABLE Comment(
        id       Int  Auto_increment  NOT NULL ,
        created  Datetime NOT NULL ,
        id_User  Int NOT NULL ,
        id_Photo Int NOT NULL
	,CONSTRAINT Comment_PK PRIMARY KEY (id)

	,CONSTRAINT Comment_User_FK FOREIGN KEY (id_User) REFERENCES User(id)
	,CONSTRAINT Comment_Photo0_FK FOREIGN KEY (id_Photo) REFERENCES Photo(id)
)ENGINE=InnoDB;

