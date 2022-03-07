<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306222604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande_spec (id INT AUTO_INCREMENT NOT NULL, demandeur_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', domaine VARCHAR(255) NOT NULL, cerif VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_A7AB65EB95A6EE59 (demandeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande_spec ADD CONSTRAINT FK_A7AB65EB95A6EE59 FOREIGN KEY (demandeur_id) REFERENCES user (id) ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE avis ADD date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE blog ADD img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD commandel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D838F852F FOREIGN KEY (commandel_id) REFERENCES livraison (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D838F852F ON commande (commandel_id)');
        $this->addSql('ALTER TABLE messages DROP title');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96E92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offre ADD type enum(\'standard\', \'silver\' ,\'gold\', \'premium\'), ADD prix INT NOT NULL, ADD points INT NOT NULL');
        $this->addSql('ALTER TABLE produit CHANGE image_prod image_prod VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE demande_spec');
        $this->addSql('ALTER TABLE avis DROP date');
        $this->addSql('ALTER TABLE blog DROP img');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D838F852F');
        $this->addSql('DROP INDEX IDX_6EEAA67D838F852F ON commande');
        $this->addSql('ALTER TABLE commande DROP commandel_id');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96F624B39D');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96E92F8F78');
        $this->addSql('ALTER TABLE messages ADD title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offre DROP type, DROP prix, DROP points');
        $this->addSql('ALTER TABLE produit CHANGE image_prod image_prod LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE user CHANGE image image VARCHAR(255) NOT NULL');
    }
}
