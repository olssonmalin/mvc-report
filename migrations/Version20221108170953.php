<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108170953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, isbn VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, release_date DATETIME DEFAULT NULL, img VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, language VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE completed_residences (id INT AUTO_INCREMENT NOT NULL, year_id INT NOT NULL, region_id INT NOT NULL, type VARCHAR(255) NOT NULL, amount INT NOT NULL, INDEX IDX_42889C9640C1FEA7 (year_id), INDEX IDX_42889C9698260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE population_station (id INT AUTO_INCREMENT NOT NULL, year_id INT NOT NULL, region_id INT NOT NULL, distance INT NOT NULL, urban VARCHAR(255) NOT NULL, amount INT DEFAULT NULL, INDEX IDX_B22F246740C1FEA7 (year_id), INDEX IDX_B22F246798260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE residence_station (id INT AUTO_INCREMENT NOT NULL, year_id INT DEFAULT NULL, region_id INT DEFAULT NULL, distance INT NOT NULL, stock VARCHAR(255) NOT NULL, amount INT NOT NULL, INDEX IDX_D1BB94F740C1FEA7 (year_id), INDEX IDX_D1BB94F798260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE year (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE completed_residences ADD CONSTRAINT FK_42889C9640C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE completed_residences ADD CONSTRAINT FK_42889C9698260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE population_station ADD CONSTRAINT FK_B22F246740C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE population_station ADD CONSTRAINT FK_B22F246798260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE residence_station ADD CONSTRAINT FK_D1BB94F740C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE residence_station ADD CONSTRAINT FK_D1BB94F798260155 FOREIGN KEY (region_id) REFERENCES region (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE completed_residences DROP FOREIGN KEY FK_42889C9698260155');
        $this->addSql('ALTER TABLE population_station DROP FOREIGN KEY FK_B22F246798260155');
        $this->addSql('ALTER TABLE residence_station DROP FOREIGN KEY FK_D1BB94F798260155');
        $this->addSql('ALTER TABLE completed_residences DROP FOREIGN KEY FK_42889C9640C1FEA7');
        $this->addSql('ALTER TABLE population_station DROP FOREIGN KEY FK_B22F246740C1FEA7');
        $this->addSql('ALTER TABLE residence_station DROP FOREIGN KEY FK_D1BB94F740C1FEA7');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE completed_residences');
        $this->addSql('DROP TABLE population_station');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE residence_station');
        $this->addSql('DROP TABLE year');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
