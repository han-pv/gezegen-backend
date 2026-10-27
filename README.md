# ✈️ Uçuşlar we Bronlaşdyrmak Dokumentasiýasy (v1 API)

Awiabilet bronlaşdyrmak ulgamy, aeroportlar, reýs ugurlary we ýolagçylar bilen işlemek üçin ňiýetlenen RESTful API dokumentasiýasy (**Laravel** freýmworkynda ýazylan).

## 📌 Içindäkiler

- [Umumy maglumat](#-umumy-maglumat)
- [Binýatlyk URL](#-bin%C3%BDatlyk-url)
- [Awtentifikasiýa we Sözbaşylar (Headers)](#-awtentifikasi%C3%BDa-we-s%C6%A9zba%C5%9Fylar-headers)
- [API Endpoýntlary (v1)](#-api-endpo%C3%BDntlary-v1)
  - [🛫 Aeroportlar (](#-aeroportlar-airports)`/airports`[)](#-aeroportlar-airports)
  - [✈️ Reýsler / Uçuşlar (](#%EF%B8%8F-re%C3%BDsler--u%C3%A7u%C5%9Flar-flights)`/flights`[)](#%EF%B8%8F-re%C3%BDsler--u%C3%A7u%C5%9Flar-flights)
  - [👤 Ýolagçylar (](#-format-passengers)`/passengers`[)](#-format-passengers)
  - [🎫 Biletler we Bronlaşdyrmak (](#-biletler-we-bronla%C5%9Fdyrmak-tickets-bookings)`/tickets`[)](#-biletler-we-bronla%C5%9Fdyrmak-tickets-bookings)
- [HTTP Jogap Kodlary (Status Codes)](#-http-jogap-kodlary-status-codes)

---



## ℹ️ Umumy maglumat

Bu API REST standartlaryna laýyk işleýär. Bütün jogaplar **JSON** formatynda gaýtarylýar.
Resurs bölümlerinde standart HTTP usullary ulanylýar:

- `GET` — Maglumatlary ýa-da sanawlary almak
- `POST` — Täze ýazgy goşmak / döretmek
- `PUT` / `PATCH` — Bar bolan maglumaty doly ýa-da bölekleýin täzelemek
- `DELETE` — Maglumaty pozmak

---



## 🌐 Binýatlyk URL

```http
http://127.0.0.1:8000/api/v1
```

---



## 🔑 Awtentifikasiýa we Sözbaşylar (Headers)

Ugradylýan haýyşlarda (requests) aşakdaky sözbaşylary ugratmak maslahat berilýär:


| Header          | Bahasy (Value)     | Düşündiriş                                    |
| --------------- | ------------------ | --------------------------------------------- |
| `Accept`        | `application/json` | Serwerden soralýan jogap formaty              |
| `Content-Type`  | `application/json` | Ugradylýan maglumatyň formaty (POST/PUT üçin) |
| `Authorization` | `Bearer <token>`   | *(Hökmany däl)* Token (Sanctum/Passport)      |


---



## 📑 API Endpoýntlary (v1)



### 🛫 Aeroportlar (`/airports`)

Aeroportlar sanawy we maglumatlary bilen işlemek.


| Usul (Method) | HTTP Ýoly             | Düşündiriş                               |
| ------------- | --------------------- | ---------------------------------------- |
| `GET`         | `/airports`           | Bütün aeroportlaryň sanawyny almak       |
| `POST`        | `/airports`           | Täze aeroport goşmak                     |
| `GET`         | `/airports/{airport}` | Belli bir aeroport barada maglumat almak |
| `PUT/PATCH`   | `/airports/{airport}` | Aeroport maglumatyny üýtgetmek           |
| `DELETE`      | `/airports/{airport}` | Aeroporty pozmak                         |


**Jogap mysaly (JSON):**

```json
{
  "data": [
    {
      "id": 1,
      "name": "Aşgabat Halkara Aeroporty",
      "code": "ASB",
      "city_id": "Aşgabat",
      "timezone": "Asia/Ashgabat"
      "created_at": "2026-01-15T10:00:00.000000Z"
    }
  ]
}
```

---



### ✈️ Reýsler / Uçuşlar (`/flights`)

Uçuşlar we tertipnama bilen işlemek.


| Usul (Method) | HTTP Ýoly           | Düşündiriş                            |
| ------------- | ------------------- | ------------------------------------- |
| `GET`         | `/flights`          | Bütün uçuşlaryň sanawyny almak        |
| `POST`        | `/flights`          | Täze reýs döretmek                    |
| `GET`         | `/flights/{flight}` | Reýs barada doly maglumat almak       |
| `PUT/PATCH`   | `/flights/{flight}` | Uçuş maglumatlaryny/wagtyny üýtgetmek |
| `DELETE`      | `/flights/{flight}` | Reýsi pozmak                          |


**Jogap mysaly (JSON):**

```json
{
  "data": {
    "id": 1,
    "airline": "JetBlue",
    "flight_code": "T5-421",
    "departure_airport_id": 1,
    "arrival_airport_id": 2,
    "departure_time": "2026-06-12 10:00:00",
    "arrival_time": "2026-06-12 14:30:00",
    "price": 180.00,
    "empty_seats": 85,
    "status": "Scheduled"
  }
}
```

---



### 👤 Ýolagçylar (`/passengers`)

Ýolagçylar sanawy we profilleri bilen işlemek.


| Usul (Method) | HTTP Ýoly                 | Düşündiriş                         |
| ------------- | ------------------------- | ---------------------------------- |
| `GET`         | `/passengers`             | Bütün ýolagçylary görmek           |
| `POST`        | `/passengers`             | Täze ýolagçy goşmak                |
| `GET`         | `/passengers/{passenger}` | Ýolagçy barada doly maglumat almak |
| `PUT/PATCH`   | `/passengers/{passenger}` | Ýolagçy maglumatlaryny täzelemek   |
| `DELETE`      | `/passengers/{passenger}` | Ýolagçyny pozmak                   |


**Haýyş mysaly (JSON):**

```json
{
  "id": 3,
  "full_name": "Aman Myradow",
  "email": "isazx4542@gmail.com",
  "card_num": "987 125 364 156",
  "phone": "+99362790545",
  "passport_code": "I-AS 237438"
}
```

---



### 🎫 Biletler we Bronlaşdyrmak (`/tickets`)

Biletler we bronlaşdyrmak amallary.


| Usul (Method) | HTTP Ýoly           | Düşündiriş                                    |
| ------------- | ------------------- | --------------------------------------------- |
| `GET`         | `/tickets`          | Bütün satylan biletler sanawy                 |
| `POST`        | `/tickets`          | Täze bilet döretmek                           |
| `GET`         | `/tickets/{ticket}` | Bilet barada doly maglumat almak              |
| `PUT/PATCH`   | `/tickets/{ticket}` | Bilet maglumatyny üýtgetmek                   |
| `DELETE`      | `/tickets/{ticket}` | Bileti ýatyrtyş etmek / pozmak                |
| `POST`        | `/bookings`         | **Täze bron/sargyt etmek (TicketController)** |


**Sargyt/Bron haýyş mysaly (JSON):**

```json
{

  "id": 4,
  "flight_id": 16,
  "passanger_id": 3,
  "seats_count": 6,
  "total_price": "2633.94",
  "status": "booked",
}
```

---



## 🚦 HTTP Jogap Kodlary (Status Codes)

Serwer tarapyndan gaýtarylýan standart HTTP status kodlary:

- `200 OK` — Haýyş üstünlikli ýerine ýetirildi.
- `201 Created` — Täze resurs üstünlikli döredildi.
- `400 Bad Request` — Haýyş maglumatynda ýalňyşlyk bar.
- `401 Unauthorized` — Awtorizasiýa/Token tapylmady.
- `404 Not Found` — Soralýan resurs tapylmady.
- `422 Unprocessable Entity` — Walidasiýa ýalňyşlygy (Laravel).
- `500 Internal Server Error` — Serweriň içki ýalňyşlygy.

