<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606093547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dia (id INT AUTO_INCREMENT NOT NULL, dia_semana VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ejercicio_aparato (ejercicio_id INT NOT NULL, aparato_id INT NOT NULL, INDEX IDX_88F87CD730890A7D (ejercicio_id), INDEX IDX_88F87CD77F05C44D (aparato_id), PRIMARY KEY(ejercicio_id, aparato_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ejercicio_dia (ejercicio_id INT NOT NULL, dia_id INT NOT NULL, INDEX IDX_7B45D7D630890A7D (ejercicio_id), INDEX IDX_7B45D7D6AC1F7597 (dia_id), PRIMARY KEY(ejercicio_id, dia_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tabla_dia (tabla_id INT NOT NULL, dia_id INT NOT NULL, INDEX IDX_C270176A639DBF0B (tabla_id), INDEX IDX_C270176AAC1F7597 (dia_id), PRIMARY KEY(tabla_id, dia_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ejercicio_aparato ADD CONSTRAINT FK_88F87CD730890A7D FOREIGN KEY (ejercicio_id) REFERENCES ejercicio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ejercicio_aparato ADD CONSTRAINT FK_88F87CD77F05C44D FOREIGN KEY (aparato_id) REFERENCES aparato (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ejercicio_dia ADD CONSTRAINT FK_7B45D7D630890A7D FOREIGN KEY (ejercicio_id) REFERENCES ejercicio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ejercicio_dia ADD CONSTRAINT FK_7B45D7D6AC1F7597 FOREIGN KEY (dia_id) REFERENCES dia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tabla_dia ADD CONSTRAINT FK_C270176A639DBF0B FOREIGN KEY (tabla_id) REFERENCES tabla (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tabla_dia ADD CONSTRAINT FK_C270176AAC1F7597 FOREIGN KEY (dia_id) REFERENCES dia (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE aparato_ejercicio');
        $this->addSql('DROP TABLE tabla_ejercicio');
        $this->addSql('ALTER TABLE reserva CHANGE fecha_reserva fecha_reserva DATE NOT NULL');
        $this->addSql('ALTER TABLE serie CHANGE fecha_serie fecha_serie DATE NOT NULL');
        $this->addSql('ALTER TABLE tabla DROP dia_semana');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ejercicio_dia DROP FOREIGN KEY FK_7B45D7D6AC1F7597');
        $this->addSql('ALTER TABLE tabla_dia DROP FOREIGN KEY FK_C270176AAC1F7597');
        $this->addSql('CREATE TABLE aparato_ejercicio (aparato_id INT NOT NULL, ejercicio_id INT NOT NULL, INDEX IDX_1EB0EA3B30890A7D (ejercicio_id), INDEX IDX_1EB0EA3B7F05C44D (aparato_id), PRIMARY KEY(aparato_id, ejercicio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tabla_ejercicio (tabla_id INT NOT NULL, ejercicio_id INT NOT NULL, INDEX IDX_A337D38C30890A7D (ejercicio_id), INDEX IDX_A337D38C639DBF0B (tabla_id), PRIMARY KEY(tabla_id, ejercicio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE aparato_ejercicio ADD CONSTRAINT FK_1EB0EA3B30890A7D FOREIGN KEY (ejercicio_id) REFERENCES ejercicio (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aparato_ejercicio ADD CONSTRAINT FK_1EB0EA3B7F05C44D FOREIGN KEY (aparato_id) REFERENCES aparato (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tabla_ejercicio ADD CONSTRAINT FK_A337D38C30890A7D FOREIGN KEY (ejercicio_id) REFERENCES ejercicio (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tabla_ejercicio ADD CONSTRAINT FK_A337D38C639DBF0B FOREIGN KEY (tabla_id) REFERENCES tabla (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE dia');
        $this->addSql('DROP TABLE ejercicio_aparato');
        $this->addSql('DROP TABLE ejercicio_dia');
        $this->addSql('DROP TABLE tabla_dia');
        $this->addSql('ALTER TABLE reserva CHANGE fecha_reserva fecha_reserva DATETIME NOT NULL');
        $this->addSql('ALTER TABLE serie CHANGE fecha_serie fecha_serie DATETIME NOT NULL');
        $this->addSql('ALTER TABLE tabla ADD dia_semana VARCHAR(255) NOT NULL');
    }
}
