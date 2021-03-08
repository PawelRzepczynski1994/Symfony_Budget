<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210306174625 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1A76ED395 ON category (user_id)');
        $this->addSql('ALTER TABLE expenses ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE expenses ADD CONSTRAINT FK_2496F35BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2496F35BA76ED395 ON expenses (user_id)');
        $this->addSql('ALTER TABLE fixed_expenses ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE fixed_expenses ADD CONSTRAINT FK_1B54A601A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_1B54A601A76ED395 ON fixed_expenses (user_id)');
        $this->addSql('ALTER TABLE place_expenses ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE place_expenses ADD CONSTRAINT FK_ECD14D8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_ECD14D8A76ED395 ON place_expenses (user_id)');
        $this->addSql('ALTER TABLE source_income ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE source_income ADD CONSTRAINT FK_89574736A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_89574736A76ED395 ON source_income (user_id)');
        $this->addSql('ALTER TABLE wallets ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE wallets ADD CONSTRAINT FK_967AAA6CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_967AAA6CA76ED395 ON wallets (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A76ED395');
        $this->addSql('DROP INDEX IDX_64C19C1A76ED395 ON category');
        $this->addSql('ALTER TABLE category DROP user_id');
        $this->addSql('ALTER TABLE expenses DROP FOREIGN KEY FK_2496F35BA76ED395');
        $this->addSql('DROP INDEX IDX_2496F35BA76ED395 ON expenses');
        $this->addSql('ALTER TABLE expenses DROP user_id');
        $this->addSql('ALTER TABLE fixed_expenses DROP FOREIGN KEY FK_1B54A601A76ED395');
        $this->addSql('DROP INDEX IDX_1B54A601A76ED395 ON fixed_expenses');
        $this->addSql('ALTER TABLE fixed_expenses DROP user_id');
        $this->addSql('ALTER TABLE place_expenses DROP FOREIGN KEY FK_ECD14D8A76ED395');
        $this->addSql('DROP INDEX IDX_ECD14D8A76ED395 ON place_expenses');
        $this->addSql('ALTER TABLE place_expenses DROP user_id');
        $this->addSql('ALTER TABLE source_income DROP FOREIGN KEY FK_89574736A76ED395');
        $this->addSql('DROP INDEX IDX_89574736A76ED395 ON source_income');
        $this->addSql('ALTER TABLE source_income DROP user_id');
        $this->addSql('ALTER TABLE wallets DROP FOREIGN KEY FK_967AAA6CA76ED395');
        $this->addSql('DROP INDEX IDX_967AAA6CA76ED395 ON wallets');
        $this->addSql('ALTER TABLE wallets DROP user_id');
    }
}
