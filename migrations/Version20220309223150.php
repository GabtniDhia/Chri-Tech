<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220309223150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_offer (offre_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_888AFC624CC8505A (offre_id), INDEX IDX_888AFC62F347EFB (produit_id), PRIMARY KEY(offre_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_offer ADD CONSTRAINT FK_888AFC624CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_offer ADD CONSTRAINT FK_888AFC62F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre CHANGE type type enum(\'Standard\', \'Silver\' ,\'Gold\', \'Premium\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product_offer');
        $this->addSql('ALTER TABLE offre CHANGE type type VARCHAR(255) DEFAULT NULL');
    }
}
