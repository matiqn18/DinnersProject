# DinnersProject

DinnersProject is a web application designed to manage meals and payments for users. This application allows administrators, accountants, and users to manage meal orders, payments, and system data efficiently.

**Note:** This project is currently in development. Systems for administrators and accountants have been created. The current goal is to develop the user panel, and in the future, improve views by adding CSS.


## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Functions](#functions)
- [License](#license)
- [Author](#author)

## Installation

### Prerequisites

- PHP >= 7.4
- Composer
- MySQL
- XAMPP (or any other local server environment)

### Steps

1. **Clone the repository:**

    ```bash
    git clone https://github.com/yourusername/DinnersProject.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd DinnersProject
    ```

3. **Install dependencies:**

    ```bash
    composer install

    composer require dompdf/dompdf #If dompdf/dompdf is not already installed, you can add it using:

    ```
    
## Configuration

### Database
1. **Create Database:**
    Create database named obiadki

2. **Import SQL File:**
    Use your MySQL or MariaDB management tool to import the `obiadki.sql` file. This file contains the necessary table structures and example data.

3. **Ensure your `.env` file contains the correct database configuration::**

    ```ini
    database.default.hostname = localhost
    database.default.database = obiadki
    database.default.username = root
    database.default.password = 
    database.default.DBDriver = MySQLi
    ```

## Usage
### Test User
For testing purposes with administrative privileges, use the following credentials:

Username: testowy
Password: 12345

## Functions
### Administrator Panel
- Current Functionality:
  - Manages meal prices and availability through the admin panel.
  - Views and manages user payments.
  - Implement user management functionalities (e.g. edit, delete users).
- Future Enhancements:
  - Enhance admin panel with data analytics and reporting capabilities.

### Accountant Panel
- Current Functionality:
  - Manages payments made by users.
  - Generates reports related to payments.
  - Generates PDF reports from orders.
  - Edits menu items and upload them from a TXT file.

### User Panel (In Progress)
- Future Functionality:
  - Place meal orders, view order history, and check payment statuses

### Planned Enhancements
- Enhancing views with CSS for improved usability.
- Further development of the user panel.

## License
This project is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License. To view a copy of this license, visit https://creativecommons.org/licenses/by-nc-sa/4.0/.

## Author
Michał matiqn18/Matian Łukaszczyk
