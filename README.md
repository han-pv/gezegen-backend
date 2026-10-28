# Gezegen Backend API

**Language / Dil:** [English](#english) · [Türkmençe](#türkmençe)

---

<a name="english"></a>
# English

Travel REST API: **hotels** (cities, hotels, rooms) and **flight tickets** (airports, flights, tickets, passengers).

## Tech stack
- Laravel 13, PHP 8.3+
- PostgreSQL (database `gezegen_exam`)

## Setup
```bash
git clone -b dev/kerem https://github.com/han-pv/gezegen-backend.git
cd gezegen-backend
composer install
cp .env.example .env
php artisan key:generate
```
Set your PostgreSQL credentials in `.env` (`DB_CONNECTION=pgsql`, `DB_DATABASE=gezegen_exam`, `DB_USERNAME`, `DB_PASSWORD`), then:
```bash
php artisan migrate:fresh --seed
php artisan serve
```
Check: open `http://127.0.0.1:8000/api/v1/airports`.

## Base URL
```
http://127.0.0.1:8000/api/v1
```

## General rules
- Always send the header `Accept: application/json`. Without it Laravel returns an HTML error page instead of JSON.
- For `POST`, `PUT`, `PATCH` also send `Content-Type: application/json`.
- Successful responses wrap data in `{ "data": ... }`.
- Prices are returned as strings (`"164.69"`). Dates are UTC (ISO 8601, ending with `Z`).

**Error responses**

| Status | Meaning |
|--------|---------|
| `404 Not Found` | Record or route does not exist |
| `422 Unprocessable Entity` | Validation failed (see `errors`) |

Validation error format:
```json
{
  "message": "The passengers.0.email field format is invalid. (and 1 more error)",
  "errors": {
    "passengers.0.email": ["The passengers.0.email field format is invalid."],
    "passengers.0.phone": ["The passengers.0.phone field format is invalid."]
  }
}
```

## Buying tickets: step by step
1. `GET /airports` to get airport ids.
2. `GET /flights?from=<id>&to=<id>&date=YYYY-MM-DD` to find a flight.
3. `POST /tickets` with `flight_id` and a list of `passengers`. One ticket is created per passenger.

Passengers are created automatically together with their tickets. You can also manage them directly with the `/passengers` endpoints (see below).

---

## Tickets

| Method | Endpoint | Status codes | Description |
|--------|----------|--------------|-------------|
| GET | `/tickets` | 200 | List all tickets (newest first) |
| GET | `/tickets/{id}` | 200, 404 | Get one ticket |
| POST | `/tickets` | 201, 422 | Buy tickets for one or more passengers |
| PUT / PATCH | `/tickets/{id}` | 200, 404, 422 | Update the passenger's data |
| DELETE | `/tickets/{id}` | 204, 404 | Cancel a ticket |

### POST `/tickets`

**Request body**
```json
{
  "flight_id": 1,
  "passengers": [
    { "full_name": "Ahmet Berdiýew", "email": "ahmet@mail.com", "phone": "+99365000000" },
    { "full_name": "Aýna Orazowa", "email": "ayna@mail.com", "phone": "+99365111111" }
  ]
}
```

**Validation rules**

| Field | Rules |
|-------|-------|
| `flight_id` | required, integer, must exist in `flights` |
| `passengers` | required, array, at least 1 item |
| `passengers.*.full_name` | required, string, max 255 |
| `passengers.*.email` | required, valid email, **must end with `.com`** |
| `passengers.*.phone` | required, **must start with `+` followed only by digits** (e.g. `+99365000000`) |

**Behavior**
- Everything runs in one database transaction with the flight row locked.
- A ticket is created for each passenger, with `price` = the flight's price at purchase time.
- The flight's `seats_available` is decreased by the number of passengers.
- If there are fewer free seats than passengers, nothing is saved and `422` is returned.

**Response `201 Created`**
```json
{
  "data": [
    {
      "id": 11,
      "flight": {
        "id": 1,
        "airline": "Aeroflot",
        "flight_number": "VB584",
        "price": "164.69",
        "seats_available": 29,
        "departure_at": "2026-11-23T20:53:18.000000Z",
        "arrival_at": "2026-11-23T23:53:18.000000Z",
        "from_airport": { "id": 6, "name": "Stambul Howa Menzili", "code": "IST", "city": "Stambul" },
        "to_airport": { "id": 9, "name": "Frankfurt Howa Menzili", "code": "FRA", "city": "Frankfurt" }
      },
      "passenger": {
        "id": 7,
        "full_name": "Ahmet Berdiýew",
        "email": "ahmet@mail.com",
        "phone": "+99365000000"
      },
      "price": "164.69"
    },
    {
      "id": 12,
      "flight": { "...": "same flight object as above" },
      "passenger": {
        "id": 8,
        "full_name": "Aýna Orazowa",
        "email": "ayna@mail.com",
        "phone": "+99365111111"
      },
      "price": "164.69"
    }
  ]
}
```

**Response `422` (invalid data)**: request with `"email": "ahmet@mail.ru"` and `"phone": "99365000000"`
```json
{
  "message": "The passengers.0.email field format is invalid. (and 1 more error)",
  "errors": {
    "passengers.0.email": ["The passengers.0.email field format is invalid."],
    "passengers.0.phone": ["The passengers.0.phone field format is invalid."]
  }
}
```

**Response `422` (not enough seats)**
```json
{
  "message": "Not enough empty seats on this flight.",
  "errors": {
    "passengers": ["Not enough empty seats on this flight."]
  }
}
```

### GET `/tickets` and GET `/tickets/{id}`
`/tickets` returns `{ "data": [ ticket, ... ] }`, `/tickets/{id}` returns `{ "data": ticket }`. A ticket has the same shape as in the `201` response above.

### PATCH `/tickets/{id}`
Updates only the **passenger's** data. The flight, price and seat count do not change. All fields are optional, but each one sent is validated with the same rules as in `POST`.

**Request body**
```json
{ "full_name": "Ahmet Täze Ad" }
```
**Response `200 OK`**
```json
{
  "data": {
    "id": 3,
    "flight": {
      "id": 14,
      "airline": "Aeroflot",
      "flight_number": "RP248",
      "price": "308.07",
      "seats_available": 74,
      "departure_at": "2026-11-03T11:45:51.000000Z",
      "arrival_at": "2026-11-03T12:45:51.000000Z",
      "from_airport": { "id": 4, "name": "Mary Howa Menzili", "code": "MYP", "city": "Mary" },
      "to_airport": { "id": 10, "name": "Suwarnabhumi Howa Menzili", "code": "BKK", "city": "Bangkok" }
    },
    "passenger": {
      "id": 4,
      "full_name": "Ahmet Täze Ad",
      "email": "aly@mail.com",
      "phone": "+99362123456"
    },
    "price": "308.07"
  }
}
```
Invalid data (for example `{"email": "a@mail.ru"}`) returns `422` in the same error format as above.

### DELETE `/tickets/{id}`
Cancels the ticket in one transaction: the ticket and its passenger are deleted and the flight's `seats_available` is increased by 1.
- `204 No Content`: success, empty body.
- `404 Not Found`: ticket does not exist (also when you delete the same ticket twice).

---

## Flights
Read-only.

| Method | Endpoint | Status codes | Description |
|--------|----------|--------------|-------------|
| GET | `/flights` | 200 | List flights, ordered by `departure_at` |
| GET | `/flights/{id}` | 200, 404 | Get one flight |

**Query parameters for `GET /flights`** (all optional, can be combined)

| Parameter | Example | Description |
|-----------|---------|-------------|
| `from` | `from=1` | Departure airport id |
| `to` | `to=6` | Arrival airport id |
| `date` | `date=2026-11-23` | Departure date (`YYYY-MM-DD`) |

Example: `GET /flights?from=6&to=9&date=2026-11-23`

**Response `200 OK`**
```json
{
  "data": [
    {
      "id": 46,
      "airline": "Turkmenistan Airlines",
      "flight_number": "OJ537",
      "price": "450.78",
      "seats_available": 35,
      "departure_at": "2026-10-30T09:18:11.000000Z",
      "arrival_at": "2026-10-30T16:18:11.000000Z",
      "from_airport": { "id": 6, "name": "Stambul Howa Menzili", "code": "IST", "city": "Stambul" },
      "to_airport": { "id": 7, "name": "Domodedowo Howa Menzili", "code": "DME", "city": "Moskwa" }
    }
  ]
}
```

## Airports
Read-only.

| Method | Endpoint | Status codes | Description |
|--------|----------|--------------|-------------|
| GET | `/airports` | 200 | List airports (ordered by city) |
| GET | `/airports/{id}` | 200, 404 | Get one airport |

Airport object: `{ "id": 1, "name": "Aşgabat Halkara Howa Menzili", "code": "ASB", "city": "Aşgabat" }`

---

## Passengers
Full CRUD. Passengers are also created automatically by `POST /tickets`; these endpoints let you manage them directly.

| Method | Endpoint | Status codes | Description |
|--------|----------|--------------|-------------|
| GET | `/passengers` | 200 | List passengers |
| GET | `/passengers/{id}` | 200, 404 | Get one passenger with their tickets and flights |
| POST | `/passengers` | 201, 422 | Create a passenger (without a ticket) |
| PUT / PATCH | `/passengers/{id}` | 200, 404, 422 | Update a passenger (send only the fields to change) |
| DELETE | `/passengers/{id}` | 204, 404 | Delete a passenger and all their tickets |

**Request body (POST)**
```json
{
  "full_name": "Ahmet Berdiýew",
  "email": "ahmet@mail.com",
  "phone": "+99365000000"
}
```

**Validation rules**

| Field | Rules (POST) |
|-------|--------------|
| `full_name` | required, string, max 255 |
| `email` | required, valid email, **must end with `.com`** |
| `phone` | required, **must start with `+` followed only by digits** |

For `PUT` / `PATCH` every field is optional, but each one sent is validated with the same rules.

**Response `201 Created`**
```json
{
  "data": {
    "id": 9,
    "full_name": "Ahmet Berdiýew",
    "email": "ahmet@mail.com",
    "phone": "+99365000000"
  }
}
```

`GET /passengers/{id}` also returns a `tickets` array (each ticket with its `flight`). In the list (`GET /passengers`) `tickets` is not included.

**Deleting a passenger** also deletes all of their tickets, and the seats of those flights are given back (`seats_available` increases by one per deleted ticket). `204 No Content` on success, `404` if the passenger does not exist.

---

## Hotels
Full CRUD.

| Method | Endpoint | Status codes | Description |
|--------|----------|--------------|-------------|
| GET | `/hotels` | 200, 422 | List hotels |
| GET | `/hotels/{id}` | 200, 404 | Get one hotel |
| POST | `/hotels` | 201, 422 | Create a hotel |
| PUT / PATCH | `/hotels/{id}` | 200, 404, 422 | Update a hotel (send all required fields) |
| DELETE | `/hotels/{id}` | 200, 404 | Delete a hotel |
| GET | `/hotels/{id}/hotellerin-roomy` | 200, 404 | Rooms of one hotel |

**Query parameters for `GET /hotels`** (optional, can be combined)

| Parameter | Example | Rules |
|-----------|---------|-------|
| `stars` | `stars=4` | integer 1-5 |
| `cityId` | `cityId=2` | integer, city must exist |

**Validation rules (POST and PUT / PATCH)**

| Field | Rules |
|-------|-------|
| `city_id` | **required**, integer, must exist in `cities` |
| `name` | **required**, string, max 255 (must be unique) |
| `slug` | **required**, string, max 255, unique among hotels |
| `address` | optional, string, max 255 |
| `capacity` | optional, integer, min 1 |
| `stars` | optional, integer 1-5 |
| `phone` | optional, string, max 255 |
| `image` | optional, string, max 255 (a storage path) |
| `rating` | optional, number 0-5 |
| `active` | optional, boolean |
| `email` | optional, valid email, max 255 |
| `description` | optional, string |

Update uses the same rules, so `city_id`, `name` and `slug` must be sent again even when you change only one field. The `slug` uniqueness check ignores the hotel being updated.

**Request body (POST)**
```json
{
  "city_id": 1,
  "name": "Grand Ashgabat",
  "slug": "grand-ashgabat",
  "address": "Magtymguly street 12",
  "capacity": 200,
  "stars": 5,
  "phone": "+99312000000",
  "rating": 4.8,
  "active": true,
  "email": "info@grand.com",
  "description": "City center hotel."
}
```

**Response `200 OK` (`GET /hotels`)**
```json
{
  "data": [
    {
      "id": 1,
      "city_id": 2,
      "name": "Watsica-Grimes",
      "slug": "watsica-grimes-841",
      "address": "72349 Rempel Common",
      "capacity": 338,
      "stars": 4,
      "phone": "(352) 321-1605",
      "image": "hotels/91f76e7d-3f53-4bb7-a5fb-a5c864a8e0b6.jpg",
      "rating": "1.50",
      "active": true,
      "email": "katrina77@swift.org",
      "description": "Est consequuntur cupiditate velit aut maiores assumenda ex."
    }
  ]
}
```
`POST` returns `201` with `{ "data": hotel }`, `PUT` / `PATCH` and `GET /hotels/{id}` return `200` with `{ "data": hotel }`. `image` is a storage path, not a full URL.

**Response `200 OK` (`DELETE`)**
```json
{ "message": "Hotel deleted" }
```

**Response `422`** (for example `POST /hotels` with an empty body)
```json
{
  "message": "The city id field is required. (and 2 more errors)",
  "errors": {
    "city_id": ["The city id field is required."],
    "name": ["The name field is required."],
    "slug": ["The slug field is required."]
  }
}
```

## Rooms
Full CRUD.

| Method | Endpoint | Status codes | Description |
|--------|----------|--------------|-------------|
| GET | `/rooms` | 200, 422 | List rooms |
| GET | `/rooms/{id}` | 200, 404 | Get one room |
| POST | `/rooms` | 201, 422 | Create a room |
| PUT / PATCH | `/rooms/{id}` | 200, 404, 422 | Update a room (send all fields) |
| DELETE | `/rooms/{id}` | 200, 404 | Delete a room |

**Query parameters for `GET /rooms`** (optional, can be combined)

| Parameter | Example | Rules |
|-----------|---------|-------|
| `hotel_id` | `hotel_id=10` | integer, hotel must exist |
| `price_start` | `price_start=100` | number, min 0 (minimum price) |
| `price_end` | `price_end=500` | number, min 0 (maximum price) |
| `is_available` | `is_available=true` | `true`, `false`, `1` or `0` |
| `room_type` | `room_type=suite` | `Standard`, `Deluxe` or `Suite` (case does not matter) |

Example: `GET /rooms?hotel_id=10&room_type=Suite&price_end=500&is_available=true`

**Validation rules (POST and PUT / PATCH)**: all fields are required.

| Field | Rules |
|-------|-------|
| `hotel_id` | required, integer, must exist in `hotels` |
| `name` | required, string, max 255 |
| `room_type` | required, one of `Deluxe`, `Suite`, `Standard` (exact case) |
| `price` | required, number, min 0 |
| `is_available` | required, boolean |

**Request body (POST)**
```json
{
  "hotel_id": 1,
  "name": "Room 101",
  "room_type": "Deluxe",
  "price": 120.5,
  "is_available": true
}
```

**Response `200 OK` (`GET /rooms`)**
```json
{
  "data": [
    {
      "id": 1,
      "hotel_id": 53,
      "name": "Room 962",
      "room_type": "Suite",
      "price": "380.28",
      "is_available": true
    }
  ]
}
```
`POST` returns `201`, `PUT` / `PATCH` and `GET /rooms/{id}` return `200`, both with `{ "data": room }`. `DELETE` returns `200` with `{ "message": "Room deleted" }`. `GET /hotels/{id}/hotellerin-roomy` returns the same list format, only for that hotel.

**Response `422`** (for example `"room_type": "Penthouse"`)
```json
{
  "message": "The selected room type is invalid.",
  "errors": {
    "room_type": ["The selected room type is invalid."]
  }
}
```

## Cities
Full CRUD.

| Method | Endpoint | Status codes | Description |
|--------|----------|--------------|-------------|
| GET | `/cities` | 200 | List cities |
| GET | `/cities/{id}` | 200, 404 | Get one city |
| POST | `/cities` | 201, 422 | Create a city |
| PUT / PATCH | `/cities/{id}` | 200, 404, 422 | Update a city (send both fields) |
| DELETE | `/cities/{id}` | 200, 404 | Delete a city |

**Validation rules (POST and PUT / PATCH)**

| Field | Rules |
|-------|-------|
| `name` | required, string, max 255 |
| `slug` | required, string, max 255, unique among cities |

**Request body (POST)**
```json
{ "name": "Mary", "slug": "mary" }
```

**Response `200 OK` (`GET /cities`)**
```json
{
  "data": [
    { "id": 1, "name": "Ashgabat", "slug": "ashgabat" },
    { "id": 2, "name": "New York", "slug": "new-york" }
  ]
}
```
`POST` returns `201`, `PUT` / `PATCH` and `GET /cities/{id}` return `200`, both with `{ "data": city }`. `DELETE` returns `200` with `{ "message": "City deleted" }`.

**Response `422`** (for example a duplicate slug)
```json
{
  "message": "The slug has already been taken.",
  "errors": {
    "slug": ["The slug has already been taken."]
  }
}
```

---

## Bruno collection
Import the Bruno collection folder from this repository into [Bruno](https://www.usebruno.com/) to try every request.

---

<a name="türkmençe"></a>
# Türkmençe

Syýahatçylyk REST API: **otel** bölümi (şäherler, otelller, otaglar) we **uçar bileti** bölümi (howa menzilleri, uçuşlar, biletler, ýolagçylar).

## Tehnologiýalar
- Laravel 13, PHP 8.3+
- PostgreSQL (baza `gezegen_exam`)

## Gurnamak
```bash
git clone -b dev/kerem https://github.com/han-pv/gezegen-backend.git
cd gezegen-backend
composer install
cp .env.example .env
php artisan key:generate
```
`.env` faýlynda PostgreSQL maglumatlaryny ýaz (`DB_CONNECTION=pgsql`, `DB_DATABASE=gezegen_exam`, `DB_USERNAME`, `DB_PASSWORD`), soň:
```bash
php artisan migrate:fresh --seed
php artisan serve
```
Barlag: `http://127.0.0.1:8000/api/v1/airports` adresini aç.

## Base URL
```
http://127.0.0.1:8000/api/v1
```

## Umumy düzgünler
- Hemişe `Accept: application/json` header-ini iber. Ol bolmasa Laravel ýalňyşlygy JSON däl, HTML görnüşinde gaýtarýar.
- `POST`, `PUT`, `PATCH` üçin `Content-Type: application/json` hem iber.
- Üstünlikli jogaplar `{ "data": ... }` içinde gelýär.
- Bahalar setir görnüşinde gelýär (`"164.69"`). Seneler UTC (ISO 8601, `Z` bilen gutarýar).

**Ýalňyşlyk jogaplary**

| Status | Manysy |
|--------|--------|
| `404 Not Found` | Ýazgy ýa-da route ýok |
| `422 Unprocessable Entity` | Validasiýa şowsuz boldy (`errors`-a seret) |

Validasiýa ýalňyşlygynyň görnüşi:
```json
{
  "message": "The passengers.0.email field format is invalid. (and 1 more error)",
  "errors": {
    "passengers.0.email": ["The passengers.0.email field format is invalid."],
    "passengers.0.phone": ["The passengers.0.phone field format is invalid."]
  }
}
```

## Bilet satyn almak: ädim-ädim
1. `GET /airports` bilen howa menzilleriniň `id`-lerini al.
2. `GET /flights?from=<id>&to=<id>&date=YYYY-MM-DD` bilen uçuş tap.
3. `POST /tickets` bilen `flight_id` we `passengers` sanawyny iber. Her ýolagçy üçin bir bilet döreýär.

Ýolagçylar biletler bilen bile awtomatiki döreýär. Olary `/passengers` endpoint-leri bilen göni hem dolandyryp bolýar (aşakda).

---

## Tickets (Biletler)

| Method | Endpoint | Status kodlary | Düşündiriş |
|--------|----------|----------------|------------|
| GET | `/tickets` | 200 | Ähli biletler (iň täzesi ilki) |
| GET | `/tickets/{id}` | 200, 404 | Bir bilet |
| POST | `/tickets` | 201, 422 | Bir ýa-da birnäçe ýolagçy üçin bilet satyn almak |
| PUT / PATCH | `/tickets/{id}` | 200, 404, 422 | Ýolagçynyň maglumatyny üýtgetmek |
| DELETE | `/tickets/{id}` | 204, 404 | Bileti ýatyrmak |

### POST `/tickets`

**Request body**
```json
{
  "flight_id": 1,
  "passengers": [
    { "full_name": "Ahmet Berdiýew", "email": "ahmet@mail.com", "phone": "+99365000000" },
    { "full_name": "Aýna Orazowa", "email": "ayna@mail.com", "phone": "+99365111111" }
  ]
}
```

**Validasiýa düzgünleri**

| Meýdan | Düzgün |
|--------|--------|
| `flight_id` | hökman, bitin san, `flights` tablisasynda bolmaly |
| `passengers` | hökman, massiw, iň azyndan 1 element |
| `passengers.*.full_name` | hökman, setir, iň köp 255 belgi |
| `passengers.*.email` | hökman, dogry email, **`.com` bilen gutarmaly** |
| `passengers.*.phone` | hökman, **`+` bilen başlamaly, soň diňe sanlar** (meselem `+99365000000`) |

**Işleýşi**
- Hemme zat uçuş setiri gulplanan bir transaction-da ýerine ýetýär.
- Her ýolagçy üçin bilet döreýär, `price` satyn alnan wagtky uçuşyň bahasyna deň.
- Uçuşyň `seats_available` sany ýolagçy sanyna görä azalýar.
- Boş ýer ýolagçy sanyndan az bolsa, hiç zat saklanmaýar we `422` gaýdýar.

**`201 Created` jogaby:** ýokardaky inglisçe bölümdäki mysal bilen birmeňzeş (`data` içinde her ýolagçy üçin bir bilet; her biletde `flight`, `passenger`, `price`).

**`422` jogaby (ýalňyş maglumat):** `"email": "ahmet@mail.ru"` we `"phone": "99365000000"` iberilende, ýokardaky inglisçe bölümdäki ýalňyşlyk jogaby gaýdýar (`errors` içinde her ýalňyş meýdan aýratyn görkezilýär).

**`422` jogaby (ýer ýetenok)**
```json
{
  "message": "Not enough empty seats on this flight.",
  "errors": {
    "passengers": ["Not enough empty seats on this flight."]
  }
}
```

### GET `/tickets` we GET `/tickets/{id}`
`/tickets` `{ "data": [ bilet, ... ] }` gaýtarýar, `/tickets/{id}` bolsa `{ "data": bilet }`. Bilet `201` jogabyndaky bilen deň görnüşde.

### PATCH `/tickets/{id}`
Diňe **ýolagçynyň** maglumatyny üýtgedýär. Uçuş, baha we boş ýer sany üýtgemeýär. Ähli meýdanlar islege bagly, ýöne iberilen her meýdan `POST`-daky düzgünler bilen barlanýar.

**Request body**
```json
{ "full_name": "Ahmet Täze Ad" }
```
**`200 OK` jogaby:** `{ "data": bilet }` görnüşinde, täze ady bilen (ýokardaky inglisçe bölümdäki mysala seret). Ýalňyş maglumat (meselem `{"email": "a@mail.ru"}`) ýokardaky ýaly `422` berýär.

### DELETE `/tickets/{id}`
Bileti bir transaction-da ýatyrýar: bilet we onuň ýolagçysy pozulýar, uçuşyň `seats_available` sany 1 artýar.
- `204 No Content`: üstünlik, jogap bedeni boş.
- `404 Not Found`: şeýle bilet ýok (şol bir bileti ikinji gezek pozsaň hem).

---

## Flights (Uçuşlar)
Diňe okamak.

| Method | Endpoint | Status kodlary | Düşündiriş |
|--------|----------|----------------|------------|
| GET | `/flights` | 200 | Uçuşlar (`departure_at` boýunça tertipleşdirilen) |
| GET | `/flights/{id}` | 200, 404 | Bir uçuş |

**`GET /flights` query parametrleri** (hemmesi islege bagly, birleşdirip bolýar)

| Parametr | Mysal | Düşündiriş |
|----------|-------|------------|
| `from` | `from=1` | Uçýan howa menziliniň `id`-si |
| `to` | `to=6` | Gonýan howa menziliniň `id`-si |
| `date` | `date=2026-11-23` | Uçuş senesi (`YYYY-MM-DD`) |

Mysal: `GET /flights?from=6&to=9&date=2026-11-23`

**Jogap:** inglisçe bölümdäki mysal ýaly (`from_airport` we `to_airport` içinde).

## Airports (Howa menzilleri)
Diňe okamak.

| Method | Endpoint | Status kodlary | Düşündiriş |
|--------|----------|----------------|------------|
| GET | `/airports` | 200 | Howa menzilleri (şäher boýunça tertipleşdirilen) |
| GET | `/airports/{id}` | 200, 404 | Bir howa menzili |

Howa menzili: `{ "id": 1, "name": "Aşgabat Halkara Howa Menzili", "code": "ASB", "city": "Aşgabat" }`

---

## Passengers (Ýolagçylar)
Doly CRUD. Ýolagçylar `POST /tickets` bilen hem awtomatiki döreýär; bu endpoint-ler olary göni dolandyrmak üçin.

| Method | Endpoint | Status kodlary | Düşündiriş |
|--------|----------|----------------|------------|
| GET | `/passengers` | 200 | Ýolagçylar |
| GET | `/passengers/{id}` | 200, 404 | Bir ýolagçy (biletleri we uçuşlary bilen) |
| POST | `/passengers` | 201, 422 | Ýolagçy döretmek (biletsiz) |
| PUT / PATCH | `/passengers/{id}` | 200, 404, 422 | Ýolagçyny üýtgetmek (diňe üýtgeýän meýdanlary iber) |
| DELETE | `/passengers/{id}` | 204, 404 | Ýolagçyny we ähli biletlerini pozmak |

**Request body (POST)**
```json
{
  "full_name": "Ahmet Berdiýew",
  "email": "ahmet@mail.com",
  "phone": "+99365000000"
}
```

**Validasiýa düzgünleri**

| Meýdan | Düzgün (POST) |
|--------|---------------|
| `full_name` | hökman, setir, iň köp 255 belgi |
| `email` | hökman, dogry email, **`.com` bilen gutarmaly** |
| `phone` | hökman, **`+` bilen başlamaly, soň diňe sanlar** |

`PUT` / `PATCH` üçin her meýdan islege bagly, ýöne iberilen her meýdan şol bir düzgünler bilen barlanýar.

**`201 Created` jogaby:** `{ "data": { "id": 9, "full_name": "...", "email": "...", "phone": "..." } }`

`GET /passengers/{id}` jogabynda goşmaça `tickets` massiwi hem bar (her bilet `flight` bilen). Sanawda (`GET /passengers`) `tickets` ýok.

**Ýolagçyny pozanyňda** onuň ähli biletleri hem pozulýar we şol uçuşlaryň ýerleri yzyna gaýdýar (her pozulan bilet üçin `seats_available` 1 artýar). Üstünlikli bolsa `204 No Content`, ýolagçy ýok bolsa `404`.

---

## Hotels (Oteller)
Doly CRUD.

| Method | Endpoint | Status kodlary | Düşündiriş |
|--------|----------|----------------|------------|
| GET | `/hotels` | 200, 422 | Oteller |
| GET | `/hotels/{id}` | 200, 404 | Bir otel |
| POST | `/hotels` | 201, 422 | Otel döretmek |
| PUT / PATCH | `/hotels/{id}` | 200, 404, 422 | Oteli üýtgetmek (hökman meýdanlaryň hemmesini iber) |
| DELETE | `/hotels/{id}` | 200, 404 | Oteli pozmak |
| GET | `/hotels/{id}/hotellerin-roomy` | 200, 404 | Bir otelüň otaglary |

**`GET /hotels` query parametrleri** (islege bagly, birleşdirip bolýar)

| Parametr | Mysal | Düzgün |
|----------|-------|--------|
| `stars` | `stars=4` | 1-5 aralygynda bitin san |
| `cityId` | `cityId=2` | bitin san, şeýle şäher bolmaly |

**Validasiýa düzgünleri (POST we PUT / PATCH)**

| Meýdan | Düzgün |
|--------|--------|
| `city_id` | **hökman**, bitin san, `cities`-de bolmaly |
| `name` | **hökman**, setir, iň köp 255 (ýekeje bolmaly) |
| `slug` | **hökman**, setir, iň köp 255, otellerde ýekeje |
| `address` | islege bagly, setir, iň köp 255 |
| `capacity` | islege bagly, bitin san, iň az 1 |
| `stars` | islege bagly, 1-5 aralygynda bitin san |
| `phone` | islege bagly, setir, iň köp 255 |
| `image` | islege bagly, setir, iň köp 255 (saklanýan ýol) |
| `rating` | islege bagly, 0-5 aralygynda san |
| `active` | islege bagly, boolean |
| `email` | islege bagly, dogry email, iň köp 255 |
| `description` | islege bagly, setir |

Update hem şol düzgünler bilen işleýär, şonuň üçin diňe bir meýdany üýtgetseň hem `city_id`, `name`, `slug` täzeden ibermeli. `slug`-yň ýekeje bolmak barlagy üýtgedilýän oteli hasaba almaýar.

**Request body (POST) we jogap mysallary:** ýokardaky inglisçe bölümdäki ýaly. `POST` `201`, `PUT` / `PATCH` we `GET /hotels/{id}` `200` gaýtarýar, hemmesi `{ "data": otel }` görnüşinde. `image` doly URL däl, saklanýan faýlyň ýoly.

**`DELETE` jogaby (`200 OK`):** `{ "message": "Hotel deleted" }`

**`422` jogaby** (meselem boş body bilen `POST /hotels`):
```json
{
  "message": "The city id field is required. (and 2 more errors)",
  "errors": {
    "city_id": ["The city id field is required."],
    "name": ["The name field is required."],
    "slug": ["The slug field is required."]
  }
}
```

## Rooms (Otaglar)
Doly CRUD.

| Method | Endpoint | Status kodlary | Düşündiriş |
|--------|----------|----------------|------------|
| GET | `/rooms` | 200, 422 | Otaglar |
| GET | `/rooms/{id}` | 200, 404 | Bir otag |
| POST | `/rooms` | 201, 422 | Otag döretmek |
| PUT / PATCH | `/rooms/{id}` | 200, 404, 422 | Otagy üýtgetmek (ähli meýdanlary iber) |
| DELETE | `/rooms/{id}` | 200, 404 | Otagy pozmak |

**`GET /rooms` query parametrleri** (islege bagly, birleşdirip bolýar)

| Parametr | Mysal | Düzgün |
|----------|-------|--------|
| `hotel_id` | `hotel_id=10` | bitin san, şeýle otel bolmaly |
| `price_start` | `price_start=100` | san, iň az 0 (iň pes baha) |
| `price_end` | `price_end=500` | san, iň az 0 (iň ýokary baha) |
| `is_available` | `is_available=true` | `true`, `false`, `1` ýa-da `0` |
| `room_type` | `room_type=suite` | `Standard`, `Deluxe` ýa-da `Suite` (uly-kiçi harpa dahylsyz) |

Mysal: `GET /rooms?hotel_id=10&room_type=Suite&price_end=500&is_available=true`

**Validasiýa düzgünleri (POST we PUT / PATCH):** ähli meýdanlar hökman.

| Meýdan | Düzgün |
|--------|--------|
| `hotel_id` | hökman, bitin san, `hotels`-de bolmaly |
| `name` | hökman, setir, iň köp 255 |
| `room_type` | hökman, `Deluxe`, `Suite` ýa-da `Standard` (takyk harp ýazylyşy) |
| `price` | hökman, san, iň az 0 |
| `is_available` | hökman, boolean |

**Request body (POST)**
```json
{
  "hotel_id": 1,
  "name": "Room 101",
  "room_type": "Deluxe",
  "price": 120.5,
  "is_available": true
}
```

`GET /rooms` jogaby ýokardaky inglisçe bölümdäki ýaly. `POST` `201`, `PUT` / `PATCH` we `GET /rooms/{id}` `200` gaýtarýar (`{ "data": otag }`). `DELETE` `200` we `{ "message": "Room deleted" }` gaýtarýar. `GET /hotels/{id}/hotellerin-roomy` şol bir sanaw görnüşinde, diňe şol otelüň otaglaryny gaýtarýar.

**`422` jogaby** (meselem `"room_type": "Penthouse"`): `"The selected room type is invalid."`

## Cities (Şäherler)
Doly CRUD.

| Method | Endpoint | Status kodlary | Düşündiriş |
|--------|----------|----------------|------------|
| GET | `/cities` | 200 | Şäherler |
| GET | `/cities/{id}` | 200, 404 | Bir şäher |
| POST | `/cities` | 201, 422 | Şäher döretmek |
| PUT / PATCH | `/cities/{id}` | 200, 404, 422 | Şäheri üýtgetmek (iki meýdany hem iber) |
| DELETE | `/cities/{id}` | 200, 404 | Şäheri pozmak |

**Validasiýa düzgünleri (POST we PUT / PATCH)**

| Meýdan | Düzgün |
|--------|--------|
| `name` | hökman, setir, iň köp 255 |
| `slug` | hökman, setir, iň köp 255, şäherlerde ýekeje |

**Request body (POST):** `{ "name": "Mary", "slug": "mary" }`

`GET /cities` jogaby ýokardaky inglisçe bölümdäki ýaly. `POST` `201`, `PUT` / `PATCH` we `GET /cities/{id}` `200` gaýtarýar (`{ "data": şäher }`). `DELETE` `200` we `{ "message": "City deleted" }` gaýtarýar.

**`422` jogaby** (meselem gaýtalanýan `slug`): `"The slug has already been taken."`

---

## Bruno collection
Repozitoriýadaky Bruno collection papkasyny [Bruno](https://www.usebruno.com/)-a import et, ähli request-leri synap bolýar.
