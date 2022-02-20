<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220154403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
