<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321101814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE is_ordered_products (is_ordered_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_15ED2A88776ABDFE (is_ordered_id), INDEX IDX_15ED2A886C8A81A9 (products_id), PRIMARY KEY(is_ordered_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE is_ordered_products ADD CONSTRAINT FK_15ED2A88776ABDFE FOREIGN KEY (is_ordered_id) REFERENCES is_ordered (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE is_ordered_products ADD CONSTRAINT FK_15ED2A886C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE is_ordered DROP FOREIGN KEY FK_D52E99514584665A');
        $this->addSql('DROP INDEX UNIQ_D52E99514584665A ON is_ordered');
        $this->addSql('ALTER TABLE is_ordered DROP product_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE is_ordered_products DROP FOREIGN KEY FK_15ED2A88776ABDFE');
        $this->addSql('ALTER TABLE is_ordered_products DROP FOREIGN KEY FK_15ED2A886C8A81A9');
        $this->addSql('DROP TABLE is_ordered_products');
        $this->addSql('ALTER TABLE is_ordered ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE is_ordered ADD CONSTRAINT FK_D52E99514584665A FOREIGN KEY (product_id) REFERENCES products (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D52E99514584665A ON is_ordered (product_id)');
    }
}
