<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240311212046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE blog ADD status VARCHAR(255) DEFAULT "pending"');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE blog DROP status');
    }
}
