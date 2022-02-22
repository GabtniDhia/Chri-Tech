<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222093530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_cat VARCHAR(255) NOT NULL, type_cat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF03345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id)');
        $this->addSql('ALTER TABLE produit ADD prix_unit_ht_prod DOUBLE PRECISION NOT NULL, ADD qte_stock_prod INT DEFAULT NULL, ADD prix_ttc_prod DOUBLE PRECISION NOT NULL, ADD prix_tva_prod DOUBLE PRECISION NOT NULL, DROP prix_unit_ht, DROP qte_stock, DROP prix_ttc, DROP prix_tva, CHANGE image_prod image_prod LONGBLOB DEFAULT NULL, CHANGE desc_prod descri_prod VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE user ADD image VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categorie');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF03345E0A3');
        $this->addSql('ALTER TABLE produit ADD prix_unit_ht DOUBLE PRECISION NOT NULL, ADD qte_stock INT NOT NULL, ADD prix_ttc DOUBLE PRECISION NOT NULL, ADD prix_tva INT NOT NULL, DROP prix_unit_ht_prod, DROP qte_stock_prod, DROP prix_ttc_prod, DROP prix_tva_prod, CHANGE image_prod image_prod VARCHAR(255) NOT NULL, CHANGE descri_prod desc_prod VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP image, CHANGE nom nom VARCHAR(255) DEFAULT NULL');
    }
}
