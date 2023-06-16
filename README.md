# allmythingsintheweb



Installation:

You need a web server with PHP 8.0 and a database (mysql).


1. download the github files
2. import the "import_into_mysql.sql" into your MYSQL database (e.g. with phpmyadmin)
3. upload the rest of the files to your webserver
4. adjust the "config.php" to your SQL-Server
5. adapt the "class.php" to your SQL-Server and edit at least the "const URL", so that it contains your installation directory
6. now create a new user in the database, log in to e.g. phpmyadmin and edit the "users" table, the following values are needed:
- username
- password (can be generated with https://phppasswordhash.com/)
- email

7. ready, you can log in now and set up the shortcut (more information after you've logged in - press on "How to install")
