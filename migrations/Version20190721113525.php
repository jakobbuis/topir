<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190721113525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create existing database structure';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('statistics');
        $table->addColumn('day', 'date', ['notnull' => true]);
        $table->addColumn('completed', 'integer', ['notnull' => false, 'unsigned' => true, 'default' => null]);
        $table->addColumn('overdue', 'integer', ['notnull' => false, 'unsigned' => true, 'default' => null]);

        $table->setPrimaryKey(['day']);

        //CREATE TABLE statistics (day DATE PRIMARY KEY, completed INT UNSIGNED NULLABLE DEFAULT NULL, overdue INT UNSIGNED NULLABLE DEFAULT NULL);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('statistics');
    }
}
