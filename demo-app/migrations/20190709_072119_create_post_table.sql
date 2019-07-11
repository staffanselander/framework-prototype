create table if not exists post (
    id int(10) unsigned not null auto_increment,
    title varchar(255) not null,
    content text not null,
    primary key (id)
)
