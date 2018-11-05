<?php

declare(strict_types=1);

/*
 * This file is part of the Ekklesion project.
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
final class Version20181105151328 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person CHANGE gender gender VARCHAR(255) NOT NULL, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL, CHANGE facebook facebook VARCHAR(255) DEFAULT NULL, CHANGE email_primary email_primary VARCHAR(255) DEFAULT NULL, CHANGE email_secondary email_secondary VARCHAR(255) DEFAULT NULL, CHANGE phone_primary phone_primary VARCHAR(255) DEFAULT NULL, CHANGE phone_secondary phone_secondary VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person CHANGE gender gender VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE email_primary email_primary VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE email_secondary email_secondary VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE phone_primary phone_primary VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE phone_secondary phone_secondary VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE facebook facebook VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
