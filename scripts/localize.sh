#!/bin/bash

# Run php command
php artisan key:generate

php artisan db:wipe

php artisan migrate

php artisan db:seed

php artisan storage:link

chmod -R 755 storage

# Ask for the port to use or use the default (8000)
echo "Enter the port number to use for the Laravel development server (default: 8000):"
read -r port
if [ -z "$port" ]; then
    port=8000
fi

# Check if the specified port is in use
while true; do
    if command_exists nc; then
        if nc -z 127.0.0.1 "$port"; then
            echo "Port $port is already in use. Please choose another port:"
            read -r port
        else
            break
        fi
    else
        break
    fi
done

# Run the Laravel development server
php artisan serve --port="$port"

echo "[DONE] Laravel development server is running on port $port. Open http://localhost:$port in your browser to view the app. Press Ctrl+C to stop the server."