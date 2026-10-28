# 🌍 Gezegen - Professional API Documentation

> **Base URL:** `http://127.0.0.1:8000/api/v1`  
> **Headers:** `Accept: application/json` | `Content-Type: application/json`

---

## 🧪 How to Test Method URLs in Bruno
1. Open Bruno and create a new collection named **Gezegen API**.
2. Set up an Environment Variable with the key `BASE_URL` and value `http://127.0.0.1:8000/api/v1`.
3. Create your requests using `{{BASE_URL}}/endpoint-path` (e.g., `{{BASE_URL}}/airports`).
4. Ensure your request headers include `Accept: application/json` and `Content-Type: application/json`.

---

## 📖 Controller Action Guide
* **GET - Index** => Show all data records
* **POST - Store** => Create and store new data
* **GET - Show** => Show one specific data record by ID
* **PUT - Update** => Update existing data record
* **DELETE - Destroy** => Delete a data record

---

<div style="font-size: 16px; line-height: 2.2;">

## 🏢 Airports Module (`/airports`)

* <span style="background-color:#1565c0; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">GET - index</span> `http://127.0.0.1:8000/api/v1/airports` — Retrieve all registered airports. => **200 OK**
  ```json
  {
    "data": [
      {
        "id": 1,
        "name": "John F. Kennedy International Airport",
        "code": "JFK",
        "city": "New York",
        "country": "USA"
      },
      {
        "id": 2,
        "name": "Los Angeles International Airport",
        "code": "LAX",
        "city": "Los Angeles",
        "country": "USA"
      }
    ]
  }
  ```

* <span style="background-color:#2e7d32; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">POST - store</span> `http://127.0.0.1:8000/api/v1/airports` — Register a new airport. => **201 Created**
  ```json
  {
    "data": {
      "id": 3,
      "name": "Ashgabat International Airport",
      "code": "ASB",
      "city": "Ashgabat",
      "country": "Turkmenistan"
    }
  }
  ```

* <span style="background-color:#1565c0; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">GET - show</span> `http://127.0.0.1:8000/api/v1/airports/{airport}` — Retrieve a single airport by ID. => **200 OK**
  ```json
  {
    "data": {
      "id": 1,
      "name": "John F. Kennedy International Airport",
      "code": "JFK",
      "city": "New York",
      "country": "USA"
    }
  }
  ```

* <span style="background-color:#b45309; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">PUT - update</span> `http://127.0.0.1:8000/api/v1/airports/{airport}` — Update an existing airport. => **200 OK**
  ```json
  {
    "data": {
      "id": 1,
      "name": "JFK International Airport Updated",
      "code": "JFK",
      "city": "New York",
      "country": "USA"
    }
  }
  ```

* <span style="background-color:#b91c1c; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">DELETE - destroy</span> `http://127.0.0.1:8000/api/v1/airports/{airport}` — Delete an airport. => **204 No Content**

---

## ✈️ Flights Module (`/flights`)

* <span style="background-color:#1565c0; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">GET - index</span> `http://127.0.0.1:8000/api/v1/flights` — Retrieve all flights (Supports `origin_id` & `destination_id` filters). => **200 OK**
  ```json
  {
    "data": [
      {
        "id": 1,
        "airline": "American Airlines",
        "flight_number": "AA101",
        "origin_airport": { "code": "JFK", "city": "New York" },
        "destination_airport": { "code": "LAX", "city": "Los Angeles" },
        "departure_time": "2026-10-26 18:00:00",
        "arrival_time": "2026-10-26 21:15:00",
        "duration": "3 hr 15 min",
        "price": "180.00",
        "empty_seats": 1
      }
    ]
  }
  ```

* <span style="background-color:#2e7d32; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">POST - store</span> `http://127.0.0.1:8000/api/v1/flights` — Schedule a new flight. => **201 Created**
  ```json
  {
    "data": {
      "id": 2,
      "airline": "United Airlines",
      "flight_number": "UA500",
      "origin_airport_id": 3,
      "destination_airport_id": 4,
      "departure_time": "2026-10-28 20:00:00",
      "arrival_time": "2026-10-29 08:00:00",
      "duration": "12 hr 00 min",
      "price": "540.00",
      "empty_seats": 5
    }
  }
  ```

* <span style="background-color:#1565c0; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">GET - show</span> `http://127.0.0.1:8000/api/v1/flights/{flight}` — Retrieve flight details with relationships. => **200 OK**
  ```json
  {
    "data": {
      "id": 1,
      "airline": "American Airlines",
      "flight_number": "AA101",
      "origin_airport": { "code": "JFK", "city": "New York" },
      "destination_airport": { "code": "LAX", "city": "Los Angeles" },
      "price": "180.00",
      "empty_seats": 1
    }
  }
  ```

