
-- Table structure for table `delivery_point`

create table delivery_point
(
    id        int auto_increment
        primary key,
    name      varchar(50)  null,
    address_1 varchar(50)  null,
    address_2 varchar(50)  null,
    postcode  varchar(16)  null,
    deliverer int          null,
    lat       double       null,
    `long`    double       null,
    status    int          null,
    del_photo varchar(100) null,
    constraint delivery_point_delivery_status_id_fk
        foreign key (status) references delivery_status (id),
    constraint delivery_point_delivery_users_userid_fk
        foreign key (deliverer) references delivery_users (userid)
);

-- Table structure for table `delivery_status`

create table delivery_status
(
    id          int auto_increment
        primary key,
    status_code int         not null,
    status_text varchar(50) null,
    constraint delivery_status_pk2
        unique (id),
    constraint delivery_status_pk3
        unique (status_code)
);

-- Table structure for table `delivery_users`

create table delivery_users
(
    userid   int auto_increment
        primary key,
    username varchar(25)  not null,
    password varchar(255) null,
    usertype int          not null,
    realname varchar(50)  null,
    email    varchar(250) null,
    constraint delivery_users_pk2
        unique (userid),
    constraint delivery_users_pk3
        unique (username)
);

create index delivery_users_delivery_usertype_id_fk
    on delivery_users (usertype);

-- Table structure for table `delivery_usertype`

create table delivery_usertype
(
    id           int auto_increment
        primary key,
    usertypename enum ('admin', 'user') null,
    constraint delivery_usertype_pk2
        unique (id)
);