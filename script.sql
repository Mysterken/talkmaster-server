SELECT 'CREATE DATABASE talks_database' WHERE NOT EXISTS (SELECT * FROM pg_database WHERE datname = 'talks_database')\gexec

CREATE TABLE IF NOT EXISTS UsersTalk (
    id int NOT NULL,
    name varchar(32),
    last_name varchar(32),
    email varchar(100),
    token varchar(100),
    roles json,
    CONSTRAINT PK_UsersTalk PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS Rooms (
    id int NOT NULL,
    room_number int,
    number_places int,
    CONSTRAINT PK_Rooms PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS Talks (
    id int NOT NULL,
    title varchar(50),
    content text,
    day int,
    moment int,
    state varchar(50),
    user_id int,
    room_id int,
    CONSTRAINT PK_Talks PRIMARY KEY (id),
    CONSTRAINT FK_UserTalk FOREIGN KEY (user_id) REFERENCES UsersTalk(id),
    CONSTRAINT FK_RoomTalk FOREIGN KEY (room_id) REFERENCES Rooms(id)
);
