
CREATE DATABASE wikis
    DEFAULT CHARACTER SET = 'utf8mb4';


use wikis;

create table users(
    `id` int AUTO_INCREMENT PRIMARY key,
    `name` VARCHAR(255) not null,
    `email` VARCHAR(255) not null UNIQUE,
    `password` VARCHAR(255) not null,
    `role` ENUM('admin', 'author') DEFAULT 'author',
    `photo_src` VARCHAR(255) DEFAULT "/public/images/users/default.webp",
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table categories(
    `id` int AUTO_INCREMENT PRIMARY key,
    `name` VARCHAR(255) not null unique,
    `slogan` VARCHAR(255),
    `photo_src` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table tags(
    `id` int AUTO_INCREMENT PRIMARY key,
    `name` VARCHAR(255) not null unique,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table wikis(
    `id` int AUTO_INCREMENT PRIMARY key,
    `title` VARCHAR(255) not null,
    `content` TEXT not null,
    `photo_src` VARCHAR(255) not null,
    `status` ENUM('pending', 'published') DEFAULT 'pending',
    `author_id` int,
    `category_id` int,
    Foreign Key (`author_id`) REFERENCES users(`id`),
    Foreign Key (`category_id`) REFERENCES categories(`id`),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table wiki_tags(
    `id` int not null,
    `wiki_id` int,
    `tag_id` int,
    Foreign Key (`wiki_id`) REFERENCES wikis(`id`),
    Foreign Key (`tag_id`) REFERENCES tags(`id`),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);