CREATE TABLE users (
id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
username	 VARCHAR(64)
pwd			 VARCHAR(128)
PRIMARY KEY(id)
) ENGINE MyISAM;

CREATE TABLE workouts (
id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
user_id      INT UNSIGNED NOT NULL,
title        VARCHAR(128),
date         DATE,
PRIMARY KEY(id)
) ENGINE MyISAM;

CREATE TABLE activities (
id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
workout_id   INT UNSIGNED NOT NULL,
type_id      INT UNSIGNED NOT NULL,
PRIMARY KEY(id)
) ENGINE MyISAM;

CREATE TABLE performances (
id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
activity_id  INT UNSIGNED NOT NULL,
nsets        TINYINT,
nreps        TINYINT,
d            FLOAT,
d_unit       VARCHAR(20),
t            TIME,
w            FLOAT,
w_unit       VARCHAR(20),
PRIMARY KEY(id)
) ENGINE MyISAM;

CREATE TABLE activity_types(
id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
name         VARCHAR(64),
n            BIT(1),
d            BIT(2),
t            BIT(1),
w            BIT(1),
PRIMARY KEY(id)
) ENGINE MyISAM;