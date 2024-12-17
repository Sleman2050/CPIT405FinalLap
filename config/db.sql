
CREATE DATABASE bookmark_db;
USE bookmark_db;


CREATE TABLE Bookmark (
    id INT NOT NULL AUTO_INCREMENT,
    URL VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);


INSERT INTO Bookmark (URL, title) VALUES ('https://youtube.com', 'Youtube');
INSERT INTO Bookmark (URL, title) VALUES ('https://google.com', 'Google');
INSERT INTO Bookmark (URL, title) VALUES ('Facebook', 'Facebook');