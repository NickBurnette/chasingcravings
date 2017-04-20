
<<<<<<< HEAD
CREATE TABLE useraccounts(
userID		INT PRIMARY KEY,
username	VARCHAR(20) NOT NULL UNIQUE,
email		VARCHAR(50) NOT NULL UNIQUE, 
<<<<<<< HEAD
pwd			VARCHAR(50) NOT NULL,
=======
pwd		VARCHAR(50) NOT NULL,
>>>>>>> refs/remotes/colsson0/master
acctType	VARCHAR(5) NOT NULL);

CREATE TABLE trucks(
truckID		INT PRIMARY KEY,
<<<<<<< HEAD
truckName	VARCHAR(50) NOT NULL UNIQUE,
=======
truckName	VARCHAR(50) NOT NULL,
>>>>>>> refs/remotes/colsson0/master
userID		INT NOT NULL,
cuisine		VARCHAR(50) NOT NULL,
hours		VARCHAR(100),
pictureURL	VARCHAR(100),
truckURL	VARCHAR(100),
servesBreakfast	BOOLEAN,
servesLunch	BOOLEAN,
servesDinner	BOOLEAN,
lastUserLat	FLOAT,
lastUserLong	FLOAT,
lastTruckLat	FLOAT,
lastTruckLong	FLOAT,
CONSTRAINT userID_FK  FOREIGN KEY(userID) REFERENCES useraccounts(userID));

CREATE TABLE favorites(
favoriteID	INT PRIMARY KEY,
userID		INT NOT NULL,
truckID		INT NOT NULL,
CONSTRAINT userID_FK FOREIGN KEY(userID) REFERENCES useraccounts(userID),
CONSTRAINT truckID_FK FOREIGN KEY(truckID) REFERENCES trucks(truckID));

CREATE TABLE comments(
commentID	INT PRIMARY KEY,
userID		INT NOT NULL,
truckID		INT NOT NULL,
rating		INT,
cmnt		VARCHAR(5000),
CONSTRAINT userID_FK FOREIGN KEY(userID) REFERENCES useraccounts(userID),
CONSTRAINT truckID_FK FOREIGN KEY(truckID) REFERENCES trucks(truckID));

CREATE TABLE reports(
reportID	INT PRIMARY KEY,
userID		INT NOT NULL,
pageReported	VARCHAR(100) NOT NULL, 
cmnt		VARCHAR(1000),
CONSTRAINT userID_FK FOREIGN KEY(userID) REFERENCES useraccounts(userID));
=======
>>>>>>> parent of c293e0e... Please ignore this and delete
