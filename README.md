# TODO-LIST Web Application

A simple and secure TODO-LIST web application that allows users to register, log in, and manage their tasks. The project is built using **PHP**, **MySQL**, **HTML**, and **CSS**.

## Features
- User Authentication (Sign Up, Login, Logout)
- Password Hashing for Security
- CSRF Protection
- Task Management (Create, Read, Update, Delete Tasks)
- Task Status Management (Pending, In Progress, Completed)
- Mobile-Responsive UI

## Technologies Used
- **Backend**: PHP & MySQL
- **Frontend**: HTML, CSS
- **Database**: MySQL

## Installation
### Prerequisites
Ensure you have the following installed:
- PHP (>=7.4)
- MySQL (>=5.7)
- Apache Server (or use XAMPP/WAMP/LAMP for local development)

### Steps to Set Up
1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/todo-list.git
   cd todo-list
   ```
2. **Set Up the Database**
   - Import the `database.sql` file into your MySQL database
   - Or manually run the following SQL commands:
     ```sql
     CREATE DATABASE todo_db;
     USE todo_db;
     
     CREATE TABLE users (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(255) NOT NULL,
         email VARCHAR(255) UNIQUE NOT NULL,
         password VARCHAR(255) NOT NULL,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     
     CREATE TABLE tasks (
         id INT AUTO_INCREMENT PRIMARY KEY,
         user_id INT NOT NULL,
         title VARCHAR(255) NOT NULL,
         description TEXT,
         status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
         due_date DATE NULL,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
         updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
         FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
     );
     ```
3. **Configure the Database Connection**
   - Open `config/db.php` and update the database credentials:
     ```php
     <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "todo_db";
     
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     ?>
     ```
4. **Start the Server**
   - Run the project using a local server (e.g., XAMPP/WAMP):
     ```bash
     php -S localhost:8000
     ```
   - Open `http://localhost:8000/views/register.php` in your browser.

## Usage
1. **Sign Up** with your name, email, and password.
2. **Login** to access your dashboard.
3. **Add Tasks** to your TODO list.
4. **Update Task Status** as you complete them.
5. **Delete Tasks** if no longer needed.

## Project Structure
```
📂 todo-list/
├── 📁 config/         # Database configuration
│   ├── db.php        # Database connection file
├── 📁 views/          # Frontend UI files
│   ├── register.php  # User registration page
│   ├── login.php     # User login page
│   ├── index.php     # Main task dashboard
├── 📁 assets/         # CSS and images
│   ├── style.css     # Styling for the UI
├── 📁 tasks/          # Task operations
│   ├── add_task.php  # Add a new task
│   ├── delete_task.php # Delete a task
│   ├── update_task.php # Update task status
├── README.md          # Documentation
├── .gitignore         # Ignore unnecessary files
```

## Security Best Practices Implemented
✔️ **Prepared Statements** to prevent SQL injection.
✔️ **Password Hashing** using `password_hash()`.
✔️ **CSRF Protection** to prevent unauthorized actions.
✔️ **Session Management** for user authentication.

## Future Enhancements
- Add Email Verification
- Implement Task Priorities
- Integrate API for Mobile Access
- Improve UI with Bootstrap or TailwindCSS

## Contributing
Feel free to fork this repository and contribute. If you find a bug or have a feature request, create an issue!

## License
This project is open-source and available under the **MIT License**.

---
✨ Developed by [Sachin Kumar](https://github.com/Sachin-Kumar-08) ✨

