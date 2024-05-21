<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240512152205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE `comment` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `blog_id` int(11) NOT NULL,
            `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
            PRIMARY KEY (`id`),
            KEY `IDX_9474526CDAE07E97` (`blog_id`),
            CONSTRAINT `FK_9474526CDAE07E97` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE comment');
    }
}
