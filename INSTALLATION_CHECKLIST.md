# College Hub - Installation Checklist

## Pre-Installation Requirements

- [ ] XAMPP installed on your system
- [ ] Apache server available
- [ ] MySQL server available
- [ ] PHP 7.0 or higher
- [ ] Modern web browser (Chrome, Firefox, Safari, Edge)
- [ ] Administrator access to XAMPP

## Step 1: Start XAMPP Services

- [ ] Open XAMPP Control Panel
- [ ] Click "Start" button for Apache
- [ ] Wait for Apache to show as running (green)
- [ ] Click "Start" button for MySQL
- [ ] Wait for MySQL to show as running (green)
- [ ] Verify both services are running before proceeding

## Step 2: Create Database

- [ ] Open web browser
- [ ] Navigate to `http://localhost/phpmyadmin`
- [ ] Verify phpMyAdmin loads successfully
- [ ] Click "New" to create new database
- [ ] Enter database name: `collegehub_db`
- [ ] Select charset: `utf8_general_ci`
- [ ] Click "Create" button
- [ ] Database `collegehub_db` should now appear in left sidebar

## Step 3: Import Database Schema

### Method A: Using phpMyAdmin
- [ ] Select `collegehub_db` from left sidebar
- [ ] Click "SQL" tab
- [ ] Open `database/schema.sql` file in text editor
- [ ] Copy all SQL content
- [ ] Paste into phpMyAdmin SQL editor
- [ ] Click "Go" to execute
- [ ] Verify no errors appear

### Method B: Using Command Line
- [ ] Open Command Prompt
- [ ] Navigate to XAMPP MySQL bin directory: `cd C:\xampp\mysql\bin`
- [ ] Run: `mysql -u root -p collegehub_db < C:\path\to\schema.sql`
- [ ] Press Enter (no password needed if default)
- [ ] Verify command completes successfully

## Step 4: Verify Database Tables

- [ ] Go back to phpMyAdmin
- [ ] Select `collegehub_db` database
- [ ] Verify these tables exist:
  - [ ] `users` table
  - [ ] `notices` table
  - [ ] `lostfound` table
- [ ] Click each table to verify structure

## Step 5: Copy Project Files

- [ ] Locate XAMPP installation folder (usually `C:\xampp`)
- [ ] Navigate to `C:\xampp\htdocs\`
- [ ] Copy entire `collegelibraryhub` folder here
- [ ] Verify folder structure is correct:
  - [ ] `index.html` exists
  - [ ] `css/` folder exists
  - [ ] `js/` folder exists
  - [ ] `views/` folder exists
  - [ ] `backend/` folder exists
  - [ ] `database/` folder exists

## Step 6: Verify File Permissions

- [ ] Right-click `collegelibraryhub` folder
- [ ] Select "Properties"
- [ ] Go to "Security" tab
- [ ] Verify "Users" group has "Modify" permission
- [ ] Click "Apply" and "OK"

## Step 7: Test Installation

- [ ] Open web browser
- [ ] Navigate to `http://localhost/collegelibraryhub/`
- [ ] Verify page loads without errors
- [ ] Check browser console (F12) for any JavaScript errors
- [ ] Verify header displays correctly with "College Hub" title
- [ ] Verify navigation menu appears

## Step 8: Verify Backend Connection

- [ ] Navigate to `http://localhost/collegelibraryhub/backend/verify_installation.php`
- [ ] Check the JSON output:
  - [ ] `php_version_ok` should be `true`
  - [ ] `mysqli_ok` should be `true`
  - [ ] `session_ok` should be `true`
  - [ ] `database_ok` should be `true`
  - [ ] `all_ok` should be `true`

## Step 9: Test User Registration

- [ ] Click "Register" button in header
- [ ] Fill in registration form:
  - [ ] Name: Test User
  - [ ] Email: test@example.com
  - [ ] Phone: 9876543210
  - [ ] Password: TestPass123
  - [ ] Confirm Password: TestPass123
- [ ] Click "Register" button
- [ ] Verify success message appears
- [ ] Verify redirected to login page

## Step 10: Test User Login

- [ ] Enter email: test@example.com
- [ ] Enter password: TestPass123
- [ ] Click "Login" button
- [ ] Verify success message appears
- [ ] Verify header now shows "Welcome, Test User"
- [ ] Verify "Logout" button appears

## Step 11: Test Notices Feature

