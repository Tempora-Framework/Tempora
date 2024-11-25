# Installation

## VirtualHost

### Apache2 minimal configuration

```html
<VirtualHost *:80>
        ServerName php-mvc-template.local
        DocumentRoot /var/www/PHP-MVC-Template/public

        <Directory /var/www/PHP-MVC-Template/public>
                DirectoryIndex /index.php
                FallbackResource /index.php
        </Directory>
</VirtualHost>
```

### Nginx minimal configuration

```nginx
server_name php-mvc-template.local;

root /var/www/php-mvc-template/public;

index /index.php;
```
