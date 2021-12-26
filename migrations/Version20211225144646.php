<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225144646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9968F33964');
        $this->addSql('DROP TABLE bib');
        $this->addSql('DROP INDEX IDX_AC634F9968F33964 ON livre');
        $this->addSql('ALTER TABLE livre DROP bib_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bib (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livre ADD bib_id INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9968F33964 FOREIGN KEY (bib_id) REFERENCES bib (id)');
        $this->addSql('CREATE INDEX IDX_AC634F9968F33964 ON livre (bib_id)');
    }
}
