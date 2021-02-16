<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210126191138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank_accounts (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, bank_name VARCHAR(255) NOT NULL, bank_description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, id_parent_category INT DEFAULT NULL, id_user INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expenses (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_category INT NOT NULL, id_place_expenses INT NOT NULL, id_wallet INT NOT NULL, description LONGTEXT DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fixed_expenses (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_category INT NOT NULL, id_place_expenses INT NOT NULL, id_wallet INT NOT NULL, first_date INT NOT NULL, frequency_payments INT NOT NULL, description LONGTEXT DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_expenses (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, address_2 VARCHAR(255) DEFAULT NULL, number_phone INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_income (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, date INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, active_time INT DEFAULT NULL, register_time INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallets (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_bank_account INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bank_accounts');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE expenses');
        $this->addSql('DROP TABLE fixed_expenses');
        $this->addSql('DROP TABLE place_expenses');
        $this->addSql('DROP TABLE source_income');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE wallets');
    }
}
