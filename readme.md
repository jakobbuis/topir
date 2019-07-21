# Topir
> Physical information radiator for my Todoist stats

## Requirements
Requires PHP 7.2+ and MySQL 5+.

## Setup
1. Clone the repository.
1. Run `php composer.phar install`.
1. Create a database.
1. Copy the `.env.example` file to `.env` and add relevant settings.
1. Run the migrations by executing `./vendor/bin/doctrine-migrations migrate --all-or-nothing`.
1. Serve the public folder using a common, PHP-enabled webserver.
1. Run the `import/completed.php` script every 5 min or so using cron. The Todoist API only returns statistics for the last 7 days, so you should run the import script at least once daily to avoid missing data.
1. Run the `import/overdue.php` script just after midnight every day. This script will count the actual amount of overdue tasks at the moment of execution, so the results will change when you run it at different moments. For example, you can give yourself a two-hour grace period by running it at 02:00 instead of 00:05.

## License
MIT

## Development
[Jakob Buis](https://www.jakobbuis.nl)
