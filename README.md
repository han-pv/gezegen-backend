# Gezegen Backend API

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
```
http://127.0.0.1:8000/api/v1
```

## Bruno Collection
Import the `Gezegen Ticker API` folder into Bruno.

---

## Buying a Ticket Flow
1. `GET /airports` — get list of airports
2. `GET /flights` — find available flights
3. `POST /passengers` — create a passenger
4. `POST /tickets` — buy a ticket linking passenger to flight

> Buying a ticket automatically decreases the flight's `total_seats`.

---

## Tickets

| Method | Endpoint | Status Codes | Description |
|--------|----------|--------------|-------------|
| GET | /tickets | `200 OK` | Get all tickets (includes flight and passenger) |
| GET | /tickets/{id} | `200 OK`, `404 Not Found` | Get single ticket |
| POST | /tickets | `201 Created`, `422 Unprocessable Entity` | Create ticket |
| PUT | /tickets/{id} | `200 OK`, `404 Not Found`, `422 Unprocessable Entity` | Update ticket status |
| DELETE | /tickets/{id} | `200 OK`, `404 Not Found` | Delete ticket |

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

**PUT /tickets/{id} — Request Body**
```json
{
    "status": "cancelled"
}
```

**Status values:** `booked` · `cancelled` · `completed`

**GET /tickets — Response Example**
```json
[
  {
    "id": 1,
    "flight_id": 1,
    "passenger_id": 1,
    "seat_number": "A12",
    "status": "booked",
    "price": "299.99",
    "flight": {
      "id": 1,
      "departure_airport": { "city": "Ashgabat", "code": "ASB" },
      "arrival_airport": { "city": "Istanbul", "code": "IST" },
      "departure_time": "2026-10-28 10:00:00",
      "arrival_time": "2026-10-28 14:00:00"
    },
    "passenger": {
      "id": 1,
      "first_name": "John",
      "last_name": "Doe",
      "email": "john@example.com"
    }
  }
]
```

---

## Passengers

| Method | Endpoint | Status Codes | Description |
|--------|----------|--------------|-------------|
| GET | /passengers | `200 OK` | Get all passengers |
| GET | /passengers/{id} | `200 OK`, `404 Not Found` | Get single passenger with tickets and flights |
| POST | /passengers | `201 Created`, `422 Unprocessable Entity` | Create passenger |
| PUT | /passengers/{id} | `200 OK`, `404 Not Found`, `422 Unprocessable Entity` | Update passenger |
| DELETE | /passengers/{id} | `200 OK`, `404 Not Found` | Delete passenger |

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

---

## Flights

| Method | Endpoint | Status Codes | Description |
|--------|----------|--------------|-------------|
| GET | /flights | `200 OK` | Get all flights (includes departure & arrival airport) |
| GET | /flights/{id} | `200 OK`, `404 Not Found` | Get single flight with tickets |
| POST | /flights | `201 Created`, `422 Unprocessable Entity` | Create flight |
| PUT | /flights/{id} | `200 OK`, `404 Not Found`, `422 Unprocessable Entity` | Update flight |
| DELETE | /flights/{id} | `200 OK`, `404 Not Found` | Delete flight |

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

## Airports

| Method | Endpoint | Status Codes | Description |
|--------|----------|--------------|-------------|
| GET | /airports | `200 OK` | Get all airports |
| GET | /airports/{id} | `200 OK`, `404 Not Found` | Get single airport |
| POST | /airports | `201 Created`, `422 Unprocessable Entity` | Create airport |
| PUT | /airports/{id} | `200 OK`, `404 Not Found`, `422 Unprocessable Entity` | Update airport |
| DELETE | /airports/{id} | `200 OK`, `404 Not Found` | Delete airport |

**POST /airports — Request Body**
```json
{
    "name": "Ashgabat International Airport",
    "code": "ASB",
    "city": "Ashgabat",
    "country": "Turkmenistan"
}
```
