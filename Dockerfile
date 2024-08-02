# Use the official PHP image from the Docker Hub
FROM php:7.4-cli

# Copy the current directory contents into the container at /usr/src/myapp
COPY ./app/public/ /usr/src/myapp

# Set the working directory to /usr/src/myapp
WORKDIR /usr/src/myapp

# Run index.php when the container launches
CMD [ "php", "./app/public/index.php" ]
