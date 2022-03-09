<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308224931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison ADD heurelivraison TIME NOT NULL');
        $this->addSql('ALTER TABLE offre CHANGE type type enum(\'standard\', \'silver\' ,\'gold\', \'premium\')');
        $this->addSql('ALTER TABLE produit ADD cat_id INT DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27E6ADA943 FOREIGN KEY (cat_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27E6ADA943 ON produit (cat_id)');
        $this->addSql('ALTER TABLE rendezvous CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison DROP heurelivraison');
        $this->addSql('ALTER TABLE offre CHANGE type type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27E6ADA943');
        $this->addSql('DROP INDEX IDX_29A5EC27E6ADA943 ON produit');
        $this->addSql('ALTER TABLE produit DROP cat_id, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE rendezvous CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE id id INT NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
    }
}
