# phoebe
In this version of the application almost the same as LAB-3: we have both a normal UI and Rest API, but it has namespaces for PHP classes, .env support and sending email after registration.

We just need to set a URL:
for **UI**: *localhost/*
for **RestAPI**: *localhost/api/{table name}*

Curently, the application have one table: users. 
So you can work with it in this way: localhost/api/users or localhost/api/users/1

All endpoints return **JSON** response or text message, if any error occured. Supported endpoints:

- GET localhost/api/users to get all users list;
- GET localhost/api/users/13 to get specific user by id;
- POST localhost/api/users to create new user (you need to pass firstname, lastName, email and password fields at the request body);
- PUT localhost/api/users/15 to update specific user's information. It's important to pass all the fields: firstname, lastName, email and password. And body type must be **x-www-form-urlencoded**;
- DELETE localhost/api/users/39 to delete specific user using his ID

The postman collection with request presets is located in project root as Web-development *LAB-3.postman_collection.json*

Also the application will send an email when new user registered.

### Note
In the root of the project located .env_example. It's a template for .env file, clone the repository, change credentials on it and rename to .env.

