# Kursmatch - Manual
------------------------------------------------------
------------------------------------------------------

## Application Structure

### Shibboleth
- Shibboleth needs to pass the property 'matrikelnummer' in $_SERVER
- Folder ‘/student’ needs to be shielded via Apache2 sites-available 

### Apache
- In sites-available there need to be 2 virtual hosts:
	(1) /student		/var/www/html/student/public
	-> the 1. folder is protected via Shibboleth
	(2) /exchange	/var/www/html/exchange/public
	-> this 2. folder must not be included in Shibboleth protection

### Database
- Database: 'kursmatch' (mysql)
- Authentification: kursmatch : Hewf.BN?cqY6]]ZH (is defined in .env in the root of /student

## Git
- 'git pull' in root folder near '/var/www/html/...'

## Other
- Apache2, Mysql-Server, Php-7.2
- Github: https://github.com/svengiegerich/kursmatch.local
- 'php artisan' & 'composer'
- Specific passwords in .env

# After the Registration Phase

## Fetch Anonymise Preferences
- Url: /student/**7uvmvnm0yz**
- Files are created at '/storage/app' and read students.csv (aid and id), programs.csv and preferences.csv
- SQL of preferences.csv: SELECT preferences.prid, preferences.id_to_1, preferences.id_to_2, preferences.pr_kind, preferences.rank, preferences.status, preferences.created_at, preferences.updated_at, applicants.anonymised_id
FROM preferences
INNER JOIN applicants ON applicants.aid=preferences.id_from;


17.12.2018, Sven Giegerich, ZEW