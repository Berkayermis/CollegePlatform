SELECT *
FROM Messages_user;

-- Category Table --
CREATE TABLE Categories (
    id int,
    name varchar(50),
    slug varchar(50),
    PRIMARY KEY (id)

);

-- Thread Table --
CREATE TABLE Threads (
    id int,
    name varchar(50),
    slug varchar(50),
    category_id int,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- thread_id foreign key was added into the posts --
ALTER TABLE posts ADD thread_id int;
ALTER TABLE posts ADD FOREIGN KEY (thread_id) REFERENCES threads(id);

-- Message many-to-many table --
CREATE TABLE Messages(
    id int,
    title varchar(40),
    body varchar(250),
    message_date datetime,
    to_user_id int,
    from_user_id int,
    FOREIGN KEY (to_user_id) REFERENCES user(id),
    FOREIGN KEY (from_user_id) REFERENCES user(id)
);

-- category_id fk into the threads from categories --
ALTER TABLE Threads ADD FOREIGN KEY (category_id) REFERENCES Categories(id);

CREATE TABLE ThreadUserFollows (
    id int,
    thread_id int,
    user_id int,
    PRIMARY KEY (id),
    FOREIGN KEY (thread_id) REFERENCES threads(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

SHOW CREATE TABLE posts;

ALTER TABLE posts DROP FOREIGN KEY F ;
ALTER TABLE posts ADD FOREIGN KEY (category_id) REFERENCES categories(id);
ALTER TABLE posts ADD FOREIGN KEY (user_id_id) REFERENCES user(id);
ALTER TABLE messages ADD FOREIGN KEY (to_user_id) REFERENCES user(id);
ALTER TABLE threaduserfollows ADD FOREIGN KEY (user_id) REFERENCES user(id);
ALTER TABLE posts ADD FOREIGN KEY (user_id_id) REFERENCES user(id);
ALTER TABLE threaduserfollows ADD FOREIGN KEY (user_id) REFERENCES user(id);
ALTER TABLE messages ADD PRIMARY KEY (id);
ALTER TABLE messages ADD FOREIGN KEY (to_user_id) REFERENCES user(id);
ALTER TABLE messages ADD FOREIGN KEY (from_user_id) REFERENCES user(id);

INSERT INTO categories VALUES (1,'Üniversite','Üniversite');
INSERT INTO categories VALUES (2,'Kuzey Kampüs','kuzey-kampus');
INSERT INTO categories VALUES (3,'Güney Kampüs','guney-kampus');
INSERT INTO categories VALUES (4,'Haliç Kampüsü','halic-kampus');

UPDATE categories
SET slug = 'universite'
WHERE slug = 'Üniversite';

INSERT INTO threads VALUES (1,'Medipol','medipol',1);
INSERT INTO threads VALUES (2,'Revir Odası','revir-odasi',2);
INSERT INTO threads VALUES (5,'Yemekhane Ücretleri','yemekhane-ucretleri',2);
INSERT INTO threads VALUES (3,'Haliç kampüsü park sorunu','halic-kampusu-park-sorunu',4);
INSERT INTO threads VALUES (4,'Güney kampüsü inşaatı','guney-kampusu-insaati',3);
INSERT INTO threads VALUES (4,'Güney kampüsü inşaatı','guney-kampusu-insaati',3);


ALTER TABLE posts ADD thread_id int;
ALTER TABLE posts ADD FOREIGN KEY (thread_id) REFERENCES threads(id);

INSERT INTO posts VALUES (1,1,'Revir odası body','2020-09-23 12:23:21',2);
INSERT INTO posts VALUES (2,1,'Park body','2020-09-26 12:25:21',3);
INSERT INTO posts VALUES (3,2,'İnşaat body blblb','2020-08-10 11:49:50',4);
INSERT INTO posts VALUES (4,2,'Okul ücretleri','2020-08-10 18:34:32',1);
INSERT INTO posts VALUES (5,2,'Geçen sene 13 lira olan .... ücretler bu sene ....','2020-08-10 18:36:32',5);
INSERT INTO posts VALUES (6,6,'deneme body',sysdate(),3);

INSERT INTO messages VALUES (1,'mesaj','mesaj body','2020-12-12 12:12:12',1,2);

-- ------------------------------------------------------------------ --

-- Bir Thread’in içindeki mesajlar --

SELECT Threads.name FROM threads;

-- Tüm Kategoriler --

SELECT * FROM categories;

-- Tüm Threadler --

SELECT * FROM threads;

-- X Kategorisine ait threadler --

SELECT * FROM threads
WHERE category_id = 2;

-- Tüm userlar --

SELECT * FROM user;

-- X user'ına ait postlar --

SELECT * FROM posts
WHERE posts.user_id_id = 1;

-- X Thread’i içindeki postlar --

SELECT * FROM posts P
WHERE p.thread_id = 3;

-- ------------------------------------------------------------------ --

-- Bugun açılmış threadler --

SELECT * FROM threads
INNER JOIN posts
ON Threads.id = posts.thread_id
WHERE cast(posts.created_date as DATE) = CURDATE();

SELECT cast(NOW() as DATE);

-- Thread’in içindeki postları tarihe göre sıralanmış hali (eskiden yeniye) --

select *
from posts
WHERE thread_id = 3
ORDER BY created_date;

-- Toplam thread sayısı --

SELECT count(*) AS Toplam FROM threads;

-- X User’in Y User’a attığı mesajlar

SELECT * FROM messages
WHERE to_user_id = 1 and from_user_id = 2;

-- X Kategorisindeki bugun açılmış threadler --
SELECT t.*
FROM posts p
INNER JOIN threads t
ON p.thread_id = t.id
WHERE category_id = 4 AND p.created_date = CURDATE()
ORDER BY created_date;

SELECT *
FROM threads
WHERE CAST(created_date as DATE) = CURDATE()
ORDER BY created_date;


-- X User’ın takip ettiği Thread listesi --
SELECT t.*
FROM threads t
INNER JOIN threaduserfollows tuf
    on t.id = tuf.thread_id
WHERE tuf.user_id = 1;


-- ------------------------------------------------------------------ --

-- Threadlerin listesi, içindeki postların sayısı ile birlikte --

SELECT Threads.id,Threads.name , posts.body AS Post_Sayisi
FROM threads
LEFT JOIN posts
ON posts.thread_id = Threads.id;

-- X User’ın post attığı threadler

select t.*
from Threads t
JOIN posts p
ON t.id = p.thread_id
WHERE user_id_id = 2;

-- Bugun içerisine post atılmış threadler

SELECT DISTINCT t.*
FROM Threads t
INNER JOIN posts p
    on t.id = p.thread_id
WHERE cast(p.created_date as DATE) = CAST(NOW() as DATE);


-- En son atılmış post’un tarihine göre sıralanmış Thread listesi

SELECT DISTINCT t.*
from Threads t
INNER JOIN posts p
ON t.id = p.thread_id
ORDER BY p.created_date;

-- En çok post atmış User

SELECT id , MAX(Total_Post) FROM (
              select u.id , COUNT(p.id) AS Total_Post
              from user u
                inner join posts p
                on u.id = p.user_id_id
                GROUP BY u.id
                ORDER BY Total_Post DESC
                  ) UserPostSayilari ;

-- Bu ayki en popüler threadler (bu ay içerisine atılan post sayısına göre popülerlik belli olmalı)

SELECT t.name , COUNT(p.id) AS Total_Post
FROM Threads t
INNER JOIN posts p
    on t.id = p.thread_id
WHERE month(p.created_date) = month(curdate()) AND year(p.created_date) = year(CURDATE())
GROUP BY t.name
ORDER BY Total_Post DESC
LIMIT 10;


DROP TABLE user;