# Laravel & WordPress Dockerized Project - AIGen

This project integrates a Laravel API backend with a WordPress frontend, both running in Docker containers for easy setup and development. The setup uses PHP 8.1 for Laravel and the official WordPress Docker image. The MySQL database is shared between both applications.

## Prerequisites

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Project Structure

```
.
├── __demo
├── app
├── artisan
├── bootstrap
├── composer.json
├── composer.lock
├── config
├── database
├── docker-compose.yml
├── Dockerfile.laravel
├── Dockerfile.wordpress
├── gulpfile.mjs
├── index.php
├── lang
├── package-lock.json
├── package.json
├── phpunit.xml
├── postcss.config.js
├── public
├── readme.html
├── resources
├── routes
├── storage
├── tailwind.app.config.js
├── tailwind.config.js
├── tailwind.site.config.js
├── tests
├── tmp
├── vendor
├── version.txt
├── vite.config.js
├── wp-activate.php
├── wp-admin
├── wp-blog-header.php
├── wp-comments-post.php
├── wp-config-sample.php
├── wp-config.php
├── wp-content
├── wp-cron.php
├── wp-includes
├── wp-links-opml.php
├── wp-load.php
├── wp-login.php
├── wp-mail.php
├── wp-settings.php
├── wp-signup.php
├── wp-trackback.php
└── xmlrpc.php
```

## Setup

### Step 1: Clone the Repository

```sh
git clone https://github.com/yourusername/your-repo.git
cd your-repo
```

### Step 2: Create the `.env` File

Create a `.env` file in the root directory and add the following:

```env
# MySQL root password
MYSQL_ROOT_PASSWORD=root

# Laravel database configuration
MYSQL_DATABASE_LARAVEL=laravel
MYSQL_USER_LARAVEL=laravel
MYSQL_PASSWORD_LARAVEL=laravel

# WordPress database configuration
MYSQL_DATABASE_WORDPRESS=wordpress
MYSQL_USER_WORDPRESS=wordpress
MYSQL_PASSWORD_WORDPRESS=wordpress

# WordPress authentication unique keys and salts
AUTH_KEY=your_auth_key
SECURE_AUTH_KEY=your_secure_auth_key
LOGGED_IN_KEY=your_logged_in_key
NONCE_KEY=your_nonce_key
AUTH_SALT=your_auth_salt
SECURE_AUTH_SALT=your_secure_auth_salt
LOGGED_IN_SALT=your_logged_in_salt
NONCE_SALT=your_nonce_salt
WP_CACHE_KEY_SALT=your_wp_cache_key_salt
```

### Step 3: Build and Start the Containers

Run the following command to build and start the Docker containers:

```sh
docker-compose up --build
```

### Step 4: Accessing the Applications

- **Laravel Application**: [http://localhost:8080](http://localhost:8080)
- **WordPress Application**: [http://localhost:8081](http://localhost:8081)

## Docker Configuration

### Docker Compose File

The `docker-compose.yml` is available int he project.


### Laravel Dockerfile

The `Dockerfile.laravel` is available int he project.` is available int he project.

### WordPress Dockerfile

The `Dockerfile.wordpress` is available int he project.` is available int he project.


## Accessing MySQL Databases

### From Host Machine (using MySQL Client or MySQL Workbench)
- Host: `localhost`
- Port: `3306`
- Username: `root`
- Password: `root`
- For Laravel Database:
    - Database Name: `laravel`
    - Username: `laravel`
    - Password: `laravel`
- For WordPress Database:
    - Database Name: `wordpress`
    - Username: `wordpress`
    - Password: `wordpress`

### From Within a Docker Container

```sh
docker exec -it mysql-db bash
mysql -u root -p
# Enter the root password when prompted (root)
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- [Laravel](https://laravel.com/)
- [WordPress](https://wordpress.org/)
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
```

### Explanation

- The **Prerequisites** section lists the necessary tools.
- The **Project Structure** section provides an overview of the project's files and folders.
- The **Setup** section includes step-by-step instructions to get the project up and running.
- The **Docker Configuration** section includes the `docker-compose.yml`, `Dockerfile.laravel`, and `Dockerfile.wordpress`.
- The **Accessing MySQL Databases** section explains how to connect to the MySQL databases.
- The **License** and **Acknowledgments** sections give credit and information about the project's licensing.