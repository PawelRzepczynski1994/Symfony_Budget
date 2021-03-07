<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210306125501 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fixed_expenses ADD id_places_expenses_id INT NOT NULL, ADD id_wallet_id INT NOT NULL, ADD wallets VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE fixed_expenses ADD CONSTRAINT FK_1B54A6015BBE0AC FOREIGN KEY (id_places_expenses_id) REFERENCES place_expenses (id)');
        $this->addSql('ALTER TABLE fixed_expenses ADD CONSTRAINT FK_1B54A601F1109CD4 FOREIGN KEY (id_wallet_id) REFERENCES wallets (id)');
        $this->addSql('CREATE INDEX IDX_1B54A6015BBE0AC ON fixed_expenses (id_places_expenses_id)');
        $this->addSql('CREATE INDEX IDX_1B54A601F1109CD4 ON fixed_expenses (id_wallet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fixed_expenses DROP FOREIGN KEY FK_1B54A6015BBE0AC');
        $this->addSql('ALTER TABLE fixed_expenses DROP FOREIGN KEY FK_1B54A601F1109CD4');
        $this->addSql('DROP INDEX IDX_1B54A6015BBE0AC ON fixed_expenses');
        $this->addSql('DROP INDEX IDX_1B54A601F1109CD4 ON fixed_expenses');
        $this->addSql('ALTER TABLE fixed_expenses DROP id_places_expenses_id, DROP id_wallet_id, DROP wallets');
    }
}
