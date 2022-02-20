<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220181354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_fidelite (id INT AUTO_INCREMENT NOT NULL, nb_points INT DEFAULT NULL, date_creation DATETIME NOT NULL, date_expiration DATETIME NOT NULL, id_user INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, numtel INT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, codepostal INT NOT NULL, ville VARCHAR(255) NOT NULL, datelivraison DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_produit (offre_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_857E9F074CC8505A (offre_id), INDEX IDX_857E9F07F347EFB (produit_id), PRIMARY KEY(offre_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, datecreation DATE NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre_produit ADD CONSTRAINT FK_857E9F074CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_produit ADD CONSTRAINT FK_857E9F07F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis MODIFY id_avis INT NOT NULL');
        $this->addSql('ALTER TABLE avis DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE avis ADD rendezvous_id INT NOT NULL, CHANGE id_avis id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF03345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F91ABF03345E0A3 ON avis (rendezvous_id)');
        $this->addSql('ALTER TABLE avis ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE rendezvous ADD avis_id INT DEFAULT NULL, ADD adressrend VARCHAR(255) NOT NULL, CHANGE adresserend titre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C09A9BA8197E709F ON rendezvous (avis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_produit DROP FOREIGN KEY FK_857E9F074CC8505A');
        $this->addSql('DROP TABLE carte_fidelite');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_produit');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE avis MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF03345E0A3');
        $this->addSql('DROP INDEX UNIQ_8F91ABF03345E0A3 ON avis');
        $this->addSql('ALTER TABLE avis DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE avis DROP rendezvous_id, CHANGE id id_avis INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE avis ADD PRIMARY KEY (id_avis)');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('DROP INDEX UNIQ_C09A9BA8197E709F ON rendezvous');
        $this->addSql('ALTER TABLE rendezvous ADD adresserend VARCHAR(255) NOT NULL, DROP avis_id, DROP titre, DROP adressrend');
    }
}
