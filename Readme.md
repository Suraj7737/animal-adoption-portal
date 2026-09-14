# Animal Adoption Enquiry Portal
# Project Overview & Reference Notes

This text file contains a summary of the key components for the Animal Adoption Enquiry Portal:

1. Architecture:
   - Frontend: HTML5 & CSS3 (styled form & record list interface)
   - Backend: PHP with MySQLi
   - Database: MySQL (hosted on InfinityFree / cPanel)

2. Core Files:
   - index.php: Home page and enquiry submission form.
   - save.php: Backend script handling data validation and insertion.
   - view.php: Displays all submitted enquiries with real-time status updates.
   - search.php: Filter and search enquiries by animal, city, or applicant name.
   - config.php: Database credentials and connection handling.
   - database.sql: Table definitions and seed data.
   - style.css: Application styles.

3. Key Security Measures:
   - Prepared Statements: Using mysqli_prepare() and '?' placeholders for all user inputs.
