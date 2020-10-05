SELECT *
FROM user;

-- Categories Table --
CREATE TABLE Categories (
    id int,
    name varchar(50),
    slug varchar(50),
    PRIMARY KEY (id)

);

-- Threads Table --
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

-- Messages many-to-many table --
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
ALTER TABLE posts ADD FOREIGN KEY (user_id_id) REFERENCES user(id);
ALTER TABLE messages ADD FOREIGN KEY (to_user_id) REFERENCES user(id);
ALTER TABLE threaduserfollows ADD FOREIGN KEY (user_id) REFERENCES user(id);
ALTER TABLE posts ADD FOREIGN KEY (user_id_id) REFERENCES user(id);
ALTER TABLE threaduserfollows ADD FOREIGN KEY (user_id) REFERENCES user(id);
ALTER TABLE messages ADD PRIMARY KEY (id);
ALTER TABLE messages ADD FOREIGN KEY (to_user_id) REFERENCES user(id);
ALTER TABLE messages ADD FOREIGN KEY (from_user_id) REFERENCES user(id);



