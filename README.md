# hotel_booking

# Hotel Booking System

A web-based Hotel Booking System developed using PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap. The system allows users to explore hotels and rooms, view room details and utilities, make bookings, and complete a demo payment process. It also provides an admin panel for managing hotels, rooms, utilities, and bookings.

---

## 1. Project Overview

The **Hotel Booking System** is a dynamic web application designed to simplify the process of browsing and booking hotel rooms.

Users can:

- Browse available hotels and rooms
- View room details and pricing
- Check room amenities/utilities
- Select check-in and check-out dates
- Make a room booking
- View booking information
- Complete a demo payment process

The system also includes an **Admin Panel** where administrators can manage hotels, rooms, utilities, and booking information.

The project is developed and tested locally using **XAMPP**.

---

## 2. Features

### User Features

- User-friendly homepage
- Hotel listing
- Room listing
- Room details page
- Room pricing
- Room availability status
- Room utilities/amenities
- Check-in and check-out date selection
- Booking system
- Booking information
- Total booking price calculation
- Demo payment system
- Booking confirmation
- Responsive design

### Admin Features

- Admin login
- Admin dashboard
- Hotel management
- Add, update, and delete hotels
- Room management
- Add, update, and delete rooms
- Room status management
- Utility/amenity management
- Assign utilities to rooms
- Booking management
- View booking details
- Update booking status


## 3. Demo

<p align="center">

  <a href="https://github.com/fahim-fardin-1045/hotel_booking/blob/main/images/demo.mp4">
    <img src="https://img.shields.io/badge/▶%20Watch%20Project%20Demo-Click%20Here-success?style=for-the-badge" alt="Watch Project Demo" />
  </a>

</p>

<p align="center">
  <img src="https://github.com/fahim-fardin-1045/hotel_booking/blob/main/images/202610061135-ezgif.com-video-to-gif-converter.gif" alt="Hotel Booking System Demo" width="700">
</p>

## 4. System Workflow

The Hotel Booking System follows the workflow below:

```text
                    ┌───────────────┐
                    │     User      │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │    Homepage   │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │ Select Hotel  │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │  View Rooms   │
                    └───────┬───────┘
                            │
                            ▼
                    ┌────────────────┐
                    │ Room Details   │
                    │ & Utilities    │
                    └───────┬────────┘
                            │
                            ▼
                 ┌──────────────────────┐
                 │ Select Check-in &    │
                 │ Check-out Dates      │
                 └──────────┬───────────┘
                            │
                            ▼
                    ┌───────────────┐
                    │ Book Room     │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │ Booking Data  │
                    │ Stored in DB  │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │ Payment Page  │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │ Demo Payment  │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │   Confirmed   │
                    │    Booking    │
                    └───────────────┘



Admin Workflow

                    ┌───────────────┐
                    │     Admin     │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │  Admin Login  │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │ Admin         │
                    │ Dashboard     │
                    └───────┬───────┘
                            │
              ┌─────────────┼─────────────┐
              │             │             │
              ▼             ▼             ▼
        ┌──────────┐  ┌──────────┐  ┌────────────┐
        │ Hotels   │  │  Rooms   │  │ Utilities  │
        │ Management│ │Management│  │ Management │
        └────┬─────┘  └────┬─────┘  └─────┬──────┘
             │             │               │
             └─────────────┼───────────────┘
                           │
                           ▼
                    ┌───────────────┐
                    │   Bookings    │
                    │   Management  │
                    └───────┬───────┘
                            │
                            ▼
                    ┌───────────────┐
                    │ Update Booking│
                    │     Status    │
                    └───────────────┘

Database Workflow

        ┌───────────┐
        │  Hotels   │
        └─────┬─────┘
              │
              │ hotel_id
              ▼
        ┌───────────┐
        │   Rooms   │
        └─────┬─────┘
              │
              │ room_id
              ▼
      ┌─────────────────┐
      │ room_utilities  │
      └────────┬────────┘
               │
               │ utility_id
               ▼
        ┌─────────────┐
        │  Utilities  │
        └─────────────┘

        ┌─────────────┐
        │   Users     │
        └──────┬──────┘
               │
               ▼
        ┌─────────────┐
        │  Bookings   │
        └──────┬──────┘
               │
               ├── room_id
               ├── user_id
               ├── check_in
               ├── check_out
               ├── payment
               └── status




## 5. Technologies Used

### Frontend
- HTML5
- CSS3
- JavaScript
- Bootstrap
- jQuery

### Backend
- PHP
- PDO (PHP Data Objects)

### Database
- MySQL

### Server & Development Environment
- XAMPP
- Apache
- MySQL
- phpMyAdmin

### Development Tools
- Visual Studio Code
- Git
- GitHub