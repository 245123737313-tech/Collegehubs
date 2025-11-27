# College Hub - Student Portal

A comprehensive web-based student portal built with HTML, CSS, JavaScript, jQuery, AngularJS, PHP, and MySQL.

## Tech Stack
- **Frontend**: HTML, CSS, JavaScript, jQuery, AngularJS (v1.x)
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP (Apache + MySQL)

## Features
1. **User Authentication**
   - Secure login and registration system
   - Session management
   - Role-based access control

2. **Notices Board**
   - View all college notices
   - Post new notices (for authorized users)
   - Delete notices with confirmation

3. **Lost & Found**
   - Report lost items
   - Browse found items
   - Delete your own posts

4. **Study Materials**
   - Upload and share files (PDF, DOC, PPT, etc.)
   - Download study materials
   - Delete your uploaded files
   - File type and size validation
   - Organized by subject and semester

5. **Responsive Design**
   - Works on all devices (desktop, tablet, mobile)
   - Clean and intuitive interface
   - Fast and efficient loading

## Project Structure
```
collegelibraryhub/
├── index.html              # Main application file
├── css/
│   └── style.css          # All styling
├── js/
│   ├── app.js             # AngularJS app and routing
│   ├── controllers/
│   │   ├── authController.js
│   │   ├── noticesController.js
│   │   ├── lostFoundController.js
│   │   └── studyMaterialsController.js
│   └── services/
│       └── apiService.js
├── views/
│   ├── home.html
│   ├── notices.html
│   ├── lostfound.html
│   ├── cgpa.html
│   ├── login.html
│   └── register.html
├── backend/
│   ├── connect.php
│   ├── register.php
│   ├── login.php
│   ├── logout.php
│   ├── add_notice.php
│   ├── fetch_notices.php
│   ├── add_lostitem.php
│   ├── fetch_lostitems.php
│   └── check_session.php
└── database/
    └── schema.sql
```

## Getting Started

### Prerequisites
- XAMPP (Apache + MySQL) or similar web server
- PHP 7.4+
- MySQL 5.7+
- Modern web browser (Chrome, Firefox, Edge, Safari)

### File Upload Requirements
- `uploads/study_materials/` directory must be writable
- Maximum file size: 50MB
- Allowed file types: PDF, DOC, DOCX, PPT, PPTX, TXT
- MySQL 5.7 or higher

### Step 1: Create Database
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create a new database named `collegehub_db`
3. Import the `database/schema.sql` file to create tables

**Alternative**: Run this SQL directly in phpMyAdmin:
```sql
CREATE DATABASE IF NOT EXISTS collegehub_db;
USE collegehub_db;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS notices (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS lostfound (
    id INT PRIMARY KEY AUTO_INCREMENT,
    item_name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    posted_by VARCHAR(100) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Step 2: Place Files in XAMPP
1. Copy the entire `collegelibraryhub` folder to `C:\xampp\htdocs\`
2. The project should be accessible at: `http://localhost/collegelibraryhub/`

### Step 3: Run the Application
1. Start Apache and MySQL from XAMPP Control Panel
2. Open your browser and navigate to `http://localhost/collegelibraryhub/`
3. You should see the College Hub home page

## Troubleshooting

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/245123737313-tech/Collegehubs.git
   cd Collegehubs
   ```

2. Set up the database:
   - Open phpMyAdmin
   - Create a new database named `collegehub_db`
   - Import the schema from `database/schema.sql`

3. Configure file uploads:
   ```bash
   mkdir -p uploads/study_materials
   chmod 755 uploads uploads/study_materials
   ```

4. Start the server:
   - Launch XAMPP Control Panel
   - Start Apache and MySQL
   - Access the application at `http://localhost/Collegelibraryhub`

### Database Connection Error
- Ensure MySQL is running in XAMPP
- Check if `collegehub_db` database exists
- Verify credentials in `backend/connect.php`

### Pages Not Loading
- Check if Apache is running
- Verify the project path is correct
- Clear browser cache

### AJAX Requests Failing
- Check browser console for errors
- Ensure PHP files are in the correct location
- Verify XAMPP is serving PHP files correctly

## Usage

### Registration
1. Click "Register" button in the header
2. Fill in your details (Name, Email, Phone, Password)
3. Submit the form
4. You'll be redirected to login page

### Login
1. Click "Login" button in the header
2. Enter your email and password
3. Click Login

### Viewing Notices
1. Click "Notices" in the navigation
2. View all posted notices
3. If logged in, you can post new notices

### Lost & Found
1. Click "Lost & Found" in the navigation
2. Browse all lost items
3. If logged in, you can post a lost item

### Study Materials
1. Click "Study Materials" in the navigation
2. Browse all study materials
3. If logged in, you can upload a study material
## API Endpoints

### Authentication
- `POST /backend/register.php` - Register new user
- `POST /backend/login.php` - Login user
- `GET /backend/logout.php` - Logout user
- `GET /backend/check_session.php` - Check if user is logged in

### Notices
- `GET /backend/fetch_notices.php` - Get all notices
- `POST /backend/add_notice.php` - Add new notice

### Lost & Found
- `GET /backend/fetch_lostitems.php` - Get all lost items
- `POST /backend/add_lostitem.php` - Add new lost item

## Database Schema

### Users Table
```sql
id (INT, Primary Key, Auto Increment)
name (VARCHAR 100)
email (VARCHAR 100, Unique)
phone (VARCHAR 15)
password (VARCHAR 255)
created_at (TIMESTAMP)
```

### Notices Table
```sql
id (INT, Primary Key, Auto Increment)
title (VARCHAR 200)
description (TEXT)
date (TIMESTAMP)
```

### Lost & Found Table
```sql
id (INT, Primary Key, Auto Increment)
item_name (VARCHAR 150)
description (TEXT)
posted_by (VARCHAR 100)
date (TIMESTAMP)
```

## Security Features
- Password hashing using PHP's `password_hash()` function
- Session-based authentication
- SQL injection prevention using prepared statements
- Email validation
- Phone number validation (10 digits)
- Password confirmation on registration

## Browser Compatibility
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

- Verify XAMPP is serving PHP files correctly

## Future Enhancements
- Email notifications
- User profile management
- Advanced search functionality
- File uploads for lost items
- Admin dashboard
- Messaging system between users

## License
This project is open source and available for educational purposes.

## Support
For issues or questions, please refer to the documentation or contact the development team.
