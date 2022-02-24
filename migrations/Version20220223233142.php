<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223233142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_avis rendezvous_id INT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF03345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F91ABF03345E0A3 ON avis (rendezvous_id)');
        $this->addSql('ALTER TABLE commande ADD livraison_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('ALTER TABLE livraison ADD commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1F82EA2E54 ON livraison (commande_id)');
        $this->addSql('ALTER TABLE produit ADD cle_cat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2779F49AD4 FOREIGN KEY (cle_cat_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2779F49AD4 ON produit (cle_cat_id)');
        $this->addSql('ALTER TABLE rendezvous ADD avis_id INT DEFAULT NULL, ADD adressrend VARCHAR(255) NOT NULL, CHANGE adresserend titre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C09A9BA8197E709F ON rendezvous (avis_id)');
        $this->addSql('ALTER TABLE user ADD image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF03345E0A3');
        $this->addSql('DROP INDEX UNIQ_8F91ABF03345E0A3 ON avis');
        $this->addSql('ALTER TABLE avis DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE avis DROP id, CHANGE rendezvous_id id_avis INT NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D8E54FB25 ON commande');
        $this->addSql('ALTER TABLE commande DROP livraison_id');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('DROP INDEX UNIQ_A60C9F1F82EA2E54 ON livraison');
        $this->addSql('ALTER TABLE livraison DROP commande_id');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2779F49AD4');
        $this->addSql('DROP INDEX IDX_29A5EC2779F49AD4 ON produit');
        $this->addSql('ALTER TABLE produit DROP cle_cat_id');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('DROP INDEX UNIQ_C09A9BA8197E709F ON rendezvous');
        $this->addSql('ALTER TABLE rendezvous ADD adresserend VARCHAR(255) NOT NULL, DROP avis_id, DROP titre, DROP adressrend');
        $this->addSql('ALTER TABLE user DROP image');
    }
}
