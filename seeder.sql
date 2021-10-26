# drop library_management db if it exists
DROP DATABASE IF EXISTS library;

# create library_management db if it exists
CREATE DATABASE IF NOT EXISTS library;

# use database
USE library;

# drop all tables
DROP TABLE IF EXISTS AUTHOR;
DROP TABLE IF EXISTS BOOK;
DROP TABLE IF EXISTS WRITES;
DROP TABLE IF EXISTS BORROWER;
DROP TABLE IF EXISTS RENTAL;

# create tables

#-----------------------------
# AUTHOR
#-----------------------------
CREATE TABLE AUTHOR(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    fName VARCHAR(35),
    lName VARCHAR(45) NOT NULL,
    UNIQUE (fName, lName),
    PRIMARY KEY (id)
);

INSERT INTO AUTHOR VALUES
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
CREATE TABLE BOOK(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    pubYear SMALLINT UNSIGNED,
    amount TINYINT UNSIGNED DEFAULT 0,
    PRIMARY KEY (id)
);

INSERT INTO BOOK VALUES
(1, 'Dark Matter', 2016, 1),
(2, 'Harry Potter and the Philosopher\'s Stone', 1997, 1),
(3, 'Harry Potter and the Chamber of Secrets', 1998, 1),
(4, 'Harry Potter and the Prisoner of Azkaban', 1999, 1),
(5, 'Harry Potter and the Goblet of Fire', 2000, 1),
(6, 'Harry Potter and the Order of the Phoenix', 2003, 1),
(7, 'Harry Potter and the Half-Blood Prince', 2005, 1),
(8, 'Harry Potter and the Deathly Hallows', 2007, 1),
(9, 'The Girl With the Dragon Tattoo', 2005, 1),
(10, 'The Girl Who Kicked the Hornet\'s Nest', 2006, 1),
(11, 'The Girl Who Played With Fire', 2007, 1);
#-----------------------------
# BOOK
#-----------------------------


#-----------------------------
# WRITES
#-----------------------------
CREATE TABLE WRITES(
    authorID INT UNSIGNED NOT NULL,
    bookID INT UNSIGNED NOT NULL,
    FOREIGN KEY (authorID) REFERENCES AUTHOR(id),
    FOREIGN KEY (bookID) REFERENCES BOOK(id),
    PRIMARY KEY (authorID, bookID)
);

INSERT INTO WRITES VALUES
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
CREATE TABLE GENRE(
    name VARCHAR(35) NOT NULL,
    PRIMARY KEY (name)
);

INSERT INTO GENRE VALUES
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
CREATE TABLE ASSIGNS(
    genreName VARCHAR(35) NOT NULL,
    bookID INT UNSIGNED NOT NULL,
    FOREIGN KEY (genreName) REFERENCES GENRE(name),
    FOREIGN KEY (bookID) REFERENCES BOOK(id),
    PRIMARY KEY (genreName, bookID)
);

INSERT INTO ASSIGNS VALUES
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
CREATE TABLE BORROWER(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    fName VARCHAR(35),
    lName VARCHAR(45) NOT NULL,
    email VARCHAR(35) NOT NULL,
    phone VARCHAR(15),
    street VARCHAR(30),
    city VARCHAR(30),
    prov ENUM('NL', 'PE', 'NS', 'NB', 'QC', 'ON', 'MB', 'SK', 'AB', 'BC', 'YT', 'NT', 'NU'),
    postalCode VARCHAR(10),
    PRIMARY KEY (id)
);

INSERT INTO BORROWER VALUES
(1, 'Michael', 'Scott', 'michael.scott@dunder.ca', '123-4567', '123', 'Lethbridge', 'AB', 'A1B2C3'),
(2, 'Dwight', 'Schrute', 'dwight.shrute@dunder.ca', '456-4444', 'Unit 3, 45 St.', 'Lethbridge', 'AB', '122ABB'),
(3, 'Jim', 'Halpert', 'jim.halpert@dunder.ca', '123-9999', '444', 'Vancouver', 'BC', '444GGG');
#-----------------------------
# BORROWER
#-----------------------------


#-----------------------------
# RENTAL
#-----------------------------
CREATE TABLE RENTAL(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    bookID INT UNSIGNED NOT NULL,
    borrowerID INT UNSIGNED NOT NULL,
    rentalDate DATE,
    dueDate DATE,
    PRIMARY KEY (id)
);
#-----------------------------
# RENTAL
#-----------------------------