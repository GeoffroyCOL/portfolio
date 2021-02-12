<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210212195508 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD image VARCHAR(255) NOT NULL, ADD updated_at DATETIME NOT NULL, DROP extension');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE2B36786B ON project (title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E3DE4775E237E06 ON skill (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD extension VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP image, DROP updated_at');
        $this->addSql('DROP INDEX UNIQ_2FB3D0EE2B36786B ON project');
        $this->addSql('DROP INDEX UNIQ_5E3DE4775E237E06 ON skill');
    }
}
