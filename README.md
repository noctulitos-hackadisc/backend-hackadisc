## Installation guide

Before you start, make sure you have [Git](https://git-scm.com/downloads), [Xampp](https://www.apachefriends.org/es/index.html) (to install php), [Composer](https://getcomposer.org/) and [Visual Studio Code](https://code.visualstudio.com/download) installed on your system.

Clone the project to the folder of your choice using the following command using git or the windows command prompt:

```bash
git clone https://github.com/noctulitos-hackadisc/backend-hackadisc
```

Then open the folder using Visual studio code and continue with the guide.

### Laravel API

To configure Laravel, you must open a terminal with the path inside the 'backend-hackadisc' folder, then follow these steps:

1. **Install PHP dependencies with Composer:**

```bash
composer install
```
In the event that there is some type of error that requires updating composer, execute:

```bash
composer update
```

In the case of presenting the error: "Failed to download ... from dist: the zip extension and unzip/7z commands are both missing, skipping. The php.ini used...". You must go to the following path: C:\xampp\php\php.ini and uncomment line 962: 'extension=zip' of the php.ini file. Now run composer install again.

This command will install the necessary PHP dependencies for the project.

2. **Configure environment variables:**

```bash
copy .env.example .env
```

This command will copy the .env.example file to .env. Here you can configure the database.

3. **Populate the database:**

```bash
php artisan migrate --seed
```

This command will create and populate the tables in the database. Make sure the database is operational and matches the configuration previously made in the .env file.

4. **Start the Laravel server:**

```bash
php artisan serve
```

This command will start the Laravel server locally.
