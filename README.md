# Post Office Management System
It is a web based project for my SPL-3 Course. Ihave used HTML,CSS,JavaScript,Bootstrap,PHP,Laravel Framerork 5.4,MySql Server for the project

## Project Scenario

Post office management system is a system of Bangladesh government owned organization “Post Office” which provides postal delivery and public services manually. My proposed system is to automate the parcel delivery and money order services. 
After signing in as System admin of post office management system he/she can view the options of add new branches, branch managers view and edit branches and managers. He/she can add all the Zilla and Upzilla branches of post office across the country. He/she can also search the branch and edit branch information’s. Branches are added sector wised through division to zilla and upzilla. He can also add the branch managers and assign the managers to respective branches. He/she can search the managers and edit personal information’s of the managers. System admin has also the authorization of track the parcels and can go through the whole system.
After logging in as Branch managers, he/she can see the option of adding new parcels and money orders, update information’s of the products and tracking options. At the time of adding a new parcel or money order it is specified with an auto generated id number and then branch managers upload all the information’s of the product including source, destination, sender and receiver’s information’s, status of the product. He/she can assign the product to the up next branch and track it. He/she can also see the product list in his branch and get notified about the pending request of products from another branch and can approve the request. He/she can track the product with its current location through google map. Branch manager can also deliver the money order to the receiver by matching the pin number of respective money order slip. 
In this system, customers get their issued product id number through email and can track the current location of their product through the number. He/she can receive the money through pin number which send through mobile phone sms.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

For Learning the installation of Laravel 5.4 see this link https://laravel.com/docs/5.4/installation

## Installation

1. git clone https://github.com/tanvirahmed/SPL-III-PostOfficeManagementSystem.git projectname
2. cd projectname
3. composer install
4. php artisan key:generate
5. install Xampp and start
5. import the sql file post_office_management in http://localhost/phpmyadmin/ link
6. start the app in http://localhost/postmaster/ link
7. create an account in https://www.nexmo.com/ to send messages for track id and PIN in free test numbers created


## Features

1. Log in
2. View branch
3. Adding branch
4. Edit Branch
5. View branch manager
6. Assigning managers to branch
7. Update branch managers
8. View parcel
9. Add parcel
10. Edit parcel
11. Add money order
12. Edit money order
13. Tracking Product


## Tricks

1.Administrator : email = admin@gmail.com, password = 123456 
2.Branch Manager named Tarif: email = tarif@gmail.com, password = 123456 
3.Branch Manager named Real: email = real@gmail.com, password = 123456

1. Log in
2. View branch
3. Adding branch
