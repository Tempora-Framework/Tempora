# Installation

## VirtualHost

### Apache2 minimal configuration

```html
<VirtualHost *:80>
        ServerName tempora.local
        DocumentRoot /var/www/Tempora/public

        <Directory /var/www/Tempora/public>
                DirectoryIndex /index.php
                FallbackResource /index.php
        </Directory>
</VirtualHost>
```

### Nginx minimal configuration

```nginx
server_name tempora.local;

root /var/www/Tempora/public;

index /index.php;
```
