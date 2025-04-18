<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250418083737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE hat ADD material_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hat ADD CONSTRAINT FK_920BAC49E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_920BAC49E308AC6F ON hat (material_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hat DROP CONSTRAINT FK_920BAC49E308AC6F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_920BAC49E308AC6F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hat DROP material_id
        SQL);
    }
}
