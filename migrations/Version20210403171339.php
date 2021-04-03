<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403171339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etat_exp ADD experience_id INT NOT NULL');
        $this->addSql('ALTER TABLE etat_exp ADD CONSTRAINT FK_40658B8346E90E27 FOREIGN KEY (experience_id) REFERENCES resume (id)');
        $this->addSql('CREATE INDEX IDX_40658B8346E90E27 ON etat_exp (experience_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etat_exp DROP FOREIGN KEY FK_40658B8346E90E27');
        $this->addSql('DROP INDEX IDX_40658B8346E90E27 ON etat_exp');
        $this->addSql('ALTER TABLE etat_exp DROP experience_id');
    }
}
