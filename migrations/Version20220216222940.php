<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216222940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_fidelite (id INT AUTO_INCREMENT NOT NULL, nb_points INT DEFAULT NULL, date_creation DATETIME NOT NULL, date_expiration DATETIME NOT NULL, id_user INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_produit (offre_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_857E9F074CC8505A (offre_id), INDEX IDX_857E9F07F347EFB (produit_id), PRIMARY KEY(offre_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, ref_prod VARCHAR(255) NOT NULL, nom_prod VARCHAR(255) NOT NULL, desc_prod VARCHAR(255) NOT NULL, prix_unit_ht DOUBLE PRECISION NOT NULL, qte_stock INT NOT NULL, image_prod VARCHAR(255) NOT NULL, detail_prod VARCHAR(255) NOT NULL, prix_ttc DOUBLE PRECISION NOT NULL, prix_tva INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre_produit ADD CONSTRAINT FK_857E9F074CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_produit ADD CONSTRAINT FK_857E9F07F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE users');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_produit DROP FOREIGN KEY FK_857E9F074CC8505A');
        $this->addSql('ALTER TABLE offre_produit DROP FOREIGN KEY FK_857E9F07F347EFB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, datecreation DATE NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE carte_fidelite');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_produit');
        $this->addSql('DROP TABLE produit');
    }
}
