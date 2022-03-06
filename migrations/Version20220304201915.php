<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220304201915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_fidelite ADD type INT NOT NULL, ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D8E54FB25 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE livraison_id commandel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D838F852F FOREIGN KEY (commandel_id) REFERENCES livraison (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D838F852F ON commande (commandel_id)');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('DROP INDEX UNIQ_A60C9F1F82EA2E54 ON livraison');
        $this->addSql('ALTER TABLE livraison DROP commande_id');
        $this->addSql('ALTER TABLE offre ADD prix INT NOT NULL, ADD points INT NOT NULL, CHANGE type type enum(\'standard\', \'silver\' ,\'gold\', \'premium\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_fidelite DROP type, DROP image');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D838F852F');
        $this->addSql('DROP INDEX IDX_6EEAA67D838F852F ON commande');
        $this->addSql('ALTER TABLE commande CHANGE commandel_id livraison_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('ALTER TABLE livraison ADD commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1F82EA2E54 ON livraison (commande_id)');
        $this->addSql('ALTER TABLE offre DROP prix, DROP points, CHANGE type type VARCHAR(255) DEFAULT NULL');
    }
}
