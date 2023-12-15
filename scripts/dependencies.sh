# Function to check if a command is available
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Check if Composer is installed
if ! command_exists composer; then
    echo "Composer is not installed. Please install Composer (https://getcomposer.org/) first."
    exit 1
fi

# Check if PHP is installed
if ! command_exists php; then
    echo "PHP is not installed. Please install PHP (https://www.php.net/downloads.php) first."
    exit 1
fi


# Run Composer install
composer install