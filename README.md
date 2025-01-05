# Readme (Yii2 Blog)

**Readme** is a web application developed using the [Yii2 Framework](https://www.yiiframework.com/). This project serves as a foundational platform for blogging, featuring essential functionalities such as user authentication, post creation, and commenting. Please note that the project is currently incomplete, with the admin dashboard pending development.

## Features

- **User Authentication:** Secure login and registration system.
- **Post Management:** Create, edit, and delete blog posts.
- **Commenting System:** Users can comment on posts.
- **Responsive Design:** Optimized for various devices.

## Installation

### Prerequisites

- PHP 7.4 or higher.
- Composer.
- A web server (e.g., Apache, Nginx).
- A database server (e.g., MySQL, PostgreSQL).

### Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/dwiwijaya/readme.git
   ```
2. **Navigate to the project directory:**
   ```bash
   cd readme
   ```
3. **Install dependencies:**
   ```bash
   composer install
   ```
4. **Set up the database:**
   - Create a new database for the application.
   - Configure the database connection in `config/db.php`.
   - Apply migrations to set up the necessary tables:
     ```bash
     php yii migrate
     ```
5. **Set file permissions:**
   Ensure that the `runtime` and `web/assets` directories are writable by the web server.

6. **Configure the web server:**
   - Point the document root to the `web` directory.
   - Ensure URL rewriting is enabled for pretty URLs.

7. **Access the application:**
   Open your browser and navigate to the configured domain or `http://localhost/path-to-project/web/`.

## Usage

- **Register an account** to start creating blog posts.
- **Create, edit, or delete posts** through the user interface.
- **Interact with posts** by adding comments.

## Development Status

This project is a work in progress and is not fully functional. The admin dashboard, which would allow for advanced content management and administrative tasks, has not been implemented. Contributions are welcome to help complete this feature.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your improvements or feature additions.

## License

This project is licensed under the BSD-3-Clause License. See the `LICENSE.md` file for details.

