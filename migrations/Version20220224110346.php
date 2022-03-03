<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224110346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre ADD type enum(\'standard\', \'silver\' ,\'gold\')');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2779F49AD4');
        $this->addSql('DROP INDEX IDX_29A5EC2779F49AD4 ON produit');
        $this->addSql('ALTER TABLE produit DROP cle_cat_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre DROP type');
        $this->addSql('ALTER TABLE produit ADD cle_cat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2779F49AD4 FOREIGN KEY (cle_cat_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2779F49AD4 ON produit (cle_cat_id)');
    }
}
