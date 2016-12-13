PRAGMA FOREIGN_KEY = ON; --Needed for the error compiling

.mode columns
.headers on
.nullvalue NULL

/********** CLASSES tables **********/

drop table if exists UserInfo;
CREATE TABLE UserInfo(
    idUserInfo      INTEGER PRIMARY KEY AUTOINCREMENT,
    name            STRING NOT NULL,
    biography       STRING,
    photo           STRING,
    idUser          INTEGER REFERENCES User(idUser),

    FOREIGN KEY(idUser) REFERENCES User(idUser)
);

drop table if exists User;
CREATE TABLE User(
    idUser      INTEGER PRIMARY KEY AUTOINCREMENT,
	email		STRING NOT NULL,
    username    STRING NOT NULL,
    password    STRING NOT NULL,
    owner       BOOLEAN NOT NULL,

    idUserInfo  INTEGER REFERENCES UserInfo(idUserInfo),
    idPhoto     INTEGER REFERENCES PhotoUser(idPhoto)
);

drop table if exists Restaurant;
CREATE TABLE Restaurant(
    idRestaurant        INTEGER PRIMARY KEY AUTOINCREMENT,
    name                STRING NOT NULL,
    description         STRING NOT NULL,
    score               FLOAT NOT NULL,

    idOwner             INTEGER REFERENCES User(idUser),
    idRestaurantInfo    INTEGER REFERENCES RestaurantInfo(idRestaurantInfo)
);

drop table if exists Review;
CREATE TABLE Review(
    idReview        INTEGER PRIMARY KEY AUTOINCREMENT,
    score           INTEGER NOT NULL,
    comment         STRING,

    idRestaurant    INTEGER REFERENCES Restaurant(idRestaurant),
    idUser          INTEGER REFERENCES User(idUser)
);

drop table if exists Reply;
CREATE TABLE Reply(
    idReply     INTEGER PRIMARY KEY AUTOINCREMENT,
    comment     STRING NOT NULL,
    
    idReview    INTEGER REFERENCES Review(idReview),
    idReplier	INTEGER REFERENCES User(idUser)
);

drop table if exists RestaurantInfo;
CREATE TABLE RestaurantInfo(
    idRestaurantInfo    INTEGER PRIMARY KEY AUTOINCREMENT,
    price               INTEGER,
    category            STRING,
    openHours           DATE,
    closeHours          DATE,

    idLocalization      INTEGER REFERENCES Localization(idLocalization)
);

drop table if exists Localization;
CREATE TABLE Localization(
    idLocalization      INTEGER PRIMARY KEY AUTOINCREMENT,
    country             STRING,
    city                STRING,
    road                STRING,
    postalCode          STRING
);

drop table if exists PhotoUser;
CREATE TABLE PhotoUser(
    idPhoto     INTEGER PRIMARY KEY AUTOINCREMENT,
    fileName    STRING
);

drop table if exists PhotoRestaurant;
CREATE TABLE PhotoRestaurant(
    idPhoto             INTEGER PRIMARY KEY AUTOINCREMENT,
    type                STRING NOT NULL,
    title               STRING,
    
    idRestaurantInfo    INTEGER REFERENCES RestaurantInfo(idRestaurantInfo)
);

/********** MANY-TOO-MANY relationship table **********/

/********** DEFAULT INSERTIONS **********/
