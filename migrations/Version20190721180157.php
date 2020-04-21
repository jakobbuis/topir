<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190721180157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create diet tracking table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('diet');

        $table->addColumn('day', 'date', ['notnull' => true]);
        $table->setPrimaryKey(['day']);

        $valueOptions =  ['notnull' => false, 'unsigned' => true, 'default' => null];
        $table->addColumn('weight', 'float', $valueOptions);
        $table->addColumn('circumference', 'float', $valueOptions);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('diet');
    }
}
