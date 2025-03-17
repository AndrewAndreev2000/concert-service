<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317080544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_city (id SERIAL NOT NULL, region_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2875279498260155 ON app_city (region_id)');
        $this->addSql('CREATE TABLE app_concert (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_app_concert_slug ON app_concert (slug)');
        $this->addSql('CREATE TABLE app_country (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_app_country_code ON app_country (code)');
        $this->addSql('CREATE TABLE app_redirect_rule (id SERIAL NOT NULL, concert_id INT NOT NULL, redirect_url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_83C3141083C97B2E ON app_redirect_rule (concert_id)');
        $this->addSql('CREATE TABLE app_region (id SERIAL NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EA619CF6F92F3E70 ON app_region (country_id)');
        $this->addSql('CREATE TABLE app_rule (id SERIAL NOT NULL, redirectRule INT NOT NULL, type VARCHAR(255) NOT NULL, start_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, end_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, start_date_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_date_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, radius DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_43F6896CC88C6231 ON app_rule (redirectRule)');
        $this->addSql('CREATE TABLE app_location_rule_country (location_rule_id INT NOT NULL, country_id INT NOT NULL, PRIMARY KEY(location_rule_id, country_id))');
        $this->addSql('CREATE INDEX IDX_CA1CB7439A0B10F5 ON app_location_rule_country (location_rule_id)');
        $this->addSql('CREATE INDEX IDX_CA1CB743F92F3E70 ON app_location_rule_country (country_id)');
        $this->addSql('CREATE TABLE app_location_rule_region (location_rule_id INT NOT NULL, region_id INT NOT NULL, PRIMARY KEY(location_rule_id, region_id))');
        $this->addSql('CREATE INDEX IDX_694D6E759A0B10F5 ON app_location_rule_region (location_rule_id)');
        $this->addSql('CREATE INDEX IDX_694D6E7598260155 ON app_location_rule_region (region_id)');
        $this->addSql('CREATE TABLE app_location_rule_city (location_rule_id INT NOT NULL, city_id INT NOT NULL, PRIMARY KEY(location_rule_id, city_id))');
        $this->addSql('CREATE INDEX IDX_505B404D9A0B10F5 ON app_location_rule_city (location_rule_id)');
        $this->addSql('CREATE INDEX IDX_505B404D8BAC62AF ON app_location_rule_city (city_id)');
        $this->addSql('ALTER TABLE app_city ADD CONSTRAINT FK_2875279498260155 FOREIGN KEY (region_id) REFERENCES app_region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_redirect_rule ADD CONSTRAINT FK_83C3141083C97B2E FOREIGN KEY (concert_id) REFERENCES app_concert (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_region ADD CONSTRAINT FK_EA619CF6F92F3E70 FOREIGN KEY (country_id) REFERENCES app_country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_rule ADD CONSTRAINT FK_43F6896CC88C6231 FOREIGN KEY (redirectRule) REFERENCES app_redirect_rule (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_location_rule_country ADD CONSTRAINT FK_CA1CB7439A0B10F5 FOREIGN KEY (location_rule_id) REFERENCES app_rule (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_location_rule_country ADD CONSTRAINT FK_CA1CB743F92F3E70 FOREIGN KEY (country_id) REFERENCES app_country (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_location_rule_region ADD CONSTRAINT FK_694D6E759A0B10F5 FOREIGN KEY (location_rule_id) REFERENCES app_rule (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_location_rule_region ADD CONSTRAINT FK_694D6E7598260155 FOREIGN KEY (region_id) REFERENCES app_region (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_location_rule_city ADD CONSTRAINT FK_505B404D9A0B10F5 FOREIGN KEY (location_rule_id) REFERENCES app_rule (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_location_rule_city ADD CONSTRAINT FK_505B404D8BAC62AF FOREIGN KEY (city_id) REFERENCES app_city (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE app_city DROP CONSTRAINT FK_2875279498260155');
        $this->addSql('ALTER TABLE app_redirect_rule DROP CONSTRAINT FK_83C3141083C97B2E');
        $this->addSql('ALTER TABLE app_region DROP CONSTRAINT FK_EA619CF6F92F3E70');
        $this->addSql('ALTER TABLE app_rule DROP CONSTRAINT FK_43F6896CC88C6231');
        $this->addSql('ALTER TABLE app_location_rule_country DROP CONSTRAINT FK_CA1CB7439A0B10F5');
        $this->addSql('ALTER TABLE app_location_rule_country DROP CONSTRAINT FK_CA1CB743F92F3E70');
        $this->addSql('ALTER TABLE app_location_rule_region DROP CONSTRAINT FK_694D6E759A0B10F5');
        $this->addSql('ALTER TABLE app_location_rule_region DROP CONSTRAINT FK_694D6E7598260155');
        $this->addSql('ALTER TABLE app_location_rule_city DROP CONSTRAINT FK_505B404D9A0B10F5');
        $this->addSql('ALTER TABLE app_location_rule_city DROP CONSTRAINT FK_505B404D8BAC62AF');
        $this->addSql('DROP TABLE app_city');
        $this->addSql('DROP TABLE app_concert');
        $this->addSql('DROP TABLE app_country');
        $this->addSql('DROP TABLE app_redirect_rule');
        $this->addSql('DROP TABLE app_region');
        $this->addSql('DROP TABLE app_rule');
        $this->addSql('DROP TABLE app_location_rule_country');
        $this->addSql('DROP TABLE app_location_rule_region');
        $this->addSql('DROP TABLE app_location_rule_city');
    }
}
