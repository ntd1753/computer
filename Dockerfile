# Use PHP 8.3 with FPM
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install Node.js and npm (v18.x)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN apt-get install -y libzip-dev \
    && docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set PHP memory limits
RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
RUN echo 'max_input_vars = 20000' >> /usr/local/etc/php/conf.d/docker-php-max_input_vars.ini
RUN echo 'upload_max_filesize = 4096M' >> /usr/local/etc/php/conf.d/docker-php-upload_max_filesize.ini
RUN echo 'post_max_size = 4096M' >> /usr/local/etc/php/conf.d/docker-php-post_max_size.ini

# Define build arguments
ARG user
ARG uid

# Create system user to run Composer and npm
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www

# Copy application source code into container
COPY . .

# Run composer update to install dependencies and generate lock file
RUN composer update --optimize-autoloader --prefer-dist
RUN rm -rf node_modules package-lock.json
# Install npm dependencies
RUN npm install

# Build the frontend if needed
RUN npm run build

# Switch to non-root user
USER $user
