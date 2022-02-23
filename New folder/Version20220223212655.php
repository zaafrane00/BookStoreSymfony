<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223212655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F993DA5256D');
        $this->addSql('DROP INDEX UNIQ_AC634F993DA5256D ON livre');
        $this->addSql('ALTER TABLE livre ADD image VARCHAR(255) DEFAULT NULL, DROP image_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre ADD image_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F993DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC634F993DA5256D ON livre (image_id)');
    }
}
