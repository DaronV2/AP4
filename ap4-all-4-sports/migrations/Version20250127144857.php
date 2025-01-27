<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127144857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(5) NOT NULL, number VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, email_client_id INT NOT NULL, date_order DATETIME NOT NULL, total_price DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, INDEX IDX_F529939816E0F60A (email_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_products (order_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_5242B8EB8D9F6D38 (order_id), INDEX IDX_5242B8EB6C8A81A9 (products_id), PRIMARY KEY(order_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_8F7C2FC0AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, id_fournisseur_id INT NOT NULL, id_rayon_id INT NOT NULL, price_ttc DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_B3BA5A5A5A6AC879 (id_fournisseur_id), INDEX IDX_B3BA5A5A83FBC2C7 (id_rayon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rayon (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stocke (id INT AUTO_INCREMENT NOT NULL, reference_product_id INT DEFAULT NULL, id_warehouse_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_A2232D54119A5315 (reference_product_id), INDEX IDX_A2232D54734199AC (id_warehouse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE warehouse (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, module VARCHAR(255) NOT NULL, aisle VARCHAR(255) NOT NULL, row_warehouse VARCHAR(255) NOT NULL, section INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939816E0F60A FOREIGN KEY (email_client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_products ADD CONSTRAINT FK_5242B8EB8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_products ADD CONSTRAINT FK_5242B8EB6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC0AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A5A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A83FBC2C7 FOREIGN KEY (id_rayon_id) REFERENCES rayon (id)');
        $this->addSql('ALTER TABLE stocke ADD CONSTRAINT FK_A2232D54119A5315 FOREIGN KEY (reference_product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE stocke ADD CONSTRAINT FK_A2232D54734199AC FOREIGN KEY (id_warehouse_id) REFERENCES warehouse (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939816E0F60A');
        $this->addSql('ALTER TABLE order_products DROP FOREIGN KEY FK_5242B8EB8D9F6D38');
        $this->addSql('ALTER TABLE order_products DROP FOREIGN KEY FK_5242B8EB6C8A81A9');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC0AABEFE2C');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A5A6AC879');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A83FBC2C7');
        $this->addSql('ALTER TABLE stocke DROP FOREIGN KEY FK_A2232D54119A5315');
        $this->addSql('ALTER TABLE stocke DROP FOREIGN KEY FK_A2232D54734199AC');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_products');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE rayon');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE stocke');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE warehouse');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
