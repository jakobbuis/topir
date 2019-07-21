<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Import existing data
 */
final class Version20190721114915 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('INSERT INTO statistics (day, completed, overdue) VALUES
            ("2019-06-17", 28, NULL),
            ("2019-06-18", 14, NULL),
            ("2019-06-19", 7, NULL),
            ("2019-06-20", 15, NULL),
            ("2019-06-21", 3, NULL),
            ("2019-06-22", 0, NULL),
            ("2019-06-23", 25, NULL),
            ("2019-06-24", 31, NULL),
            ("2019-06-25", 13, NULL),
            ("2019-06-26", 24, NULL),
            ("2019-06-27", 37, NULL),
            ("2019-06-28", 12, NULL),
            ("2019-06-29", 0, NULL),
            ("2019-06-30", 0, NULL),
            ("2019-07-01", 12, NULL),
            ("2019-07-02", 34, NULL),
            ("2019-07-03", 28, NULL),
            ("2019-07-04", 26, NULL),
            ("2019-07-05", 1, NULL),
            ("2019-07-06", 18, 14),
            ("2019-07-07", 30, 4),
            ("2019-07-08", 34, 3),
            ("2019-07-09", 27, 1),
            ("2019-07-10", 19, 2),
            ("2019-07-11", 14, 5),
            ("2019-07-12", 11, 13),
            ("2019-07-13", 4, 36),
            ("2019-07-14", 59, 1),
            ("2019-07-15", 30, 1),
            ("2019-07-16", 23, 1),
            ("2019-07-17", 19, 1),
            ("2019-07-18", 5, 20),
            ("2019-07-19", 10, 31),
            ("2019-07-20", 29, 6),
            ("2019-07-21", 12, NULL);');
    }

    public function down(Schema $schema) : void
    {
        $schema->addSql('TRUNCATE TABLE statistics');
    }
}
