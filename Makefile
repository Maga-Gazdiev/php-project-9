fix:
	phpcbf -p -s -v -n . --extensions=php
start:
	php artisan serve 