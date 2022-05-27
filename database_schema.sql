
create database php_db_prova;
use php_db_prova;

create table users(
    id integer primary key auto_increment,
    username varchar(100) unique,
    password varchar(255),
    name varchar(100),
    surname varchar(100),
    email varchar(255) unique,
    propic longtext default 'img/utenteStd.png'
)Engine = 'InnoDB';

INSERT INTO users (id, username, password, name, surname, email, propic) VALUES (1, 'utente1', 'secret', 'admin_name', 'admin_surname', 'admin@gmail.com', 'https://images.unsplash.com/photo-1617654112368-307921291f42?crop=entropy');
INSERT INTO users (id, username, password, name, surname, email, propic) VALUES (28, 'ciaociao', 'danieledaniele', 'ciao', 'mario', 'ciao@gmail.com', 'img/utenteStd.png');
INSERT INTO users (id, username, password, name, surname, email, propic) VALUES (33, 'danieleanza', 'provadaniele', 'daniele', 'leanza', 'daniele@gmail.com', 'img/utenteStd.png');

create table admins(
    id integer,
    admin_email varchar(255),
    foreign key(id) references users(id) ON DELETE CASCADE,
    primary key(id)
)Engine='InnoDB';

INSERT INTO admins (id, admin_email) VALUES (1, 'admin@gmail.com');
INSERT INTO admins (id, admin_email) VALUES (28, 'ciao@gmail.com');

create table posts(
    id integer primary key auto_increment,
    author integer NOT NULL,
    content text NOT NULL,
    likes integer DEFAULT 0,
    foreign key(author) references admins(id)
)Engine = "InnoDB";

INSERT INTO posts (id, author, content, likes) VALUES (1, 28, 'ciao prova post', 2);
INSERT INTO posts (id, author, content, likes) VALUES (2, 1, 'prova pubblicazione post', 1);

create table liked(
    post integer not null,
    user integer not null,
    foreign key(post) references posts(id) on delete cascade,
    foreign key(user) references users(id) on delete cascade,
    primary key (post,user)
)Engine = "InnoDB";

INSERT INTO liked (post, user) VALUES (1, 28);
INSERT INTO liked (post, user) VALUES (1, 33);
INSERT INTO liked (post, user) VALUES (2, 1);

create table commented(
    id integer not null primary key auto_increment,
    post integer not null,
    user integer not null,
    comment text not null,
    foreign key(post) references posts(id) on delete cascade,
    foreign key(user) references users(id) on delete cascade
)Engine = "InnoDB";

INSERT INTO commented (id, post, user, comment) VALUES (1, 1, 33, 'commento prova');
INSERT INTO commented (id, post, user, comment) VALUES (2, 1, 1, 'ciao');
INSERT INTO commented (id, post, user, comment) VALUES (3, 2, 1, 'prova commento 2');


delimiter //
create trigger setLike
    after insert on liked
    for each row
            begin
                UPDATE posts
                SET likes = likes + 1
                where posts.id = new.post; /* USA QUESTA DOPO AVER FATTO LA QUERY DOVREBBE ANDARE */
            end //
delimiter ;


delimiter //
create trigger setDislike
    after delete on liked
    for each row
            begin
                UPDATE posts
                SET likes = likes - 1
                where posts.id = old.post; /* USA QUESTA DOPO AVER FATTO LA QUERY DOVREBBE ANDARE */
            end //
delimiter ;

