<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220309222851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, entete VARCHAR(255) NOT NULL, corp LONGTEXT NOT NULL, date DATE NOT NULL, redacteur VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, rendezvous_id INT NOT NULL, etat_service VARCHAR(255) NOT NULL, recommendation VARCHAR(255) NOT NULL, description_service VARCHAR(255) NOT NULL, date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8F91ABF03345E0A3 (rendezvous_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, utilisateur VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, contenue LONGTEXT DEFAULT NULL, date_heure DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_fidelite (id INT AUTO_INCREMENT NOT NULL, nb_points INT DEFAULT NULL, date_creation DATETIME NOT NULL, date_expiration DATETIME NOT NULL, id_user INT NOT NULL, type INT NOT NULL, tel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_cat VARCHAR(255) NOT NULL, type_cat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, livraison_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, numtel INT NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6EEAA67D8E54FB25 (livraison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, blog_id_id INT DEFAULT NULL, article_id_id INT DEFAULT NULL, utilisateur VARCHAR(255) NOT NULL, contenue LONGTEXT NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_67F068BC8FABDD9F (blog_id_id), INDEX IDX_67F068BC8F3EC46 (article_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande_spec (id INT AUTO_INCREMENT NOT NULL, demandeur_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', domaine VARCHAR(255) NOT NULL, cerif VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_A7AB65EB95A6EE59 (demandeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, adresse VARCHAR(255) NOT NULL, codepostal INT NOT NULL, ville VARCHAR(255) NOT NULL, datelivraison DATE NOT NULL, UNIQUE INDEX UNIQ_A60C9F1F82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, recipient_id INT NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_read TINYINT(1) NOT NULL, INDEX IDX_DB021E96F624B39D (sender_id), INDEX IDX_DB021E96E92F8F78 (recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, type enum(\'Standard\', \'Silver\' ,\'Gold\', \'Premium\'), prix INT NOT NULL, points INT NOT NULL, time DATETIME NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_produit (offre_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_857E9F074CC8505A (offre_id), INDEX IDX_857E9F07F347EFB (produit_id), PRIMARY KEY(offre_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, ref_prod VARCHAR(255) NOT NULL, nom_prod VARCHAR(255) NOT NULL, descri_prod VARCHAR(255) NOT NULL, prix_unit_ht_prod DOUBLE PRECISION NOT NULL, qte_stock_prod INT DEFAULT NULL, image_prod VARCHAR(255) DEFAULT NULL, detail_prod VARCHAR(255) NOT NULL, prix_ttc_prod DOUBLE PRECISION NOT NULL, prix_tva_prod DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendezvous (id INT AUTO_INCREMENT NOT NULL, avis_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, service VARCHAR(255) NOT NULL, date_rendezvous DATE NOT NULL, description_rendezvous VARCHAR(255) NOT NULL, telephonenum VARCHAR(255) NOT NULL, adressrend VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C09A9BA8197E709F (avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, idcarte_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, datecreation DATE NOT NULL, is_verified TINYINT(1) NOT NULL, image VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649631286BB (idcarte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF03345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8FABDD9F FOREIGN KEY (blog_id_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE demande_spec ADD CONSTRAINT FK_A7AB65EB95A6EE59 FOREIGN KEY (demandeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96E92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offre_produit ADD CONSTRAINT FK_857E9F074CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_produit ADD CONSTRAINT FK_857E9F07F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649631286BB FOREIGN KEY (idcarte_id) REFERENCES carte_fidelite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8F3EC46');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8FABDD9F');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649631286BB');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE offre_produit DROP FOREIGN KEY FK_857E9F074CC8505A');
        $this->addSql('ALTER TABLE offre_produit DROP FOREIGN KEY FK_857E9F07F347EFB');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF03345E0A3');
        $this->addSql('ALTER TABLE demande_spec DROP FOREIGN KEY FK_A7AB65EB95A6EE59');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96F624B39D');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96E92F8F78');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE carte_fidelite');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE demande_spec');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE rendezvous');
        $this->addSql('DROP TABLE user');
    }
}
