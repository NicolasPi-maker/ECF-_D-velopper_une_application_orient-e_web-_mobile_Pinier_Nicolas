<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220831121236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, username VARCHAR(60) DEFAULT NULL, INDEX IDX_880E0D769D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allergens (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diets (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, patient_user_id_id INT DEFAULT NULL, name VARCHAR(60) NOT NULL, last_name VARCHAR(60) NOT NULL, INDEX IDX_1ADAD7EB2B46C3E0 (patient_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_allergens (patient_id INT NOT NULL, allergens_id INT NOT NULL, INDEX IDX_C17C4D8B6B899279 (patient_id), INDEX IDX_C17C4D8B711662F1 (allergens_id), PRIMARY KEY(patient_id, allergens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_diets (patient_id INT NOT NULL, diets_id INT NOT NULL, INDEX IDX_B5CBD0696B899279 (patient_id), INDEX IDX_B5CBD0699B4CB3A8 (diets_id), PRIMARY KEY(patient_id, diets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(60) NOT NULL, description VARCHAR(255) NOT NULL, setup_time TIME NOT NULL, rest_time TIME NOT NULL, cooking_time TIME NOT NULL, ingredients LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', steps VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_allergens (recipe_id INT NOT NULL, allergens_id INT NOT NULL, INDEX IDX_7036B15259D8A214 (recipe_id), INDEX IDX_7036B152711662F1 (allergens_id), PRIMARY KEY(recipe_id, allergens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_diets (recipe_id INT NOT NULL, diets_id INT NOT NULL, INDEX IDX_36EEDFB959D8A214 (recipe_id), INDEX IDX_36EEDFB99B4CB3A8 (diets_id), PRIMARY KEY(recipe_id, diets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, patient_id_id INT DEFAULT NULL, note VARCHAR(1) NOT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_794381C6EA724598 (patient_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D769D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB2B46C3E0 FOREIGN KEY (patient_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient_allergens ADD CONSTRAINT FK_C17C4D8B6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_allergens ADD CONSTRAINT FK_C17C4D8B711662F1 FOREIGN KEY (allergens_id) REFERENCES allergens (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_diets ADD CONSTRAINT FK_B5CBD0696B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_diets ADD CONSTRAINT FK_B5CBD0699B4CB3A8 FOREIGN KEY (diets_id) REFERENCES diets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_allergens ADD CONSTRAINT FK_7036B15259D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_allergens ADD CONSTRAINT FK_7036B152711662F1 FOREIGN KEY (allergens_id) REFERENCES allergens (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_diets ADD CONSTRAINT FK_36EEDFB959D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_diets ADD CONSTRAINT FK_36EEDFB99B4CB3A8 FOREIGN KEY (diets_id) REFERENCES diets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6EA724598 FOREIGN KEY (patient_id_id) REFERENCES patient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D769D86650F');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB2B46C3E0');
        $this->addSql('ALTER TABLE patient_allergens DROP FOREIGN KEY FK_C17C4D8B6B899279');
        $this->addSql('ALTER TABLE patient_allergens DROP FOREIGN KEY FK_C17C4D8B711662F1');
        $this->addSql('ALTER TABLE patient_diets DROP FOREIGN KEY FK_B5CBD0696B899279');
        $this->addSql('ALTER TABLE patient_diets DROP FOREIGN KEY FK_B5CBD0699B4CB3A8');
        $this->addSql('ALTER TABLE recipe_allergens DROP FOREIGN KEY FK_7036B15259D8A214');
        $this->addSql('ALTER TABLE recipe_allergens DROP FOREIGN KEY FK_7036B152711662F1');
        $this->addSql('ALTER TABLE recipe_diets DROP FOREIGN KEY FK_36EEDFB959D8A214');
        $this->addSql('ALTER TABLE recipe_diets DROP FOREIGN KEY FK_36EEDFB99B4CB3A8');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6EA724598');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE allergens');
        $this->addSql('DROP TABLE diets');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE patient_allergens');
        $this->addSql('DROP TABLE patient_diets');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_allergens');
        $this->addSql('DROP TABLE recipe_diets');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE user');
    }
}
