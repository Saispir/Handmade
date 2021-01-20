create database if not exists hm;
use hm;
create table author
(
    id    int auto_increment
        primary key,
    fio   varchar(100) not null,
    phone varchar(20)  not null,
    email varchar(50)  not null
);

create table customer
(
    id    int auto_increment
        primary key,
    fio   varchar(100) not null,
    phone varchar(20)  not null,
    email varchar(50)  not null
);

create table customer_order
(
    adress      varchar(255)                                                not null,
    status      enum ('waiting', 'payed') default '_utf8mb4\\''waiting\\''' not null,
    customer_id int                                                         not null,
    constraint customer_order_ibfk_1
        foreign key (customer_id) references customer (id)
            on update cascade on delete cascade
);

create index customer_id
    on customer_order (customer_id);

create table maden
(
    id        int auto_increment
        primary key,
    price     int                                                            not null,
    m_name    varchar(30)                                                    not null,
    pic       longblob                                                       not null,
    status    enum ('available', 'sold') default '_utf8mb4\\''available\\''' not null,
    author_id int                                                            not null,
    constraint maden_ibfk_1
        foreign key (author_id) references author (id)
            on update cascade
);

create table customer_maden
(
    customer_id int not null,
    maden_id    int not null,
    constraint customer_maden_ibfk_1
        foreign key (customer_id) references customer (id)
            on update cascade on delete cascade,
    constraint customer_maden_ibfk_2
        foreign key (maden_id) references maden (id)
            on update cascade
);

create index customer_id
    on customer_maden (customer_id);

create index maden_id
    on customer_maden (maden_id);

create index author_id
    on maden (author_id);

create table material
(
    id     int auto_increment
        primary key,
    m_name varchar(30) not null
);

create table material_maden
(
    usage_amount int default 0 not null,
    maden_id     int           not null,
    material_id  int           not null,
    constraint material_maden_ibfk_1
        foreign key (maden_id) references maden (id)
            on update cascade,
    constraint material_maden_ibfk_2
        foreign key (material_id) references material (id)
            on update cascade
);

create index maden_id
    on material_maden (maden_id);

create index material_id
    on material_maden (material_id);

