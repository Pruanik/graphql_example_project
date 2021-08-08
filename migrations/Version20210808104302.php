<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210808104302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flowers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shops (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_flower (shop_id INT NOT NULL, flower_id INT NOT NULL, INDEX IDX_2275E7584D16C4DD (shop_id), INDEX IDX_2275E7582C09D409 (flower_id), PRIMARY KEY(shop_id, flower_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shop_flower ADD CONSTRAINT FK_2275E7584D16C4DD FOREIGN KEY (shop_id) REFERENCES shops (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shop_flower ADD CONSTRAINT FK_2275E7582C09D409 FOREIGN KEY (flower_id) REFERENCES flowers (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shop_flower DROP FOREIGN KEY FK_2275E7582C09D409');
        $this->addSql('ALTER TABLE shop_flower DROP FOREIGN KEY FK_2275E7584D16C4DD');
        $this->addSql('DROP TABLE flowers');
        $this->addSql('DROP TABLE shops');
        $this->addSql('DROP TABLE shop_flower');
    }
}
