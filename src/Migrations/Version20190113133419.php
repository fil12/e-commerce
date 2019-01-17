<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190113133419 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parameters ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parameters ADD CONSTRAINT FK_69348FE727ACA70 FOREIGN KEY (parent_id) REFERENCES parameters (id)');
        $this->addSql('CREATE INDEX IDX_69348FE727ACA70 ON parameters (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parameters DROP FOREIGN KEY FK_69348FE727ACA70');
        $this->addSql('DROP INDEX IDX_69348FE727ACA70 ON parameters');
        $this->addSql('ALTER TABLE parameters DROP parent_id');
    }
}
