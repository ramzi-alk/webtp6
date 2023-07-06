<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230706090514 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pieces INT NOT NULL, name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commerce ADD id INT AUTO_INCREMENT NOT NULL, ADD id_dresseur_id INT NOT NULL, ADD id_pokemon_id INT NOT NULL, DROP id_dresseur, DROP id_pokemon, CHANGE id_acheteur id_acheteur_id INT DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE INDEX IDX_BBF5FDF9B9B2D149 ON commerce (id_dresseur_id)');
        $this->addSql('CREATE INDEX IDX_BBF5FDF98A6D9CE9 ON commerce (id_pokemon_id)');
        $this->addSql('CREATE INDEX IDX_BBF5FDF98EB576A8 ON commerce (id_acheteur_id)');
        $this->addSql('ALTER TABLE dresseur MODIFY id_dresseur INT NOT NULL');
        $this->addSql('ALTER TABLE dresseur DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE dresseur CHANGE password password VARCHAR(50) NOT NULL, CHANGE pieces pieces INT NOT NULL, CHANGE id_dresseur id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE dresseur ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE ref_pokemon_type CHANGE xp xp INT NOT NULL, CHANGE niveau niveau INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE commerce MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE commerce DROP FOREIGN KEY FK_BBF5FDF9B9B2D149');
        $this->addSql('ALTER TABLE commerce DROP FOREIGN KEY FK_BBF5FDF98A6D9CE9');
        $this->addSql('ALTER TABLE commerce DROP FOREIGN KEY FK_BBF5FDF98EB576A8');
        $this->addSql('DROP INDEX IDX_BBF5FDF9B9B2D149 ON commerce');
        $this->addSql('DROP INDEX IDX_BBF5FDF98A6D9CE9 ON commerce');
        $this->addSql('DROP INDEX IDX_BBF5FDF98EB576A8 ON commerce');
        $this->addSql('ALTER TABLE commerce DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE commerce ADD id_dresseur INT NOT NULL, ADD id_pokemon INT NOT NULL, DROP id, DROP id_dresseur_id, DROP id_pokemon_id, CHANGE id_acheteur_id id_acheteur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dresseur MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE dresseur DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE dresseur CHANGE password password VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE pieces pieces INT DEFAULT 50 NOT NULL, CHANGE id id_dresseur INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE dresseur ADD PRIMARY KEY (id_dresseur)');
        $this->addSql('ALTER TABLE ref_pokemon_type CHANGE xp xp INT DEFAULT 0 NOT NULL, CHANGE niveau niveau INT DEFAULT 1 NOT NULL');
    }
}
