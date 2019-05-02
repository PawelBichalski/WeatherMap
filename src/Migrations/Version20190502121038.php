<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502121038 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_3370691A8BAC62AF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather_data AS SELECT id, city_id, temperature, clouds, wind, description, date, latitude, longitude FROM weather_data');
        $this->addSql('DROP TABLE weather_data');
        $this->addSql('CREATE TABLE weather_data (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id BIGINT NOT NULL, temperature NUMERIC(5, 2) NOT NULL, clouds SMALLINT NOT NULL, wind NUMERIC(5, 2) NOT NULL, description VARCHAR(255) NOT NULL COLLATE BINARY, date DATETIME NOT NULL, coordinates_latitude NUMERIC(12, 8) NOT NULL, coordinates_longitude NUMERIC(12, 8) NOT NULL, CONSTRAINT FK_3370691A8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO weather_data (id, city_id, temperature, clouds, wind, description, date, coordinates_latitude, coordinates_longitude) SELECT id, city_id, temperature, clouds, wind, description, date, latitude, longitude FROM __temp__weather_data');
        $this->addSql('DROP TABLE __temp__weather_data');
        $this->addSql('CREATE INDEX IDX_3370691A8BAC62AF ON weather_data (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_3370691A8BAC62AF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather_data AS SELECT id, city_id, temperature, clouds, wind, description, date FROM weather_data');
        $this->addSql('DROP TABLE weather_data');
        $this->addSql('CREATE TABLE weather_data (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id BIGINT NOT NULL, temperature NUMERIC(5, 2) NOT NULL, clouds SMALLINT NOT NULL, wind NUMERIC(5, 2) NOT NULL, description VARCHAR(255) NOT NULL, date DATETIME NOT NULL, longitude NUMERIC(12, 8) NOT NULL, latitude NUMERIC(12, 8) NOT NULL)');
        $this->addSql('INSERT INTO weather_data (id, city_id, temperature, clouds, wind, description, date) SELECT id, city_id, temperature, clouds, wind, description, date FROM __temp__weather_data');
        $this->addSql('DROP TABLE __temp__weather_data');
        $this->addSql('CREATE INDEX IDX_3370691A8BAC62AF ON weather_data (city_id)');
    }
}
