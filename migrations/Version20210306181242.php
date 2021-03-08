<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210306181242 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenses ADD category_id INT NOT NULL, ADD place_expenses_id INT NOT NULL, ADD wallets_id INT NOT NULL');
        $this->addSql('ALTER TABLE expenses ADD CONSTRAINT FK_2496F35B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE expenses ADD CONSTRAINT FK_2496F35B2EA0C8EE FOREIGN KEY (place_expenses_id) REFERENCES place_expenses (id)');
        $this->addSql('ALTER TABLE expenses ADD CONSTRAINT FK_2496F35BC3B43BA3 FOREIGN KEY (wallets_id) REFERENCES wallets (id)');
        $this->addSql('CREATE INDEX IDX_2496F35B12469DE2 ON expenses (category_id)');
        $this->addSql('CREATE INDEX IDX_2496F35B2EA0C8EE ON expenses (place_expenses_id)');
        $this->addSql('CREATE INDEX IDX_2496F35BC3B43BA3 ON expenses (wallets_id)');
        $this->addSql('ALTER TABLE fixed_expenses ADD category_id INT NOT NULL, ADD place_expenses_id INT NOT NULL, ADD wallets_id INT NOT NULL');
        $this->addSql('ALTER TABLE fixed_expenses ADD CONSTRAINT FK_1B54A60112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE fixed_expenses ADD CONSTRAINT FK_1B54A6012EA0C8EE FOREIGN KEY (place_expenses_id) REFERENCES place_expenses (id)');
        $this->addSql('ALTER TABLE fixed_expenses ADD CONSTRAINT FK_1B54A601C3B43BA3 FOREIGN KEY (wallets_id) REFERENCES wallets (id)');
        $this->addSql('CREATE INDEX IDX_1B54A60112469DE2 ON fixed_expenses (category_id)');
        $this->addSql('CREATE INDEX IDX_1B54A6012EA0C8EE ON fixed_expenses (place_expenses_id)');
        $this->addSql('CREATE INDEX IDX_1B54A601C3B43BA3 ON fixed_expenses (wallets_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenses DROP FOREIGN KEY FK_2496F35B12469DE2');
        $this->addSql('ALTER TABLE expenses DROP FOREIGN KEY FK_2496F35B2EA0C8EE');
        $this->addSql('ALTER TABLE expenses DROP FOREIGN KEY FK_2496F35BC3B43BA3');
        $this->addSql('DROP INDEX IDX_2496F35B12469DE2 ON expenses');
        $this->addSql('DROP INDEX IDX_2496F35B2EA0C8EE ON expenses');
        $this->addSql('DROP INDEX IDX_2496F35BC3B43BA3 ON expenses');
        $this->addSql('ALTER TABLE expenses DROP category_id, DROP place_expenses_id, DROP wallets_id');
        $this->addSql('ALTER TABLE fixed_expenses DROP FOREIGN KEY FK_1B54A60112469DE2');
        $this->addSql('ALTER TABLE fixed_expenses DROP FOREIGN KEY FK_1B54A6012EA0C8EE');
        $this->addSql('ALTER TABLE fixed_expenses DROP FOREIGN KEY FK_1B54A601C3B43BA3');
        $this->addSql('DROP INDEX IDX_1B54A60112469DE2 ON fixed_expenses');
        $this->addSql('DROP INDEX IDX_1B54A6012EA0C8EE ON fixed_expenses');
        $this->addSql('DROP INDEX IDX_1B54A601C3B43BA3 ON fixed_expenses');
        $this->addSql('ALTER TABLE fixed_expenses DROP category_id, DROP place_expenses_id, DROP wallets_id');
    }
}
