<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402093528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_exp ADD t INT NOT NULL, ADD repartition1 DOUBLE PRECISION NOT NULL, ADD repartition2 DOUBLE PRECISION NOT NULL, ADD repartition3 DOUBLE PRECISION NOT NULL, ADD repartition4 DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE `detail_exp` CHANGE `idexp` `idexp` INT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_exp DROP t, DROP repartition1, DROP repartition2, DROP repartition3, DROP repartition4');
    }
}
