<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621132322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aparato (id INT AUTO_INCREMENT NOT NULL, nombre_aparato VARCHAR(255) NOT NULL, reservable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dia (id INT AUTO_INCREMENT NOT NULL, tabla_id INT DEFAULT NULL, dia_semana VARCHAR(255) NOT NULL, INDEX IDX_3E153BCE639DBF0B (tabla_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dia_ejercicio (dia_id INT NOT NULL, ejercicio_id INT NOT NULL, INDEX IDX_DE24EFB4AC1F7597 (dia_id), INDEX IDX_DE24EFB430890A7D (ejercicio_id), PRIMARY KEY(dia_id, ejercicio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ejercicio (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, grupo_muscular VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ejercicio_aparato (ejercicio_id INT NOT NULL, aparato_id INT NOT NULL, INDEX IDX_88F87CD730890A7D (ejercicio_id), INDEX IDX_88F87CD77F05C44D (aparato_id), PRIMARY KEY(ejercicio_id, aparato_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horario (id INT AUTO_INCREMENT NOT NULL, hora VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maquina (id INT AUTO_INCREMENT NOT NULL, aparato_id INT DEFAULT NULL, etiqueta VARCHAR(255) NOT NULL, INDEX IDX_AA3B503D7F05C44D (aparato_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, maquina_id INT DEFAULT NULL, horario_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, fecha_reserva DATE NOT NULL, INDEX IDX_188D2E3B41420729 (maquina_id), INDEX IDX_188D2E3B4959F1BA (horario_id), INDEX IDX_188D2E3BDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, ejercicio_id INT NOT NULL, usuario_id INT NOT NULL, repeticiones INT NOT NULL, peso DOUBLE PRECISION NOT NULL, num_serie INT NOT NULL, fecha_serie DATE NOT NULL, INDEX IDX_AA3A933430890A7D (ejercicio_id), INDEX IDX_AA3A9334DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tabla (id INT AUTO_INCREMENT NOT NULL, creador_id INT DEFAULT NULL, nombre_tabla VARCHAR(255) NOT NULL, visto_bueno TINYINT(1) DEFAULT NULL, INDEX IDX_F1444B5F62F40C3D (creador_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, mi_tabla_id INT DEFAULT NULL, dni VARCHAR(9) NOT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(50) NOT NULL, telefono VARCHAR(15) NOT NULL, fecha_nacimiento DATETIME NOT NULL, correo VARCHAR(50) NOT NULL, contrasenia VARCHAR(50) NOT NULL, brochure_filename VARCHAR(255) DEFAULT NULL, activado TINYINT(1) NOT NULL, es_admin TINYINT(1) NOT NULL, es_monitor TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_2265B05D7F8F253B (dni), INDEX IDX_2265B05D7661ABAC (mi_tabla_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dia ADD CONSTRAINT FK_3E153BCE639DBF0B FOREIGN KEY (tabla_id) REFERENCES tabla (id)');
        $this->addSql('ALTER TABLE dia_ejercicio ADD CONSTRAINT FK_DE24EFB4AC1F7597 FOREIGN KEY (dia_id) REFERENCES dia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dia_ejercicio ADD CONSTRAINT FK_DE24EFB430890A7D FOREIGN KEY (ejercicio_id) REFERENCES ejercicio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ejercicio_aparato ADD CONSTRAINT FK_88F87CD730890A7D FOREIGN KEY (ejercicio_id) REFERENCES ejercicio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ejercicio_aparato ADD CONSTRAINT FK_88F87CD77F05C44D FOREIGN KEY (aparato_id) REFERENCES aparato (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maquina ADD CONSTRAINT FK_AA3B503D7F05C44D FOREIGN KEY (aparato_id) REFERENCES aparato (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B41420729 FOREIGN KEY (maquina_id) REFERENCES maquina (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B4959F1BA FOREIGN KEY (horario_id) REFERENCES horario (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A933430890A7D FOREIGN KEY (ejercicio_id) REFERENCES ejercicio (id)');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A9334DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE tabla ADD CONSTRAINT FK_F1444B5F62F40C3D FOREIGN KEY (creador_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D7661ABAC FOREIGN KEY (mi_tabla_id) REFERENCES tabla (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ejercicio_aparato DROP FOREIGN KEY FK_88F87CD77F05C44D');
        $this->addSql('ALTER TABLE maquina DROP FOREIGN KEY FK_AA3B503D7F05C44D');
        $this->addSql('ALTER TABLE dia_ejercicio DROP FOREIGN KEY FK_DE24EFB4AC1F7597');
        $this->addSql('ALTER TABLE dia_ejercicio DROP FOREIGN KEY FK_DE24EFB430890A7D');
        $this->addSql('ALTER TABLE ejercicio_aparato DROP FOREIGN KEY FK_88F87CD730890A7D');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A933430890A7D');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B4959F1BA');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B41420729');
        $this->addSql('ALTER TABLE dia DROP FOREIGN KEY FK_3E153BCE639DBF0B');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D7661ABAC');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BDB38439E');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A9334DB38439E');
        $this->addSql('ALTER TABLE tabla DROP FOREIGN KEY FK_F1444B5F62F40C3D');
        $this->addSql('DROP TABLE aparato');
        $this->addSql('DROP TABLE dia');
        $this->addSql('DROP TABLE dia_ejercicio');
        $this->addSql('DROP TABLE ejercicio');
        $this->addSql('DROP TABLE ejercicio_aparato');
        $this->addSql('DROP TABLE horario');
        $this->addSql('DROP TABLE maquina');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE tabla');
        $this->addSql('DROP TABLE usuario');
    }
}
