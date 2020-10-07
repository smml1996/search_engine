<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201003231254 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE searcher (id INT AUTO_INCREMENT NOT NULL, word_id INT NOT NULL, webpage_id INT NOT NULL, occurences INT DEFAULT NULL, INDEX IDX_171F088FE357438D (word_id), INDEX IDX_171F088FE20F2920 (webpage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webpage (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(700) NOT NULL, description LONGTEXT DEFAULT NULL, title VARCHAR(255) NOT NULL, pagerank DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words (id INT AUTO_INCREMENT NOT NULL, word VARCHAR(255) NOT NULL, frequency INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE searcher ADD CONSTRAINT FK_171F088FE357438D FOREIGN KEY (word_id) REFERENCES words (id)');
        $this->addSql('ALTER TABLE searcher ADD CONSTRAINT FK_171F088FE20F2920 FOREIGN KEY (webpage_id) REFERENCES webpage (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE searcher DROP FOREIGN KEY FK_171F088FE20F2920');
        $this->addSql('ALTER TABLE searcher DROP FOREIGN KEY FK_171F088FE357438D');
        $this->addSql('DROP TABLE searcher');
        $this->addSql('DROP TABLE webpage');
        $this->addSql('DROP TABLE words');
    }
}
