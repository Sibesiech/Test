# noinspection SqlNoDataSourceInspectionForFile

create database if not exists nobox;
use nobox;

create table if not exists Users(
ID_User int not null auto_increment,
Username varchar(30) not null,
first varchar(255),
last VARCHAR(255),
Emailaddress varchar(30) not null,
Hash  VARCHAR(1000) not null,
UserPiclink varchar(255),
constraint pk_users primary key (ID_User),
CONSTRAINT uk_user_username UNIQUE KEY (Username),
constraint uk_user_email unique key (Emailaddress)
);
# -----------Vorerst nur Images
# create table if not exists Images(
# ID_Images int not null auto_increment,
# ImageLink varchar(255) not null,
# User_ID int not null,
# constraint pk_images primary key (ID_Images),
# constraint fk_images_users foreign key (User_Id) references Users(ID_User)
# );

# create table if not exists Gallery(
# ID_Gallery int not null auto_increment,
# User_ID int not null,
# constraint pk_gallery primary key (ID_Gallery),
# constraint fk_gallery_users foreign key (User_ID) references Users(ID_User)
# );
#
# create table if not exists Gallery_Images(
# ID_Gallery_Images int not null auto_increment,
# Gallery_ID int not null,
# Images_ID int not null,
# constraint pk_gallery_images primary key (ID_Gallery_Images),
# constraint fk_gallery_images_gallery foreign key (Gallery_ID) references Gallery(ID_Gallery),
# constraint fk_gallery_images_images foreign key (Images_ID) references Images(ID_Images)
# );

CREATE TABLE IF NOT EXISTS Images(
  ID_Image INT NOT NULL AUTO_INCREMENT,
  ImageLink VARCHAR(255) NOT NULL,
  User_ID INT NOT NULL,
  CONSTRAINT pk_image PRIMARY KEY (ID_Image),
  CONSTRAINT fk_image_user FOREIGN KEY (User_ID) REFERENCES Users(ID_User),
  CONSTRAINT uk_image_imagelink UNIQUE KEY (ImageLink)
);

create table if not exists Note(
ID_Note int not null auto_increment,
Notetext Text,
User_ID int not null,
constraint pk_note primary key (ID_Note),
constraint fk_note_users foreign key (User_ID) references Users(ID_User)
);

create table if not exists Collection(
ID_Collection int not null auto_increment,
User_ID int not null,
constraint pk_collection primary key (ID_Collection),
constraint fk_collection_users foreign key (User_ID) references Users(ID_User)
);

create table if not exists Box(
ID_Box int not null auto_increment,
Boxtitle VARCHAR(255) NOT NULL,
ParentBoxID int,
Note_ID int,
Gallery_ID int,
Collection_ID int,
Creation_Timestamp timestamp default current_Timestamp,
Change_Timestamp timestamp on update current_Timestamp,
PositionInCollection tinyint not null,
constraint pk_box primary key (ID_Box),
constraint uk_box unique key (Note_ID, Gallery_ID, Collection_ID),
constraint fk_box_note foreign key (Note_ID) references Note(ID_Note),
constraint fk_box_gallery foreign key (Gallery_ID) references Gallery(ID_Gallery),
constraint fk_box_collection foreign key (Collection_Id) references Collection(ID_Collection)
);

create table if not exists User_Box(
ID_User_Box int not null auto_increment,
User_ID int not null,
Box_ID int not null,
constraint pk_users_box primary key (ID_User_Box),
constraint fk_users_box_users foreign key (User_ID) references Users(ID_User),
constraint fk_user_box_box foreign key (Box_ID) references Box(ID_Box)
);