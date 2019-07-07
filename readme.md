# Topir
> Physical information radiator for my Todoist stats

## Setup
1. Clone the repository.
1. Run `php composer.phar install`.
1. Copy the `.env.example` file to `.env` and add your Todoist API token.
1. Serve the public folder using a common, PHP-enabled webserver.
1. Run the `import/completed.php` script every 5 min or so using cron. The Todoist API only returns statistics for the last 7 days, so you should run the import script at least once daily to avoid missing data.
1. Run the `import/overdue.php` script just after midnight every day. This script will count the actual amount of overdue tasks at the moment of execution, so the results will change when you run it at different moments. For example, you can give yourself a two-hour grace period by running it at 02:00 instead of 00:05.

It might be wise to setup regular backups for the sqlite3 database (statistics).

## License
MIT

## Development
[Jakob Buis](https://www.jakobbuis.nl)
