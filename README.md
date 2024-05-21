# Codecademy Clone

This repository is designed with the MVC (Model-View-Controller) architecture, supporting both user and admin functionalities. It uses MongoDB for flexible data storage and MySQL for structured data management.

## Table of Contents

1. [User Features](#user-features)
2. [Admin Panel Features](#admin-panel-features)
3. [API Endpoints](#api-endpoints)
   - [GET Methods](#get-methods)
   - [POST Methods](#post-methods)
4. [Authentication System Overview](#authentication-system-overview)
   - [User Authentication Flow](#user-authentication-flow)
   - [User Registration Flow](#user-registration-flow)
   - [Error Handling](#error-handling)
   - [Middleware and Controllers](#middleware-and-controllers)
   - [Security](#security)
5. [Database Usage](#database-usage)
   - [MongoDB](#mongodb)
   - [MySQL](#mysql)
6. [Dependencies](#dependencies)

## User Features

- **Authentication**
- **Course Catalog**
- **Course Upload**
- **Pricing Plans**

## Admin Panel Features

- **CRUD Operations**: Manage database entries through a user-friendly interface with modals for data entry and confirmation.
- **Schema and Table Management**: View and manage database schemas and tables using a dynamic sidebar tree structure.
- **Search Functionality**: Search through the database.
- **Query Execution**: Execute custom SQL queries and display results in a table format.
- **Stored Procedures and Functions**: List and manage stored procedures and functions.

## API Endpoints

### GET Methods

- **`/api/getTables`**: Fetches all tables from a specified schema.
- **`/api/getTableData`**: Fetches data from a specified table within a schema.
- **`/api/getCourses`**: Retrieves all courses in HTML format.
- **`/api/search`**: Searches the database based on a query string.
- **`/api/fetchProcedures`**: Fetches all stored procedures from a specified schema.
- **`/api/fetchFunctions`**: Fetches all functions from a specified schema.
- **`/api/fetchVideo`**: Streams video content if the user is authenticated and enrolled in the course.
- **`/api/query`**: Executes a raw SQL query.

### POST Methods

- **`/api/insertDatabase`**
- **`/api/updateDatabase`**
- **`/api/deleteFromDatabase`**

## Authentication System Overview

### User Authentication Flow

1. **Login Page**: Users enter their credentials and submit a POST request to `handleLogin.php`.
2. **Login Handling**: 
   - Starts a session and extracts credentials.
   - Authenticates using `UserService`.
   - Generates a JWT token using `JWTManager` and sets it in an HTTP-only cookie.
   - Redirects the user with a success message.

### User Registration Flow

1. **Signup Page**: Users fill out the registration form and submit a POST request to `handleRegister.php`.
2. **Registration Handling**: 
   - Starts a session and extracts registration data.
   - Registers the user using `UserService`.
   - Hashes the password and creates a new user with a default role.
   - Redirects the user with a success message.

### Error Handling

- Custom exceptions like `AuthException` handle authentication errors.
- Error messages are set in the session and displayed on respective pages.

### Middleware and Controllers

- `AuthController` handles routing for login, signup, and logout actions.
- Middleware scripts (`handleLogin.php` and `handleRegister.php`) process form submissions and interact with services and repositories.

### Security

- Passwords are hashed before storing.
- JWT tokens are stored in HTTP-only cookies.
- Sessions are managed securely to handle user state and flash messages.

## Database Usage

### MongoDB

- **User Management**: Storing user data including authentication details and roles.
- **Session Management**: Handling user sessions and storing session-related data.
- **Enrollment Data**: Managing course enrollments for users.

### MySQL

- **Course Data Management**: Storing and retrieving course-related data.
- **Admin Panel Operations**

## Dependencies

- `firebase/php-jwt` for JWT handling.
- `mongodb/mongodb` for MongoDB interactions.
