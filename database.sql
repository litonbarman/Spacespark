CREATE DATABASE spacespark;
USE DATABASE spacespark;


/* The User table */


CREATE TABLE users (
    userid    INT         NOT NULL   IDENTITY  PRIMARY KEY,
	username  VARCHAR(30) NOT NULL,
    emailid   VARCHAR(40) NOT NULL,
	phoneno   VARCHAR(14) NOT NULL,
    password  VARCHAR(60) NOT NULL,
	status    BOOL,
	prfileurl VARCHAR(200) NOT NULL,
	hasprofile bool        NOT NULL,
	dob       DATE         NOT NULL
);



/* The Followee table */



CREATE TABLE followee (
   userid     int   NOT NULL,
   followee   int   NOT NULL
);


/* The Followee table */

CREATE TABLE follower (
   userid     int  NOT NULL,
   follower   int  NOT NULL
);



/* The Contact table */

CREATE TABLE contact (
   userid     int  NOT NULL,
   contactid  int  NOT NULL
);


/* The Story table */


CREATE TABLE story (
   postid    INT  NOT NULL AUTO_INCREMENT,
   userid    INT NOT NULL,
   posttxt   TEXT,
   imgloc    VARCHAR(200),
   hasimg    BOOL
);








/* The Group table  */


CREATE TABLE sparkgroup (
  groupid      INT   NOT NULL AUTO_INCREMENT,
  hasgroupimg  bool,
  groupimgurl  VARCHAR(200),
  about        TEXT
);

CREATE TABLE groupmembers (
  groupid    INT NOT NULL,
  userid     INT NOT NULL
);

CREATE TABLE groupmessage (
  messageid  INT NOT NULL AUTO_INCREMENT,
  groupid    INT NOT NULL,
  userid     int NOT NULL,
  message    TEXT
);



CREATE TABLE usergroups (
  userid  INT NOT NULL,
  groupid INT NOT NULL
);





/* Personal Message */

CREATE TABLE message (
  messageid  INT NOT NULL AUTO_INCREMENT,
  senderid   INT NOT NULL,
  receiverid INT NOT NULL,
  message    TEXT
);

