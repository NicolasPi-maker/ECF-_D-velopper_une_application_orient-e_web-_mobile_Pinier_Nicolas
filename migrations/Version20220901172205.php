<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901172205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE difficulty (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe ADD difficulty_id_id INT DEFAULT NULL, ADD is_public TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B1372C205AF3 FOREIGN KEY (difficulty_id_id) REFERENCES difficulty (id)');
        $this->addSql('CREATE INDEX IDX_DA88B1372C205AF3 ON recipe (difficulty_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B1372C205AF3');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP INDEX IDX_DA88B1372C205AF3 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP difficulty_id_id, DROP is_public');
    }
}
