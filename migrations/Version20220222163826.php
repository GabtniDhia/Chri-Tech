<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222163826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, entete VARCHAR(255) NOT NULL, corp LONGTEXT NOT NULL, date DATE NOT NULL, redacteur VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, blog_id_id INT DEFAULT NULL, article_id_id INT DEFAULT NULL, utilisateur VARCHAR(255) NOT NULL, contenue LONGTEXT NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_67F068BC8FABDD9F (blog_id_id), INDEX IDX_67F068BC8F3EC46 (article_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8FABDD9F FOREIGN KEY (blog_id_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8F3EC46');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE commentaire');
    }
}
