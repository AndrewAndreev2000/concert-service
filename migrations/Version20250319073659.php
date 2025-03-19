<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319073659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_city (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_concert (id SERIAL NOT NULL, city_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3821829F989D9B62 ON app_concert (slug)');
        $this->addSql('CREATE INDEX IDX_3821829F8BAC62AF ON app_concert (city_id)');
        $this->addSql('CREATE TABLE app_redirect_rule (id SERIAL NOT NULL, concert_id INT NOT NULL, redirect_url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_83C3141083C97B2E ON app_redirect_rule (concert_id)');
        $this->addSql('CREATE TABLE app_rule (id SERIAL NOT NULL, city_id INT NOT NULL, redirectRule INT NOT NULL, type VARCHAR(255) NOT NULL, start_date_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_date_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_43F6896CC88C6231 ON app_rule (redirectRule)');
        $this->addSql('CREATE INDEX IDX_43F6896C8BAC62AF ON app_rule (city_id)');
        $this->addSql('CREATE TABLE app_user (id SERIAL NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9E7927C74 ON app_user (email)');
        $this->addSql('ALTER TABLE app_concert ADD CONSTRAINT FK_3821829F8BAC62AF FOREIGN KEY (city_id) REFERENCES app_city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_redirect_rule ADD CONSTRAINT FK_83C3141083C97B2E FOREIGN KEY (concert_id) REFERENCES app_concert (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_rule ADD CONSTRAINT FK_43F6896CC88C6231 FOREIGN KEY (redirectRule) REFERENCES app_redirect_rule (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_rule ADD CONSTRAINT FK_43F6896C8BAC62AF FOREIGN KEY (city_id) REFERENCES app_city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE app_concert DROP CONSTRAINT FK_3821829F8BAC62AF');
        $this->addSql('ALTER TABLE app_redirect_rule DROP CONSTRAINT FK_83C3141083C97B2E');
        $this->addSql('ALTER TABLE app_rule DROP CONSTRAINT FK_43F6896CC88C6231');
        $this->addSql('ALTER TABLE app_rule DROP CONSTRAINT FK_43F6896C8BAC62AF');
        $this->addSql('DROP TABLE app_city');
        $this->addSql('DROP TABLE app_concert');
        $this->addSql('DROP TABLE app_redirect_rule');
        $this->addSql('DROP TABLE app_rule');
        $this->addSql('DROP TABLE app_user');
    }
}
