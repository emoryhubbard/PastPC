# PastPC, a Classic LAMP

PastPC is a fictional website, an Airbnb for renting out older PCs and unused computers remotely. Use cases:
- Passive income through unused devices
- Running legacy software without emulators
- Inexpensive DIY hosting
- Crypomining
- Inexpensive remote desktops

This project is designed to show how PHP apps:
- Can be made through the popular LAMP stack--Linux, Apache, MySQL/MariaDB, PHP
- Run for local development, and with some modification, how they can be self-hosted

Instead of using Linux directly, it is run inside of a Docker container.

Could-hosting a MySQL/MariaDB app is also possible, but will require the use of persistent containers available for free for only a temporary trial period.

For indefinite free cloud-hosting and further modernization, I recommend refactoring a new LAMP that uses MySQL/MariaDB to instead use PostgreSQL (if you still like to use SQL), or MongoDB (if you don't mind moving away from SQL), both of which can be deployed for free separately and connected to your PHP app.
