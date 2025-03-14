    
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
    - [ ] List Devices not attached to any vehicle 
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
- [x]  Order
    - [x] Create order
    - [x] Get order information
    - [x] Attach vehicle an order
    - [x] Detach a vehicle from an order
    - [x] Delete order
    - [x] Edit order
    - [x] Add/change order status
- [ ] Dispatch Module (Order submodule)
    - [x] Get route details and lists
    - [x] Create a route(dispatch )
    - [x] Edit Route
    - [x] Remove route
    - [x] Change Route Status
- [ ] FileManager 
- [ ] Terms and conditions management
> **Warning:** This task list is still under development and review.



#### Retirements
  - A running Traccar system  (you can tunnel e.g `autossh -M 0 -R afasha:80:localhost:8082 serveo.net` ) 

  - Traccar client on your phone to use as a device
  
#### Setup Project

step 1 

Clone the project 

step 2
```
cp .env.example .env
```

step 3
 - Setup  Traccar db config in the .env
step 4

Setup the .env environment variables required

step 5

```
 php artisan migrate:fresh
```
step 6

```
php artisan db:seed
```

user email will be  `admin@dayalog.com` and the password will be `password`
