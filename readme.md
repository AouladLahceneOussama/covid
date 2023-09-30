# Covid monitor
This application is made using PHP and mongo db database, its main idea is to keep the Moroccan people informed about the last statistics of Covid 19 on Morrocan territory

# requirement
PHP >= 8.1  
Node >= 18  
mongodb  
mongodb php extention installed and enabled  

# Instruction to install the application
```
git clone ...
cd covid
composer install
cp .env.example .env
```
> Add you database connection information to the env file  
> Serve it as you want

# Usage
To create database and collections use the following command
```
php app/Commands/command.php db:create
```

To load data from the data files use the following command
```
php app/Commands/command.php db:load
```

Check the files from here [data files](https://github.com/AouladLahceneOussama/covid-data)

# Docker
Coming soon