<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220304095622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD pcat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634266B07B5 FOREIGN KEY (pcat_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_497DD634266B07B5 ON categorie (pcat_id)');
        $this->addSql('ALTER TABLE offre CHANGE type type enum(\'standard\', \'silver\' ,\'gold\')');
        $this->addSql('ALTER TABLE produit ADD cat VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634266B07B5');
        $this->addSql('DROP INDEX IDX_497DD634266B07B5 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP pcat_id');
        $this->addSql('ALTER TABLE offre CHANGE type type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE produit DROP cat');
    }
}