* <span style="background-color:#b45309; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">PUT - update</span> `http://127.0.0.1:8000/api/v1/flights/{flight}` — Update flight information. => **200 OK**
  ```json
  {
    "data": {
      "id": 1,
      "airline": "American Airlines",
      "flight_number": "AA101",
      "price": "190.00",
      "empty_seats": 10
    }
  }
  ```

* <span style="background-color:#b91c1c; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">DELETE - destroy</span> `http://127.0.0.1:8000/api/v1/flights/{flight}` — Cancel or delete a flight. => **204 No Content**

---

## 👤 Passengers Module (`/passengers`)

* <span style="background-color:#1565c0; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">GET - index</span> `http://127.0.0.1:8000/api/v1/passengers` — Retrieve all passenger profiles. => **200 OK**
  ```json
  {
    "data": [
      {
        "id": 1,
        "full_name": "John Smith",
        "email": "you@example.com",
        "phone": "+1 555 000 0000",
        "passport_number": "XY1234567"
      }
    ]
  }
  ```

* <span style="background-color:#2e7d32; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">POST - store</span> `http://127.0.0.1:8000/api/v1/passengers` — Register a new passenger profile. => **201 Created**
  ```json
  {
    "data": {
      "id": 1,
      "full_name": "John Smith",
      "email": "you@example.com",
      "phone": "+1 555 000 0000",
      "passport_number": "XY1234567"
    }
  }
  ```

* <span style="background-color:#1565c0; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">GET - show</span> `http://127.0.0.1:8000/api/v1/passengers/{passenger}` — Retrieve passenger profile by ID. => **200 OK**
  ```json
  {
    "data": {
      "id": 1,
      "full_name": "John Smith",
      "email": "you@example.com",
      "phone": "+1 555 000 0000",
      "passport_number": "XY1234567"
    }
  }
  ```

* <span style="background-color:#b45309; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">PUT - update</span> `http://127.0.0.1:8000/api/v1/passengers/{passenger}` — Update passenger profile. => **200 OK**
  ```json
  {
    "data": {
      "id": 1,
      "full_name": "John Smith Updated",
      "email": "you@example.com",
      "phone": "+1 555 000 0000",
      "passport_number": "XY1234567"
    }
  }
  ```

* <span style="background-color:#b91c1c; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">DELETE - destroy</span> `http://127.0.0.1:8000/api/v1/passengers/{passenger}` — Delete a passenger record. => **204 No Content**

---

## 🎟️ Tickets & Bookings Module (`/tickets`)

* <span style="background-color:#1565c0; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">GET - index</span> `http://127.0.0.1:8000/api/v1/tickets` — Retrieve all booked tickets with relations. => **200 OK**
  ```json
  {
    "data": [
      {
        "id": 5,
        "flight_id": 1,
        "passenger_id": 1,
        "seat_number": "12A",
        "passenger_count": 1,
        "total_price": 180.00,
        "status": "booked"
      }
    ]
  }
  ```

* <span style="background-color:#2e7d32; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">POST - store</span> `http://127.0.0.1:8000/api/v1/tickets` — Book a ticket (Executes DB transaction & decrements flight empty seats). => **201 Created** / **422 Unprocessable Entity** (if seats are full)
  ```json
  {
    "data": {
      "id": 5,
      "flight_id": 1,
      "passenger_id": 1,
      "flight": {
        "id": 1,
        "airline": "American Airlines",
        "empty_seats": 0
      },
      "passenger": {
        "id": 1,
        "full_name": "John Smith"
      },
      "seat_number": "12A",
      "passenger_count": 1,
      "total_price": 180,
      "status": "booked"
    }
  }
  ```

* <span style="background-color:#1565c0; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">GET - show</span> `http://127.0.0.1:8000/api/v1/tickets/{ticket}` — Retrieve specific ticket details. => **200 OK**
  ```json
  {
    "data": {
      "id": 5,
      "flight_id": 1,
      "passenger_id": 1,
      "seat_number": "12A",
      "total_price": 180.00,
      "status": "booked"
    }
  }
  ```

* <span style="background-color:#b45309; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">PUT - update</span> `http://127.0.0.1:8000/api/v1/tickets/{ticket}` — Update ticket information. => **200 OK**
  ```json
  {
    "data": {
      "id": 5,
      "seat_number": "14B",
      "status": "confirmed"
    }
  }
  ```

* <span style="background-color:#b91c1c; color:white; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:12px;">DELETE - destroy</span> `http://127.0.0.1:8000/api/v1/tickets/{ticket}` — Cancel ticket (Restores flight empty seats automatically). => **204 No Content**

</div>
