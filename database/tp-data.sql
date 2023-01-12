create table categories
(
    id   int auto_increment
        primary key,
    name varchar(255) not null
);

create table users
(
    id              int auto_increment
        primary key,
    username        varchar(255)               not null,
    email           varchar(255)               not null,
    hashed_password varchar(1000)              null,
    created_at      datetime default curtime() not null,
    constraint users_uc
        unique (username, email)
);

create table projects
(
    id          int auto_increment
        primary key,
    name        varchar(255)               not null,
    description varchar(255)               null,
    created_at  datetime default curtime() not null,
    owner_id    int                        not null,
    constraint projects_users_id_fk
        foreign key (owner_id) references users (id)
            on delete cascade
);

create table expenses
(
    id          int auto_increment
        primary key,
    title       varchar(255)           not null,
    description varchar(255)           null,
    image_url   varchar(1000)          null,
    date        date default curdate() not null,
    amount      float                  not null,
    project_id  int                    not null,
    payer_id    int                    null,
    category_id int                    null,
    constraint expenses_categories_id_fk
        foreign key (category_id) references categories (id)
            on delete set null,
    constraint expenses_projects_id_fk
        foreign key (project_id) references projects (id)
            on delete cascade,
    constraint expenses_users_id_fk
        foreign key (payer_id) references users (id)
            on delete set null
);

create table expense_users
(
    id         int auto_increment
        primary key,
    expense_id int   not null,
    user_id    int   not null,
    percentage int   null,
    amount     float null,
    constraint expense_users_expenses_id_fk
        foreign key (expense_id) references expenses (id),
    constraint expense_users_users_id_fk
        foreign key (user_id) references users (id)
);

create table project_users
(
    project_id int not null,
    user_id    int not null,
    primary key (project_id, user_id),
    constraint project_users_projects_id_fk
        foreign key (project_id) references projects (id),
    constraint project_users_users_id_fk
        foreign key (user_id) references users (id)
);