- [ ] Click "Notices" in navigation
- [ ] Click "Add Notice" button
- [ ] Fill in form:
  - [ ] Title: Test Notice
  - [ ] Description: This is a test notice
- [ ] Click "Post Notice" button
- [ ] Verify success message appears
- [ ] Verify notice appears in the list below

## Step 12: Test Lost & Found Feature

- [ ] Click "Lost & Found" in navigation
- [ ] Click "Post Lost Item" button
- [ ] Fill in form:
  - [ ] Item Name: Test Item
  - [ ] Description: This is a test item
  - [ ] Your Name: Test User
- [ ] Click "Post Item" button
- [ ] Verify success message appears
- [ ] Verify item appears in the list below

## Step 13: Test CGPA Calculator

- [ ] Click "CGPA Calculator" in navigation
- [ ] Verify semester input appears
- [ ] Enter GPA: 3.5
- [ ] Enter Credits: 12
- [ ] Verify CGPA displays as 3.50
- [ ] Click "Add Semester"
- [ ] Enter GPA: 3.8
- [ ] Enter Credits: 12
- [ ] Verify CGPA updates correctly
- [ ] Click "Reset" button
- [ ] Verify calculator resets

## Step 14: Test Logout

- [ ] Click "Logout" button
- [ ] Verify redirected to home page
- [ ] Verify "Login" and "Register" buttons appear again
- [ ] Verify "Welcome" message is gone

## Step 15: Test Responsive Design

- [ ] Open browser developer tools (F12)
- [ ] Click device toggle (mobile view)
- [ ] Test on iPhone (375px width)
  - [ ] Verify layout adjusts
  - [ ] Verify navigation is accessible
  - [ ] Verify forms are usable
- [ ] Test on iPad (768px width)
  - [ ] Verify layout adjusts
  - [ ] Verify all features work
- [ ] Test on desktop (1200px+)
  - [ ] Verify full layout displays

## Step 16: Test Error Handling

- [ ] Try registering with invalid email
  - [ ] Verify error message appears
- [ ] Try registering with short password
  - [ ] Verify error message appears
- [ ] Try logging in with wrong password
  - [ ] Verify error message appears
- [ ] Try posting notice with empty fields
  - [ ] Verify error message appears

## Step 17: Verify Database Data

- [ ] Go to phpMyAdmin
- [ ] Select `collegehub_db` database
- [ ] Click on `users` table
- [ ] Verify test user exists
- [ ] Click on `notices` table
- [ ] Verify test notice exists
- [ ] Click on `lostfound` table
- [ ] Verify test item exists

## Step 18: Final Verification

- [ ] All pages load without errors
- [ ] All forms work correctly
- [ ] All AJAX calls complete successfully
- [ ] Database operations work
- [ ] Session management works
- [ ] Responsive design works
- [ ] No console errors (F12)
- [ ] No PHP errors in error log

## Troubleshooting

If any step fails:

### Database Connection Issues
- [ ] Verify MySQL is running in XAMPP
- [ ] Check `backend/config.php` credentials
- [ ] Verify database name is `collegehub_db`
- [ ] Check phpMyAdmin can connect

### Page Not Loading
- [ ] Verify Apache is running
- [ ] Check file path is `C:\xampp\htdocs\collegelibraryhub\`
- [ ] Clear browser cache (Ctrl+Shift+Delete)
- [ ] Check browser console for errors

### Forms Not Working
- [ ] Check browser console (F12) for JavaScript errors
- [ ] Verify PHP files exist in `backend/` folder
- [ ] Check Network tab in developer tools for failed requests
- [ ] Verify XAMPP is serving PHP files

### Database Tables Missing
- [ ] Re-import `database/schema.sql`
- [ ] Verify SQL executed without errors
- [ ] Check phpMyAdmin for table existence

## Success Criteria

✅ All steps completed without errors
✅ All features working as expected
✅ Database contains test data
✅ No console errors
✅ Responsive design verified
✅ All forms validated
✅ Session management working
✅ Ready for production use

## Next Steps

After successful installation:
1. Create additional user accounts
2. Post more notices and items
3. Test CGPA calculator with various inputs
4. Explore all features
5. Customize styling if needed
6. Deploy to production server

## Support

If you encounter any issues:
1. Check README.md for detailed documentation
2. Review SETUP_GUIDE.md for quick help
3. Check browser console (F12) for errors
4. Verify all files are in correct locations
5. Ensure XAMPP services are running

---

**Installation Status**: [ ] Complete

**Date Completed**: _______________

**Verified By**: _______________
