<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231223062833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE tags_to_blog (blog_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_147AB9DDAE07E97 (blog_id), PRIMARY KEY(blog_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tags_to_blog ADD CONSTRAINT FK_147AB9DDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE tags_to_blog ADD CONSTRAINT FK_147AB9DBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE tags_to_blog DROP FOREIGN KEY FK_147AB9DDAE07E97');
        $this->addSql('ALTER TABLE tags_to_blog DROP FOREIGN KEY FK_147AB9DBAD26311');
        $this->addSql('DROP TABLE tags_to_blog');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
