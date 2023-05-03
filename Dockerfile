FROM php:7.4-alpine

WORKDIR /var/www/html

# Install PHP extensions and necessary packages
RUN apk add --no-cache \
    openssl \
    oniguruma-dev

# Copy the application files to the container
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set up entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["docker-entrypoint.sh"]

# Expose port if needed
# EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]