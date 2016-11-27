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

drop table if exists Owner;
CREATE TABLE Owner(
    idUser      INTEGER PRIMARY KEY AUTOINCREMENT,
    name        STRING NOT NULL,
    password    STRING NOT NULL,
    idUserInfo  INTEGER REFERENCES UserInfo(idUserInfo)
);

drop table if exists Reviewer;
CREATE TABLE Reviewer(
    idUser      INTEGER PRIMARY KEY AUTOINCREMENT,
    name        STRING NOT NULL,
    password    STRING NOT NULL,
    idUserInfo  INTEGER REFERENCES UserInfo(idUserInfo)
);

drop table if exists Restaurant;
CREATE TABLE Restaurant(
    idRestaurant        INTEGER PRIMARY KEY AUTOINCREMENT,
    name                STRING NOT NULL,
    description         STRING,

    idOwner             INTEGER REFERENCES Owner(idOwner),
    idRestaurantInfo    INTEGER REFERENCES RestaurantInfo(idRestaurantInfo)
);

drop table if exists Review;
CREATE TABLE Review(
    idReview    INTEGER PRIMARY KEY AUTOINCREMENT,
    score       INTEGER NOT NULL,
    comment     STRING,

    idRestaurant    INTEGER REFERENCES Restaurant(idRestaurant),
    idReviewer      INTEGER REFERENCES Reviewer(idReviewer)
);

drop table if exists Reply;
CREATE TABLE Reply(
    idReply     INTEGER PRIMARY KEY AUTOINCREMENT,
    comment     STRING NOT NULL,

    idReview    INTEGER REFERENCES Review(idReview),
    idOwner     INTEGER REFERENCES Owner(idOwner),
    idReviewer  INTEGER REFERENCES Reviewer(idReviewer)
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

/********** MANY-TOO-MAY relationship table **********/

/********** DEFAULT INSERTIONS **********/

INSERT INTO Restaurant VALUES(null, 'Pizzaria MTV', 'Melhor de sempre!', 2, 1);
INSERT INTO Restaurant VALUES(null, 'Pizzaria XPTO', 'Pior de sempre!', 1, 2);