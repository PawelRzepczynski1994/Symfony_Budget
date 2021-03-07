<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210306122526 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fixed_expenses ADD id_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fixed_expenses ADD CONSTRAINT FK_1B54A601A545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_1B54A601A545015 ON fixed_expenses (id_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fixed_expenses DROP FOREIGN KEY FK_1B54A601A545015');
        $this->addSql('DROP INDEX IDX_1B54A601A545015 ON fixed_expenses');
        $this->addSql('ALTER TABLE fixed_expenses DROP id_category_id');
    }
}
