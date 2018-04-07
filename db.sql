CREATE DATABASE KUHUMUN DEFAULT CHARACTER SET UTF8;
USE KUHUMUN;

CREATE TABLE RESTAURANT(
	RES_ID int(5) NOT NULL AUTO_INCREMENT,
	RES_TITLE char(20) NOT NULL,
	REPORT_COUNT int(3) DEFAULT 0,
	PROVEN_CODE tinyint(1) DEFAULT 0,
	PRIMARY KEY (RES_ID),
	UNIQUE INDEX (RES_TITLE)
);


CREATE TABLE RES_DETAIL(
	DETAIL_ID int(5) NOT NULL AUTO_INCREMENT,
	RES_ID int(5) NOT NULL,
	RES_MENU char(15) NOT NULL,
	RES_PRICE char(6) NOT NULL,
	USER_IP char(20) NOT NULL,
	INPUT_TIME date NOT NULL,
	REPORT_COUNT int(3) DEFAULT 0,
	PROVEN_CODE tinyint(1) DEFAULT 0,
	PRIMARY KEY(DETAIL_ID)
);

CREATE TABLE REPORT(
	RES_ID int(5) NOT NULL,
	DETAIL_ID int(5) NOT NULL,
	USER_IP char(20) NOT NULL,
	INPUT_TIME datetime NOT NULL,

	PRIMARY KEY(INPUT_TIME)
);


CREATE TABLE BLOCK_LIST(
	USER_IP char(20) NOT NULL,

	PRIMARY KEY(USER_IP)
);