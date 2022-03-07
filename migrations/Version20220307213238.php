<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307213238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC47B5E288 FOREIGN KEY (user_fk_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC47B5E288 ON commentaire (user_fk_id)');
        $this->addSql('ALTER TABLE offre CHANGE type type enum(\'standard\', \'silver\' ,\'gold\', \'premium\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC47B5E288');
        $this->addSql('DROP INDEX IDX_67F068BC47B5E288 ON commentaire');
        $this->addSql('ALTER TABLE offre CHANGE type type VARCHAR(255) DEFAULT NULL');
    }
}
