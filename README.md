# PHP Authentication System (Manual MVC)

A simple authentication system built with PHP using a manual MVC structure. Features include:

- User registration and login with password hashing.
- Role-based access control (Admin/User).
- Real-time front-end form validation
- Secure session-based authentication

### Requirements
XAMPP (PHP 7.4+ and MySQL)


### Setup Instructions (XAMPP)

1. **Clone or download this repo**

   Place the project in your XAMPP `htdocs` folder:  
   `C:\xampp\htdocs\php-auth-mvc`

2. **Start Apache and MySQL** via XAMPP Control Panel

3. **Create a database**

   - Open `http://localhost/phpmyadmin`
   - Create a new database (e.g., `auth_system`)
   - Import the provided `.sql` file

4. **Configure the project**

   - Open `/app/config/config.php`
   - Set your database credentials (DB name, user, password)

5. **Visit the app**

   - Open browser and go to:  
     `http://localhost/php-authentication-mvc/public`
