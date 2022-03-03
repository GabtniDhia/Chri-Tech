<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303134126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF03345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id)');
        $this->addSql('ALTER TABLE carte_fidelite ADD type INT NOT NULL, ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commande ADD commandel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D838F852F FOREIGN KEY (commandel_id) REFERENCES livraison (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D838F852F ON commande (commandel_id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8FABDD9F FOREIGN KEY (blog_id_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96E92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offre ADD type enum(\'standard\', \'silver\' ,\'gold\', \'premium\'), ADD prix INT NOT NULL, ADD points INT NOT NULL');
        $this->addSql('ALTER TABLE offre_produit ADD CONSTRAINT FK_857E9F074CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_produit ADD CONSTRAINT FK_857E9F07F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE demande_spec');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF03345E0A3');
        $this->addSql('ALTER TABLE carte_fidelite DROP type, DROP image');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D838F852F');
        $this->addSql('DROP INDEX IDX_6EEAA67D838F852F ON commande');
        $this->addSql('ALTER TABLE commande DROP commandel_id');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8FABDD9F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8F3EC46');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96F624B39D');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96E92F8F78');
        $this->addSql('ALTER TABLE offre DROP type, DROP prix, DROP points');
        $this->addSql('ALTER TABLE offre_produit DROP FOREIGN KEY FK_857E9F074CC8505A');
        $this->addSql('ALTER TABLE offre_produit DROP FOREIGN KEY FK_857E9F07F347EFB');
        $this->addSql('ALTER TABLE produit CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE rendezvous CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE id id INT NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
    }
}
