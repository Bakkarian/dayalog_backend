
##Dayalog

DAYALOG logistics system tracks vehicles that deliver goods and it would involve several key activities, including:

### API Documentation 

```
 {{BaseUrl}} /docs
```
e.g http://localhost:8000/docs

### TO-DO

- [x] Initial Setup 
- [x] Authentication
    - [x] register
    - [x] login
    - [x] Login with phone number and merchant code
    - [x] Logout
    - [x] reset password
    - [x] verify email
    - [x] Save Patasente account and phone number on user table
    - [ ] Validating phone numbers 
    - [ ] login with PataSente account
- [ ] Roles and permissions
- [x] Devices Module
    - [x] Add the device to the system
    - [x] Get devices
- [x] Drivers
    - [x] Create Driver
    - [x] Get Driver Information
    - [x] Delete A driver
    - [x] Update driver information
- [x] Vehicles Module
    - [x] Add Vehicle to the system
    - [x] Update Vehicle
    - [x] Remove Vehicle
    - [x] Attach a Device to a vehicle
    - [x] Detach a Device to a vehicle
    - [x] list Vehicles
    - [x] Attach Driver
    - [x] Detach Driver
- [ ]  Order
    - [x] Create order
    - [ ] Attach vehicle to order
    - [x] Get order information
    - [ ] Attach vehicle an order
    - [x] Delete order
    - [x] Edit order
- [ ] Dispatch Module (Order submodule)
    - [ ] create a route(dispatch )
- [ ] FileManager 
- [ ] Terms and conditions management
> **Warning:** This task list is still under development and review.

#### Setup Project

step 1 

Clone the project 

step 2
```
cp .env.example .env
```

step 3 

Setup the .env environment variables required

step 4

```
 php artisan migrate:fresh
```
step 5

```
php artisan db:seed
```

user email will be  `admin@dayalog.com` and the password will be `password`
