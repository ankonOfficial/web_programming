-- Create Database
CREATE DATABASE IF NOT EXISTS task_management_system;
USE task_management_system;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tasks Table
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    status ENUM('Pending', 'In Progress', 'Completed') DEFAULT 'Pending',
    priority ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
    due_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert Demo User (password: demo123)
INSERT INTO users (username, email, password, full_name) VALUES 
('demo_user', 'demo@example.com', '$2y$10$8K1p/a0dL3LKCLQvWbL0seMLQMC9Gux5rYYQKJG5MxvGDdPvE6M7C', 'Demo User');

-- Insert Demo Tasks
INSERT INTO tasks (user_id, title, description, status, priority, due_date) VALUES
(1, 'Complete project documentation', 'Write comprehensive documentation for the task management system', 'In Progress', 'High', '2024-12-20'),
(1, 'Review code', 'Review and refactor the codebase', 'Pending', 'Medium', '2024-12-25'),
(1, 'Test application', 'Perform thorough testing of all features', 'Pending', 'High', '2024-12-22'),
(1, 'Deploy to server', 'Deploy application to production server', 'Pending', 'Low', '2024-12-30');
