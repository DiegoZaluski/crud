FROM httpd:alpine

RUN apk add --no-cache php php-apache2 php-sqlite3

COPY data/ /usr/local/apache2/htdocs/
COPY pack/ /usr/local/apache2/htdocs/
COPY test.php /usr/local/apache2/htdocs/

RUN php /usr/local/apache2/htdocs/test.php
