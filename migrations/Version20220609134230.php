<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609134230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE dia_tabla');
        $this->addSql('ALTER TABLE dia ADD tabla_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dia ADD CONSTRAINT FK_3E153BCE639DBF0B FOREIGN KEY (tabla_id) REFERENCES tabla (id)');
        $this->addSql('CREATE INDEX IDX_3E153BCE639DBF0B ON dia (tabla_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dia_tabla (dia_id INT NOT NULL, tabla_id INT NOT NULL, INDEX IDX_CF5D3EA7639DBF0B (tabla_id), INDEX IDX_CF5D3EA7AC1F7597 (dia_id), PRIMARY KEY(dia_id, tabla_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE dia_tabla ADD CONSTRAINT FK_CF5D3EA7639DBF0B FOREIGN KEY (tabla_id) REFERENCES tabla (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dia_tabla ADD CONSTRAINT FK_CF5D3EA7AC1F7597 FOREIGN KEY (dia_id) REFERENCES dia (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dia DROP FOREIGN KEY FK_3E153BCE639DBF0B');
        $this->addSql('DROP INDEX IDX_3E153BCE639DBF0B ON dia');
        $this->addSql('ALTER TABLE dia DROP tabla_id');
    }
}
