<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190415163221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE departures (id INT AUTO_INCREMENT NOT NULL, ville_de_depart VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flights (id INT AUTO_INCREMENT NOT NULL, departures_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, flight_name VARCHAR(255) NOT NULL, flight_number VARCHAR(11) NOT NULL, arrivals VARCHAR(255) NOT NULL, date DATETIME NOT NULL, created_at DATETIME NOT NULL, max_place INT NOT NULL, price INT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_FC74B5EAE651CFD (departures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, address LONGTEXT NOT NULL, city VARCHAR(255) NOT NULL, postal_code INT NOT NULL, phone_number INT NOT NULL, status VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flights ADD CONSTRAINT FK_FC74B5EAE651CFD FOREIGN KEY (departures_id) REFERENCES departures (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flights DROP FOREIGN KEY FK_FC74B5EAE651CFD');
        $this->addSql('DROP TABLE departures');
        $this->addSql('DROP TABLE flights');
        $this->addSql('DROP TABLE user');
    }
}
