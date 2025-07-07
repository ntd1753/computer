##### 1. Setup follow steps below:

```

# Edit data bellow:
# DB_CONNECTION=mysql
# DB_HOST=db
# DB_PORT=3306
# DB_DATABASE=computer
# DB_USERNAME=root
# DB_PASSWORD=


# Create docker network
docker network create --driver=bridge --attachable computer_shop

# Run docker
docker compose up --build -d

# Enter docker container
docker exec -it computer_shop-app bash

# Run composer inside docker container
composer install

# Generate key
php artisan key:generate

# Run migrate inside docker container
php artisan migrate

# Run seeder
php artisan db:seed

```

##### 2. Edit file host:

```

# add this line to host file
127.0.0.1 computer-shop.local

```

##### 3. Go to website in browser by url bellow:

UserName: admin  
Password: 123456  
Email: admin@gmail.com


```

# embedded data production
php artisan products:generate-embeddings

```
