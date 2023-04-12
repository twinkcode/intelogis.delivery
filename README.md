
project use sqlite (`database/db_delivery.sqlite`)

from project folder run   
after clone repo rename or copy env.example to .env  
`cp .env.example .env`  

then migration
`php ./database/migrations.php`

then seed  
`php .\database\seeders.php -c=15`  
where '15' — variable count of rows in table 'shipments'  
  
for run server execute:  
`php -S localhost:8000 -t public/`  
  
then browse http://localhost:8000/

PS: for drop data in table use:  
`php ./database/migrations.php down`
then `php ./database/migrations.php` 
