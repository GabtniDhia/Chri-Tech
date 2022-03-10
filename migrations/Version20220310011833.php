<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220310011833 extends AbstractMigration
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
        $this->addSql('ALTER TABLE recherche CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous ADD client_id INT NOT NULL, CHANGE date_rendezvous date_rendezvous DATETIME NOT NULL');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA819EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA819EB6921 ON rendezvous (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison DROP heurelivraison');
        $this->addSql('ALTER TABLE offre CHANGE type type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE recherche CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA819EB6921');
        $this->addSql('DROP INDEX IDX_C09A9BA819EB6921 ON rendezvous');
        $this->addSql('ALTER TABLE rendezvous DROP client_id, CHANGE date_rendezvous date_rendezvous DATE NOT NULL');
    }
}
