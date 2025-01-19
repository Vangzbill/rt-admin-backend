# rt-admin-backend

### Specific Instructions

1. **Clone the repository:**
    ```bash
    git clone https://github.com/Vangzbill/rt-admin-backend.git
    cd rt-admin-backend
    ```

2. **Install dependencies:**
    ```bash
    composer install
    ```

3. **Set up environment variables:**
    Copy the `.env.example` file to `.env` and update the necessary environment variables.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Start MySQL database:**
    Ensure MySQL is running on your local machine or update the MySQL connection string in the `.env` file.

5. **Make a folder for image storage and then link it:**
    ```bash
    mkdir public/storage
    php artisan storage:link
    ```

6. **Run database migrations:**
    ```bash
    php artisan migrate
    ```

7. **Start the application:**
    ```bash
    php artisan route:cache
    php artisan serve
    ```

8. **Access the application:**
    Open your browser and navigate to `http://localhost:8000`

Your Laravel project should now be up and running.
