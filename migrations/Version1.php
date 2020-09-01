<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version1 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, fullname VARCHAR(255) NOT NULL, reset_token VARCHAR(255) DEFAULT NULL, disabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE logs (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, user_id INT NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ip VARCHAR(15) NOT NULL, success BOOLEAN NOT NULL, reason VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');

        $this->addSql('CREATE SEQUENCE Antecedent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE document_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pathologie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE patient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE Antecedent (id INT NOT NULL, patient_id INT NOT NULL, label VARCHAR(255) NOT NULL, commentaire TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_366F16A06B899279 ON Antecedent (patient_id)');
        $this->addSql('CREATE TABLE document (id INT NOT NULL, patient_id INT NOT NULL, label VARCHAR(255) NOT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8698A766B899279 ON document (patient_id)');
        $this->addSql('CREATE TABLE pathologie (id INT NOT NULL, patient_id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CCC2BDEB6B899279 ON pathologie (patient_id)');
        $this->addSql('CREATE TABLE patient (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, sexe VARCHAR(1) NOT NULL, secu VARCHAR(15) DEFAULT NULL, adresse TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE Antecedent ADD CONSTRAINT FK_366F16A06B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A766B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pathologie ADD CONSTRAINT FK_CCC2BDEB6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE logs');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE Antecedent DROP CONSTRAINT FK_366F16A06B899279');
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A766B899279');
        $this->addSql('ALTER TABLE pathologie DROP CONSTRAINT FK_CCC2BDEB6B899279');
        $this->addSql('DROP SEQUENCE Antecedent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE document_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pathologie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE patient_id_seq CASCADE');
        $this->addSql('DROP TABLE Antecedent');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE pathologie');
        $this->addSql('DROP TABLE patient');
    }
}
