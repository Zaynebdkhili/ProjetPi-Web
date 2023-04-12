<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230411015933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, id_article INT NOT NULL, reference BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE echange_article (echange_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_85EC2D8713713818 (echange_id), INDEX IDX_85EC2D877294869C (article_id), PRIMARY KEY(echange_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE echange_article ADD CONSTRAINT FK_85EC2D8713713818 FOREIGN KEY (echange_id) REFERENCES echange (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE echange_article ADD CONSTRAINT FK_85EC2D877294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE echange ADD user1_id INT NOT NULL');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BF56AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B577E3BF56AE248B ON echange (user1_id)');
        $this->addSql('ALTER TABLE evaluation ADD echange_id INT NOT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A57513713818 FOREIGN KEY (echange_id) REFERENCES echange (id)');
        $this->addSql('CREATE INDEX IDX_1323A57513713818 ON evaluation (echange_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BF56AE248B');
        $this->addSql('ALTER TABLE echange_article DROP FOREIGN KEY FK_85EC2D8713713818');
        $this->addSql('ALTER TABLE echange_article DROP FOREIGN KEY FK_85EC2D877294869C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE echange_article');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_B577E3BF56AE248B ON echange');
        $this->addSql('ALTER TABLE echange DROP user1_id');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A57513713818');
        $this->addSql('DROP INDEX IDX_1323A57513713818 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP echange_id');
    }
}
