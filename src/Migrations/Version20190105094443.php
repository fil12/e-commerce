<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190105094443 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6DE18E50B');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6FCDAEAAA');
        $this->addSql('DROP INDEX IDX_2530ADE6DE18E50B ON order_product');
        $this->addSql('DROP INDEX IDX_2530ADE6FCDAEAAA ON order_product');
        $this->addSql('ALTER TABLE order_product ADD order_id INT NOT NULL, ADD product_id INT NOT NULL, DROP order_id_id, DROP product_id_id');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE68D9F6D38 ON order_product (order_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE64584665A ON order_product (product_id)');
        $this->addSql('ALTER TABLE product_images DROP FOREIGN KEY FK_8263FFCEDE18E50B');
        $this->addSql('DROP INDEX IDX_8263FFCEDE18E50B ON product_images');
        $this->addSql('ALTER TABLE product_images CHANGE product_id_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_images ADD CONSTRAINT FK_8263FFCE4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_8263FFCE4584665A ON product_images (product_id)');
        $this->addSql('ALTER TABLE product_parameters_value DROP FOREIGN KEY FK_F5A0894DDE18E50B');
        $this->addSql('ALTER TABLE product_parameters_value DROP FOREIGN KEY FK_F5A0894DF8164DB');
        $this->addSql('DROP INDEX IDX_F5A0894DF8164DB ON product_parameters_value');
        $this->addSql('DROP INDEX IDX_F5A0894DDE18E50B ON product_parameters_value');
        $this->addSql('ALTER TABLE product_parameters_value ADD product_id INT NOT NULL, ADD parameter_id INT NOT NULL, DROP product_id_id, DROP parameter_id_id');
        $this->addSql('ALTER TABLE product_parameters_value ADD CONSTRAINT FK_F5A0894D4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_parameters_value ADD CONSTRAINT FK_F5A0894D7C56DBD6 FOREIGN KEY (parameter_id) REFERENCES parameters (id)');
        $this->addSql('CREATE INDEX IDX_F5A0894D4584665A ON product_parameters_value (product_id)');
        $this->addSql('CREATE INDEX IDX_F5A0894D7C56DBD6 ON product_parameters_value (parameter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D9F6D38');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('DROP INDEX IDX_2530ADE68D9F6D38 ON order_product');
        $this->addSql('DROP INDEX IDX_2530ADE64584665A ON order_product');
        $this->addSql('ALTER TABLE order_product ADD order_id_id INT NOT NULL, ADD product_id_id INT NOT NULL, DROP order_id, DROP product_id');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6DE18E50B ON order_product (product_id_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6FCDAEAAA ON order_product (order_id_id)');
        $this->addSql('ALTER TABLE product_images DROP FOREIGN KEY FK_8263FFCE4584665A');
        $this->addSql('DROP INDEX IDX_8263FFCE4584665A ON product_images');
        $this->addSql('ALTER TABLE product_images CHANGE product_id product_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_images ADD CONSTRAINT FK_8263FFCEDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_8263FFCEDE18E50B ON product_images (product_id_id)');
        $this->addSql('ALTER TABLE product_parameters_value DROP FOREIGN KEY FK_F5A0894D4584665A');
        $this->addSql('ALTER TABLE product_parameters_value DROP FOREIGN KEY FK_F5A0894D7C56DBD6');
        $this->addSql('DROP INDEX IDX_F5A0894D4584665A ON product_parameters_value');
        $this->addSql('DROP INDEX IDX_F5A0894D7C56DBD6 ON product_parameters_value');
        $this->addSql('ALTER TABLE product_parameters_value ADD product_id_id INT NOT NULL, ADD parameter_id_id INT NOT NULL, DROP product_id, DROP parameter_id');
        $this->addSql('ALTER TABLE product_parameters_value ADD CONSTRAINT FK_F5A0894DDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_parameters_value ADD CONSTRAINT FK_F5A0894DF8164DB FOREIGN KEY (parameter_id_id) REFERENCES parameters (id)');
        $this->addSql('CREATE INDEX IDX_F5A0894DF8164DB ON product_parameters_value (parameter_id_id)');
        $this->addSql('CREATE INDEX IDX_F5A0894DDE18E50B ON product_parameters_value (product_id_id)');
    }
}
