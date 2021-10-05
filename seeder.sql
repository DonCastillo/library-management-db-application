USE library_management;

DROP TABLE AUTHOR;

CREATE TABLE AUTHOR(
    id int NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(35),
    lastName VARCHAR(45) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO AUTHOR VALUES
(1, 'J.K.', 'Rowling'),
(2, 'J.R.R.', 'Tolkien'),
(3, 'Leo', 'Tolstoy');


-- SELECT firstName FROM AUTHOR where lastName = 'Tolstoy';