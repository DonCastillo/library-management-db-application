# drop library_management db if it exists
drop database if exists library;

# create library_management db if it exists
create database if not exists library;

# use database
use library;

# drop all tables
drop table if exists AUTHOR;
drop table if exists BOOK;
drop table if exists WRITES;
drop table if exists BORROWER;
drop table if exists RENTAL;

# create tables

#-----------------------------
# AUTHOR
#-----------------------------
create table AUTHOR(
    id int unsigned not null auto_increment,
    fName varchar(35),
    lName varchar(45) not null,
    unique (fName, lName),
    primary key (id)
);

insert into AUTHOR values
(1, 'J.K.', 'Rowling'),
(2, 'J.R.R.', 'Tolkien'),
(3, 'Leo', 'Tolstoy'),
(4, 'Robert', 'Langdon'),
(5, 'Jon', 'Krakauer'),
(6, 'Ernest', 'Cline'),
(7, 'Stieg', 'Larsson'),
(8, 'Dan', 'Brown'),
(9, 'Suzanne', 'Collins'),
(10, 'James', 'Dashner'),
(11, 'C.S.', 'Lewis'),
(12, 'George R.R.', 'Martin'),
(13, 'Jeff', 'Kinney'),
(14, 'John', 'Grisham'),
(15, 'Mark', 'Twain'),
(16, 'William', 'Shakespeare'),
(17, 'Margaret', 'Atwood'),
(18, 'Khaled', 'Hosseini'),
(19, 'John', 'Green'),
(20, 'Cormac', 'McCarthy');
#-----------------------------
# AUTHOR
#-----------------------------


#-----------------------------
# BOOK
#-----------------------------
create table BOOK(
    id int unsigned not null auto_increment,
    title varchar(100) not null,
    pubYear smallint unsigned,
    amount tinyint unsigned default 0,
    primary key (id)
);

insert into BOOK values
(1, 'Dark Matter', 2016, 1),
(2, 'Harry Potter and the Philosopher\'s Stone', 1997, 4),
(3, 'Harry Potter and the Chamber of Secrets', 1998, 5),
(4, 'Harry Potter and the Prisoner of Azkaban', 1999, 3),
(5, 'Harry Potter and the Goblet of Fire', 2000, 1),
(6, 'Harry Potter and the Order of the Phoenix', 2003, 1),
(7, 'Harry Potter and the Half-Blood Prince', 2005, 1),
(8, 'Harry Potter and the Deathly Hallows', 2007, 1),
(9, 'The Girl With the Dragon Tattoo', 2005, 1),
(10, 'The Girl Who Kicked the Hornet\'s Nest', 2006, 9),
(11, 'The Girl Who Played With Fire', 2007, 1);
#-----------------------------
# BOOK
#-----------------------------


#-----------------------------
# WRITES
#-----------------------------
create table WRITES(
    authorID int unsigned not null,
    bookID int unsigned not null,
    foreign key (authorID) references AUTHOR(id) 
        on delete cascade 
        on update cascade,
    foreign key (bookID) references BOOK(id) 
        on delete cascade
        on update cascade,
    primary key (authorID, bookID)
);

insert into WRITES values
(1, 2),
(2, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(7, 9),
(7, 10),
(7, 11);
#-----------------------------
# WRITES
#-----------------------------


#-----------------------------
# GENRE
#-----------------------------
create table GENRE(
    name varchar(35) not null,
    primary key (name)
);

insert into GENRE values
('fantasy'),
('crime'),
('biography'),
('young adult'),
('science fiction'),
('romance'),
('horror'),
('mystery'),
('thriller');
#-----------------------------
# GENRE
#-----------------------------


#-----------------------------
# ASSIGNS
#-----------------------------
create table ASSIGNS(
    genreName varchar(35) not null,
    bookID int unsigned not null,
    foreign key (genreName) references GENRE(name)
        on delete cascade
        on update cascade,
    foreign key (bookID) references BOOK(id)
        on delete cascade
        on update cascade,
    primary key (genreName, bookID)
);

insert into ASSIGNS values
('fantasy', 1),
('fantasy', 2),
('romance', 3),
('mystery', 4),
('thriller', 4),
('mystery', 5),
('thriller', 5),
('mystery', 6),
('thriller', 6),
('fantasy', 7),
('crime', 8),
('horror', 9),
('fantasy', 9);
#-----------------------------
# ASSIGNS
#-----------------------------


#-----------------------------
# BORROWER
#-----------------------------
create table BORROWER(
    id int unsigned not null auto_increment,
    fName varchar(35),
    lName varchar(45) not null,
    email varchar(35) not null,
    phone varchar(15),
    street varchar(30),
    city varchar(30),
    prov enum('NL', 'PE', 'NS', 'NB', 'QC', 'ON', 'MB', 'SK', 'AB', 'BC', 'YT', 'NT', 'NU'),
    postalCode varchar(10),
    primary key (id)
);

insert into BORROWER values
(1, 'Michael', 'Scott', 'michael.scott@dunder.ca', '123-4567', '123', 'Lethbridge', 'AB', 'A1B2C3'),
(2, 'Dwight', 'Schrute', 'dwight.shrute@dunder.ca', '456-4444', 'Unit 3, 45 St.', 'Lethbridge', 'AB', '122ABB'),
(3, 'Jim', 'Halpert', 'jim.halpert@dunder.ca', '123-9999', '444', 'Vancouver', 'BC', '444GGG');
#-----------------------------
# BORROWER
#-----------------------------


#-----------------------------
# RENTAL
#-----------------------------
create table RENTAL(
    bookID int unsigned not null,
    borrowerID int unsigned not null,
    rentalDate date not null,
    dueDate date,
    foreign key (bookID) references BOOK(id)
        on delete restrict
        on update cascade,
    foreign key (borrowerID) references BORROWER(id)
        on delete restrict
        on update cascade,
    primary key (bookID, borrowerID, rentalDate)
);

insert into RENTAL values
(1, 1, '2021-10-08', '2021-10-15'),
(2, 1, '2021-10-08', '2021-10-15'),
(1, 2, '2021-10-08', '2021-10-15');
#-----------------------------
# RENTAL
#-----------------------------