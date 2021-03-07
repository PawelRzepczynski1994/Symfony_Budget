<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210306121600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenses DROP FOREIGN KEY expenses_ibfk_1');
        $this->addSql('DROP INDEX id_category ON expenses');
        $this->addSql('ALTER TABLE expenses CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE fixed_expenses DROP id_category, CHANGE first_date first_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenses CHANGE date date DATE NOT NULL');
        $this->addSql('ALTER TABLE expenses ADD CONSTRAINT expenses_ibfk_1 FOREIGN KEY (id_category) REFERENCES category (id)');
        $this->addSql('CREATE INDEX id_category ON expenses (id_category)');
        $this->addSql('ALTER TABLE fixed_expenses ADD id_category INT NOT NULL, CHANGE first_date first_date DATE NOT NULL');
    }
}
