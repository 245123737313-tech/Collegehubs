# College Hub - Quick Setup Guide

## ⚡ Quick Start (5 Minutes)

### 1. Start XAMPP
- Open XAMPP Control Panel
- Click "Start" for Apache
- Click "Start" for MySQL
- Wait for both to show as running (green)

### 2. Create Database
- Open browser and go to: `http://localhost/phpmyadmin`
- Click "New" to create a new database
- Database name: `collegehub_db`
- Click "Create"
- Select the new database
- Go to "SQL" tab
- Copy and paste the SQL from `database/schema.sql`
- Click "Go" to execute

### 3. Copy Project Files
- Copy the entire `collegelibraryhub` folder
- Paste it in: `C:\xampp\htdocs\`

### 4. Access the Application
- Open browser
- Go to: `http://localhost/collegelibraryhub/`
- You should see the College Hub home page

## 📝 First Steps

### Create an Account
1. Click "Register" button (top right)
2. Fill in your details:
   - Full Name: Your name
   - Email: your@email.com
   - Phone: 10-digit number
   - Password: At least 6 characters
3. Click "Register"
4. You'll be redirected to login

### Login
1. Click "Login" button
2. Enter your email and password
3. Click "Login"
4. You'll see "Welcome, [Your Name]" in the header

### Post a Notice
1. Click "Notices" in the navigation
2. Click "Add Notice" button
3. Fill in title and description
4. Click "Post Notice"

### Post a Lost Item
1. Click "Lost & Found" in the navigation
2. Click "Post Lost Item" button
3. Fill in item name, description, and your name
4. Click "Post Item"

### Calculate CGPA
1. Click "CGPA Calculator" in the navigation
2. Enter your GPA and credits for each semester
3. Click "Add Semester" to add more
4. Your CGPA will update automatically

## 🔧 Troubleshooting

### "Cannot connect to database"
- Make sure MySQL is running (green in XAMPP)
- Check if database `collegehub_db` exists in phpMyAdmin
- Verify the SQL schema was imported correctly

### "Page shows blank or 404 error"
- Make sure Apache is running (green in XAMPP)
- Check if folder is in `C:\xampp\htdocs\collegelibraryhub\`
- Try clearing browser cache (Ctrl+Shift+Delete)
- Restart Apache

### "Login/Register not working"
- Check browser console (F12) for errors
- Make sure PHP files are in `backend/` folder
- Verify database tables exist in phpMyAdmin

### "CGPA Calculator not calculating"
- Make sure JavaScript is enabled in browser
- Check browser console for errors
- Try refreshing the page

## 📁 File Structure
```
collegelibraryhub/
├── index.html                 ← Open this in browser
├── README.md                  ← Full documentation
├── SETUP_GUIDE.md            ← This file
├── css/
│   └── style.css             ← All styling
├── js/
│   ├── app.js                ← AngularJS app
│   ├── controllers/          ← Page logic
│   └── services/             ← API calls
├── views/                    ← HTML pages
├── backend/                  ← PHP files
└── database/
    └── schema.sql            ← Database setup
```

## 🚀 What's Included

✅ User Registration & Login
✅ Session Management
✅ Notices Board (Post & View)
✅ Lost & Found (Post & Browse)
✅ CGPA Calculator (Pure JavaScript)
✅ Responsive Design (Mobile & Desktop)
✅ Modern UI with Gradient Header
✅ Form Validation
✅ Security (Password Hashing, SQL Injection Prevention)

## 🔐 Default Test Account
After setting up, you can create your own account. No default accounts are provided for security.

## 📞 Support
If you encounter any issues:
1. Check the README.md for detailed documentation
2. Review the TROUBLESHOOTING section above
3. Check browser console (F12) for error messages
4. Verify all files are in correct locations

## ✨ Features Overview

| Feature | Status | Details |
|---------|--------|---------|
| User Auth | ✅ | Register, Login, Logout |
| Notices | ✅ | Post and view notices |
| Lost & Found | ✅ | Post items and browse |
| CGPA Calc | ✅ | Calculate cumulative GPA |
| Responsive | ✅ | Works on mobile & desktop |
| Security | ✅ | Password hashing, prepared statements |

Enjoy using College Hub! 🎓
