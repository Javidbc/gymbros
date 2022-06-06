<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606144542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dia_tabla (dia_id INT NOT NULL, tabla_id INT NOT NULL, INDEX IDX_CF5D3EA7AC1F7597 (dia_id), INDEX IDX_CF5D3EA7639DBF0B (tabla_id), PRIMARY KEY(dia_id, tabla_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dia_ejercicio (dia_id INT NOT NULL, ejercicio_id INT NOT NULL, INDEX IDX_DE24EFB4AC1F7597 (dia_id), INDEX IDX_DE24EFB430890A7D (ejercicio_id), PRIMARY KEY(dia_id, ejercicio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dia_tabla ADD CONSTRAINT FK_CF5D3EA7AC1F7597 FOREIGN KEY (dia_id) REFERENCES dia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dia_tabla ADD CONSTRAINT FK_CF5D3EA7639DBF0B FOREIGN KEY (tabla_id) REFERENCES tabla (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dia_ejercicio ADD CONSTRAINT FK_DE24EFB4AC1F7597 FOREIGN KEY (dia_id) REFERENCES dia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dia_ejercicio ADD CONSTRAINT FK_DE24EFB430890A7D FOREIGN KEY (ejercicio_id) REFERENCES ejercicio (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ejercicio_dia');
        $this->addSql('DROP TABLE tabla_dia');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ejercicio_dia (ejercicio_id INT NOT NULL, dia_id INT NOT NULL, INDEX IDX_7B45D7D630890A7D (ejercicio_id), INDEX IDX_7B45D7D6AC1F7597 (dia_id), PRIMARY KEY(ejercicio_id, dia_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tabla_dia (tabla_id INT NOT NULL, dia_id INT NOT NULL, INDEX IDX_C270176A639DBF0B (tabla_id), INDEX IDX_C270176AAC1F7597 (dia_id), PRIMARY KEY(tabla_id, dia_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ejercicio_dia ADD CONSTRAINT FK_7B45D7D630890A7D FOREIGN KEY (ejercicio_id) REFERENCES ejercicio (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ejercicio_dia ADD CONSTRAINT FK_7B45D7D6AC1F7597 FOREIGN KEY (dia_id) REFERENCES dia (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tabla_dia ADD CONSTRAINT FK_C270176A639DBF0B FOREIGN KEY (tabla_id) REFERENCES tabla (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tabla_dia ADD CONSTRAINT FK_C270176AAC1F7597 FOREIGN KEY (dia_id) REFERENCES dia (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE dia_tabla');
        $this->addSql('DROP TABLE dia_ejercicio');
    }
}
