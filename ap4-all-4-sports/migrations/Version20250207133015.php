<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207133015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A83FBC2C7');
        $this->addSql('DROP INDEX IDX_B3BA5A5A83FBC2C7 ON products');
        $this->addSql('ALTER TABLE products CHANGE id_rayon_id rayon_id INT NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AD3202E52 FOREIGN KEY (rayon_id) REFERENCES rayon (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AD3202E52 ON products (rayon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AD3202E52');
        $this->addSql('DROP INDEX IDX_B3BA5A5AD3202E52 ON products');
        $this->addSql('ALTER TABLE products CHANGE rayon_id id_rayon_id INT NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A83FBC2C7 FOREIGN KEY (id_rayon_id) REFERENCES rayon (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A83FBC2C7 ON products (id_rayon_id)');
    }
}
