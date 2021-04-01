<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401114857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE result ADD idexperience_id INT NOT NULL');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC1135671884D FOREIGN KEY (idexperience_id) REFERENCES exp_resume (id)');
        $this->addSql('CREATE INDEX IDX_136AC1135671884D ON result (idexperience_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE result DROP FOREIGN KEY FK_136AC1135671884D');
        $this->addSql('DROP INDEX IDX_136AC1135671884D ON result');
        $this->addSql('ALTER TABLE result DROP idexperience_id');
    }
}
