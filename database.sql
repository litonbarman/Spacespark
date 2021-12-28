
/*

------------------------------------------------
 NCC WEB PORTAL
------------------------------------------------
 Author : Liton Barman
  
 This software is License under GNU General Public License
 version 3 ( GPLv3 )
 
 Redistribution and use of this software in source and binary forms, 
 with or without modification, are permitted provided that 
 the following conditions are met:
 
 . The source code must be made public whenever a distribution of
   the software is made.
 . Modifications of the software must be realised under the same license
 . Changes made to the Source Code must be documented


*/



CREATE DATABSE exampledb;


CREATE TABLE UserData (
    ID INT NOT NULL AUTO_INCREMENT,
    UserName VARCHAR(100),
    Email varchar(100),
    Password varchar(100),
    PRIMARY KEY(ID)
);


DROP TABLE userdata;