<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230129095430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ALTER status DROP NOT NULL');
        $this->addSql('ALTER TABLE article ALTER created_at SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE article ALTER created_at DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article ALTER status SET NOT NULL');
        $this->addSql('ALTER TABLE article ALTER created_at SET DEFAULT \'2023-01-28 11:39:56.822667\'');
        $this->addSql('ALTER TABLE article ALTER created_at SET NOT NULL');
    }
}
