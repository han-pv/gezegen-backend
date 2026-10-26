# Gezegen Backend API

A flight booking system REST API built with Laravel 13 and PostgreSQL.

## Tech Stack
- Laravel 13
- PostgreSQL
- PHP 8.5

## Setup
```bash
git clone https://github.com/han-pv/gezegen-backend.git
cd gezegen-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

## Base URL


## Bruno Collection
Import the `Gezegen Ticker API` folder from the root of this project into Bruno to test all endpoints.

---

## Buying a Ticket Flow
1. `GET /airports` — get list of airports
2. `GET /flights` — find available flights
3. `POST /passengers` — create a passenger
4. `POST /tickets` — buy a ticket linking passenger to flight

> Buying a ticket automatically decreases the flight's `total_seats` by 1.

---

## Airports

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /airports | Get all airports |
| GET | /airports/{id} | Get single airport |
| POST | /airports | Create airport |
| PUT | /airports/{id} | Update airport |
| DELETE | /airports/{id} | Delete airport |

**POST /airports — Request Body**
```json
{
    "name": "Ashgabat International Airport",
    "code": "ASB",
    "city": "Ashgabat",
    "country": "Turkmenistan"
}
```

---

## Flights

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /flights | Get all flights (includes departure & arrival airport) |
| GET | /flights/{id} | Get single flight with tickets |
| POST | /flights | Create flight |
| PUT | /flights/{id} | Update flight |
| DELETE | /flights/{id} | Delete flight |

**POST /flights — Request Body**
```json
{
    "departure_airport_id": 1,
    "arrival_airport_id": 2,
    "departure_time": "2026-10-28 10:00:00",
    "arrival_time": "2026-10-28 14:00:00",
    "total_seats": 150,
    "price": 299.99
}
```

---

## Tickets

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /tickets | Get all tickets (includes flight and passenger) |
| GET | /tickets/{id} | Get single ticket |
| POST | /tickets | Create ticket |
| PUT | /tickets/{id} | Update ticket |
| DELETE | /tickets/{id} | Delete ticket |

**POST /tickets — Request Body**
```json
{
    "flight_id": 1,
    "passenger_id": 1,
    "seat_number": "A12",
    "status": "booked",
    "price": 299.99
}
```

**Status values:** `booked` · `cancelled` · `completed`

---

## Passengers

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /passengers | Get all passengers |
| GET | /passengers/{id} | Get single passenger with tickets and flights |
| POST | /passengers | Create passenger |
| PUT | /passengers/{id} | Update passenger |
| DELETE | /passengers/{id} | Delete passenger |

**POST /passengers — Request Body**
```json
{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@example.com",
    "phone": "+99312345678",
    "passport_number": "TM1234567",
    "date_of_birth": "1990-01-01"
}
```
