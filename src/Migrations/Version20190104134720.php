<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190104134720 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_64C19C1B3750AF4 (parent_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, sku VARCHAR(25) NOT NULL, is_new TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_product (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_product_category (category_product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_48C1CAD2639A3624 (category_product_id), INDEX IDX_48C1CAD212469DE2 (category_id), PRIMARY KEY(category_product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_product_product (category_product_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_5A1A434F639A3624 (category_product_id), INDEX IDX_5A1A434F4584665A (product_id), PRIMARY KEY(category_product_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1B3750AF4 FOREIGN KEY (parent_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category_product_category ADD CONSTRAINT FK_48C1CAD2639A3624 FOREIGN KEY (category_product_id) REFERENCES category_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_product_category ADD CONSTRAINT FK_48C1CAD212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_product_product ADD CONSTRAINT FK_5A1A434F639A3624 FOREIGN KEY (category_product_id) REFERENCES category_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_product_product ADD CONSTRAINT FK_5A1A434F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1B3750AF4');
        $this->addSql('ALTER TABLE category_product_category DROP FOREIGN KEY FK_48C1CAD212469DE2');
        $this->addSql('ALTER TABLE category_product_product DROP FOREIGN KEY FK_5A1A434F4584665A');
        $this->addSql('ALTER TABLE category_product_category DROP FOREIGN KEY FK_48C1CAD2639A3624');
        $this->addSql('ALTER TABLE category_product_product DROP FOREIGN KEY FK_5A1A434F639A3624');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE category_product');
        $this->addSql('DROP TABLE category_product_category');
        $this->addSql('DROP TABLE category_product_product');
    }
}
