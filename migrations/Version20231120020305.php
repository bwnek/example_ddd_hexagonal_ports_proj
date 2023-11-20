<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120020305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE delegation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE employee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE delegation (id INT NOT NULL, employee_id INT DEFAULT NULL, period_start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, period_end TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, country VARCHAR(2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_292F436D8C03F15C ON delegation (employee_id)');
        $this->addSql('CREATE TABLE employee (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE delegation ADD CONSTRAINT FK_292F436D8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE delegation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE employee_id_seq CASCADE');
        $this->addSql('ALTER TABLE delegation DROP CONSTRAINT FK_292F436D8C03F15C');
        $this->addSql('DROP TABLE delegation');
        $this->addSql('DROP TABLE employee');
    }
}
