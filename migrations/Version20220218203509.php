<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220218203509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, rendezvous_id INT NOT NULL, etat_service VARCHAR(255) NOT NULL, recommendation VARCHAR(255) NOT NULL, description_service VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8F91ABF03345E0A3 (rendezvous_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, numtel INT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, codepostal INT NOT NULL, ville VARCHAR(255) NOT NULL, datelivraison DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendezvous (id INT AUTO_INCREMENT NOT NULL, avis_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, service VARCHAR(255) NOT NULL, date_rendezvous DATE NOT NULL, description_rendezvous VARCHAR(255) NOT NULL, telephonenum VARCHAR(255) NOT NULL, adressrend VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C09A9BA8197E709F (avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF03345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8197E709F');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF03345E0A3');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE rendezvous');
    }
}
