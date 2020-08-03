create table users
(
    id         int auto_increment
        primary key,
    name       varchar(255)                       not null,
    email      varchar(255)                       not null,
    password   varchar(255)                       not null,
    created_at datetime default CURRENT_TIMESTAMP not null
);

create table hosts
(
    hostname     varchar(100) not null,
    date         varchar(100) not null,
    os           varchar(200) not null,
    architecture varchar(6)   not null,
    id           int          not null,
    constraint FK_31
        foreign key (id) references users (id)
);

create index fkIdx_31
    on hosts (id);

create table tasks
(
    id         int(16) auto_increment
        primary key,
    hostname   varchar(100) not null,
    action     varchar(20)  not null,
    parameters text         not null,
    output     text         null,
    status     varchar(7)   null,
    user_id    int          not null,
    constraint FK_69
        foreign key (user_id) references users (id)
);

create index fkIdx_69
    on tasks (user_id);

