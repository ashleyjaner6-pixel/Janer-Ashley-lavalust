FROM php:8.2-apache

# Install PHP extensions used by LavaLust and product validation
RUN apt-get update && apt-get install -y --no-install-recommends libonig-dev && \
  docker-php-ext-install pdo pdo_mysql mbstring && \
  rm -rf /var/lib/apt/lists/*

# Enable Apache URL rewrite module for LavaLust routing
RUN a2enmod rewrite

# Keep framework runtime directories writable by Apache.
RUN mkdir -p /var/www/html/runtime/session /var/www/html/runtime/logs && \
  chown -R www-data:www-data /var/www/html/runtime

# Copy project files into web root
COPY . /var/www/html/

WORKDIR /var/www/html/

ENV PORT=10000
EXPOSE 10000

CMD sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf 2>/dev/null || true; \
    if [ -f /etc/apache2/sites-available/000-default.conf ]; then \
      sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf 2>/dev/null || true; \
    fi; \
    apache2-foreground