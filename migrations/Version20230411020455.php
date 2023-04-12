<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230411020455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD id_article INT NOT NULL');
        $this->addSql('ALTER TABLE echange ADD id_echange INT NOT NULL');
        $this->addSql('ALTER TABLE evaluation ADD id_evaluation INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP id_article');
        $this->addSql('ALTER TABLE echange DROP id_echange');
        $this->addSql('ALTER TABLE evaluation DROP id_evaluation');
    }
}
