<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200421213744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Clean-up obsolete diet table';
    }

    public function up(Schema $schema): void
    {
        $schema->dropTable('diet');
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('Cannot reverse table removal: data not restored');
    }
}
