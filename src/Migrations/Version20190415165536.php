<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190415165536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE arrivals (id INT AUTO_INCREMENT NOT NULL, villed_ariver VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flights ADD arrivals_id INT DEFAULT NULL, DROP arrivals');
        $this->addSql('ALTER TABLE flights ADD CONSTRAINT FK_FC74B5EAE9C84D80 FOREIGN KEY (arrivals_id) REFERENCES arrivals (id)');
        $this->addSql('CREATE INDEX IDX_FC74B5EAE9C84D80 ON flights (arrivals_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flights DROP FOREIGN KEY FK_FC74B5EAE9C84D80');
        $this->addSql('DROP TABLE arrivals');
        $this->addSql('DROP INDEX IDX_FC74B5EAE9C84D80 ON flights');
        $this->addSql('ALTER TABLE flights ADD arrivals VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP arrivals_id');
    }
}
