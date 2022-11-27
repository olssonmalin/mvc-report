<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221127181008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, isbn VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, release_date DATETIME DEFAULT NULL, img VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, language VARCHAR(100) DEFAULT NULL)');
        $this->addSql('CREATE TABLE completed_residences (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year_id INTEGER NOT NULL, region_id INTEGER NOT NULL, type VARCHAR(255) NOT NULL, amount INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_42889C9640C1FEA7 ON completed_residences (year_id)');
        $this->addSql('CREATE INDEX IDX_42889C9698260155 ON completed_residences (region_id)');
        $this->addSql('CREATE TABLE population_station (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year_id INTEGER NOT NULL, region_id INTEGER NOT NULL, distance INTEGER NOT NULL, urban VARCHAR(255) NOT NULL, amount INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_B22F246740C1FEA7 ON population_station (year_id)');
        $this->addSql('CREATE INDEX IDX_B22F246798260155 ON population_station (region_id)');
        $this->addSql('CREATE TABLE region (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE residence_station (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year_id INTEGER DEFAULT NULL, region_id INTEGER DEFAULT NULL, distance INTEGER NOT NULL, stock VARCHAR(255) NOT NULL, amount INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_D1BB94F740C1FEA7 ON residence_station (year_id)');
        $this->addSql('CREATE INDEX IDX_D1BB94F798260155 ON residence_station (region_id)');
        $this->addSql('CREATE TABLE year (id INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE completed_residences');
        $this->addSql('DROP TABLE population_station');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE residence_station');
        $this->addSql('DROP TABLE year');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
