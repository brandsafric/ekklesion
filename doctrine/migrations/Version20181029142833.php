<?php

declare(strict_types=1);

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181029142833 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE account (uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', last_login DATETIME DEFAULT NULL COMMENT \'(DC2Type:chronos)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:chronos)\', username_normal VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, password_hash VARCHAR(255) NOT NULL, token_value VARCHAR(255) NOT NULL, token_expires DATETIME NOT NULL COMMENT \'(DC2Type:chronos)\', UNIQUE INDEX UNIQ_7D3656A4E3D1CD3D (username_normal), UNIQUE INDEX UNIQ_7D3656A492FC23A8 (username_canonical), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE account');
    }
}
