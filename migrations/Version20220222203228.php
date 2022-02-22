<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222203228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, entete VARCHAR(255) NOT NULL, corp LONGTEXT NOT NULL, date DATE NOT NULL, redacteur VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, utilisateur VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, contenue LONGTEXT DEFAULT NULL, date_heure DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_cat VARCHAR(255) NOT NULL, type_cat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, blog_id_id INT DEFAULT NULL, article_id_id INT DEFAULT NULL, utilisateur VARCHAR(255) NOT NULL, contenue LONGTEXT NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_67F068BC8FABDD9F (blog_id_id), INDEX IDX_67F068BC8F3EC46 (article_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, recipient_id INT NOT NULL, title VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_read TINYINT(1) NOT NULL, INDEX IDX_DB021E96F624B39D (sender_id), INDEX IDX_DB021E96E92F8F78 (recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8FABDD9F FOREIGN KEY (blog_id_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96E92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF03345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id)');
        $this->addSql('ALTER TABLE produit ADD prix_unit_ht_prod DOUBLE PRECISION NOT NULL, ADD qte_stock_prod INT DEFAULT NULL, ADD prix_ttc_prod DOUBLE PRECISION NOT NULL, ADD prix_tva_prod DOUBLE PRECISION NOT NULL, DROP prix_unit_ht, DROP qte_stock, DROP prix_ttc, DROP prix_tva, CHANGE image_prod image_prod LONGBLOB DEFAULT NULL, CHANGE desc_prod descri_prod VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE user ADD image VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8F3EC46');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8FABDD9F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE messages');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF03345E0A3');
        $this->addSql('ALTER TABLE produit ADD prix_unit_ht DOUBLE PRECISION NOT NULL, ADD qte_stock INT NOT NULL, ADD prix_ttc DOUBLE PRECISION NOT NULL, ADD prix_tva INT NOT NULL, DROP prix_unit_ht_prod, DROP qte_stock_prod, DROP prix_ttc_prod, DROP prix_tva_prod, CHANGE image_prod image_prod VARCHAR(255) NOT NULL, CHANGE descri_prod desc_prod VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP image, CHANGE nom nom VARCHAR(255) DEFAULT NULL');
    }
}
