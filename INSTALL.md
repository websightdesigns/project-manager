[![WebSight Designs](http://www.websightdesigns.com/img/headerlogo-light.png)](http://www.websightdesigns.com)

# Project Manager - Install Instructions

## Setting up Cache Directories

This project uses a Makefile to set up the cache directories. Change into the project's root directory and run the following commands:

    $ chmod +x make-scripts/init.sh
    $ make clean

## Setting up Apache

You will need a `<Directory>` container in your `<VirtualHost>` container.

    <Directory /path/to/project-manager>
     Options +FollowSymLinks
     <IfModule mod_rewrite.c>
      RewriteEngine On
      RewriteBase /
      RewriteCond %{REQUEST_FILENAME} -f [   RewriteCond %{REQUEST_FILENAME} -d
      RewriteRule ^.*$ - [S=40](OR])
      RewriteRule (.*)/(.*)/$ /index.php?page=$1&id=$2 [   RewriteRule (.*)/$ /index.php?page=$1 [QSA,L](QSA,L])
     </IfModule>
     php_value auto_prepend_file /path/to/prepend.php
    </Directory>

## Setting up MySQL database

You will need to set up the MySQL database and tables. You will also need to create a MySQL user and give them privileges on the database.

### From The Command Line

To connect to the MySQL command line from a terminal, type:

    $ mysql --host=localhost -uroot -p

You will be prompted for the MySQL root password. Once you are on the MySQL command line, enter the following commands:

    $ CREATE DATABASE IF NOT EXISTS `project-manager`;
    $ CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
    $ GRANT ALL PRIVILEGES ON `project-manager`.* TO 'user'@'localhost' IDENTIFIED BY 'password';
    $ FLUSH PRIVILEGES;

(Be sure and replace "username" and "password" in the commands above with your own values.)

### From phpMyAdmin

If you prefer, you can create the database in phpMyAdmin and then set up a new user with permissions to access the new database under the Privileges tab.

## Importing Data

You can use the included `install.sql` file to create the table structure.

### From The Command Line

    $ mysql -u username -p -h localhost project-manager < install.sql

### From phpMyAdmin

If you prefer, you can import the install.sql file from the Import tab of the database in phpMyAdmin.

## Creating a New User

To create a new user, first you must edit `app/Controller/AppController.php` and look for the following line:

    $this->Auth->allow('login', 'logout');

This line sets which Views may be accessed by users who are not logged in.

You need to add the `add` page to be allowed temporarily so you can create a new user for yourself. Modify the above line to:

    $this->Auth->allow('login', 'logout', 'add');

Now you may visit the `add` view of the `Users` controller by navigating to `/users/add` in your web browser to add the new user.

When you are finished, be sure and remove the `add` option so visitors who are not signed in can't add new users.

## Finished

That's it! Sign in with the username and password you created.

## More Information

Visit the Project Manager at [http://websightdesigns.com/apps/projects/](http://websightdesigns.com/apps/projects/)

Visit the [Project Manager Wiki](http://websightdesigns.com/wiki/Project_Manager) for more information.

You can also view these [Install Instructions](http://websightdesigns.com/wiki/Project_Manager_Install_Instructions) on our wiki.

## Our Website

Please visit the [WebSight Designs](http://websightdesigns.com/) website for more information.