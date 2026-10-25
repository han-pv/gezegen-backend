# Gezegen Backend API

Base URL: `http://127.0.0.1:8000/api/v1`

## Airports

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /airports | Get all airports |
| GET | /airports/{id} | Get single airport |
| POST | /airports | Create airport |
| PUT | /airports/{id} | Update airport |
| DELETE | /airports/{id} | Delete airport |

### POST /airports - Request Body
```json
{
    "name": "Ashgabat International Airport",
    "code": "ASB",
    "city": "Ashgabat",
    "country": "Turkmenistan"
}
```

## Flights

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /flights | Get all flights |
| GET | /flights/{id} | Get single flight |
| POST | /flights | Create flight |
| PUT | /flights/{id} | Update flight |
| DELETE | /flights/{id} | Delete flight |

### POST /flights - Request Body
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

## Tickets

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /tickets | Get all tickets |
| GET | /tickets/{id} | Get single ticket |
| POST | /tickets | Create ticket |
| PUT | /tickets/{id} | Update ticket |
| DELETE | /tickets/{id} | Delete ticket |

### POST /tickets - Request Body
```json
{
    "flight_id": 1,
    "passenger_id": 1,
    "seat_number": "A12",
    "status": "booked",
    "price": 199.99
}
```

## Passengers

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /passengers | Get all passengers |
| GET | /passengers/{id} | Get single passenger |
| POST | /passengers | Create passenger |
| PUT | /passengers/{id} | Update passenger |
| DELETE | /passengers/{id} | Delete passenger |

### POST /passengers - Request Body
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
