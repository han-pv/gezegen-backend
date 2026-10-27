# 🛫 Uçar Biletlerini Sargyt Etmek Ulgamynyň API Resminamasy

Bu resminama Laravel meňzeş backend serweri üçin API sorawlarynyň (request), jogaplarynyň (response), maglumat görnüşleriniň we ýalňyşlyklary işlemek (error handling) tertibiniň doly düşündirişini öz içine alýar.

---

## 📌 Esasy Salgy (Base URL)

Bütin sorawlar aşakdaky esasy salga ugradylýar:

```http
http://localhost:8000/api
```

---

## 🛠 Jemleýji Tablisa (Endpoints Overview)

| Usul (Method) | Salgy (Endpoint) | Düşündiriş |
| :--- | :--- | :--- |
| `GET` | `/flights` | Ahli aeroportlary we elýeterli uçar reýslerini (biletleri) almak. |
| `POST` | `/bookings` | Saýlanan uçar reýsine bilet (orun) sargyt etmek. |
| `GET` | `/seats` | Reýsler boýunça elýeterli boş orunlaryň sanyny reallawyk wagtda täzelemek. |

---

## 📚 Doly API Düşündirişi

### 1. Uçar Reýslerini we Aeroportlary Almak

Awtomatiki düşýän sanawlar (dropdowns) hem-da ähli bilet sanawyny görkezmek üçin maglumatlary getirýär.

* **URL:** `/flights`
* **Usul:** `GET`
* **Header:** `Accept: application/json`

#### Şowly Jogap (`200 OK`)

```json
{
  "airports": [
    {
      "id": 1,
      "code": "ASB",
      "city": "Aşgabat",
      "name": "Aşgabat Halkara Aeroporty"
    },
    {
      "id": 2,
      "code": "IST",
      "city": "Stambul",
      "name": "Stambul Aeroporty"
    },
    {
      "id": 3,
      "code": "DXB",
      "city": "Dubaý",
      "name": "Dubaý Halkara Aeroporty"
    }
  ],
  "tickets": [
    {
      "id": 101,
      "number": "T5-701",
      "airline": "Turkmenistan Airlines",
      "from": "ASB",
      "to": "IST",
      "date": "2026-11-05",
      "dep": "10:00",
      "arr": "12:30",
      "duration": "3h 30m",
      "price": 350.00,
      "seats": 15
    },
    {
      "id": 102,
      "number": "FZ-732",
      "airline": "Flydubai",
      "from": "ASB",
      "to": "DXB",
      "date": "2026-11-06",
      "dep": "14:20",
      "arr": "17:10",
      "duration": "3h 50m",
      "price": 290.00,
      "seats": 20
    }
  ]
}
```

---

### 2. Bilet Sargyt Etmek (Booking)

Ýolagçy baradaky maglumatlary kabul edip, saýlanan reýse bilet bronlyýar we boş orun sanyny azaldýar.

* **URL:** `/bookings`
* **Usul:** `POST`
* **Headers:**
  * `Content-Type: application/json`
  * `Accept: application/json`

#### Soraw Göwresi (Request Body)

```json
{
  "flight_id": 101,
  "first_name": "Mekan",
  "last_name": "Amanow",
  "email": "mekan.amanow@example.com"
}
```

#### Şowly Jogap (`201 Created` ýa-da `200 OK`)

```json
{
  "status": "success",
  "message": "Bilet üstünlikli sargyt edildi!",
  "booking_details": {
    "booking_reference": "TK-894102",
    "flight_id": 101,
    "remaining_seats": 14,
    "passenger": {
      "first_name": "Mekan",
      "last_name": "Amanow",
      "email": "mekan.amanow@example.com"
    }
  }
}
```

#### Ýalňyşlyk Jogaplary

1. **Boş Orun Galmadyk Ýagdaýynda (`409 Conflict`):**

   ```json
   {
     "status": "error",
     "message": "Ötünç soňramyz, bu reýsde hiç hili boş orun galmady."
   }
   ```

2. **Forma Maglumatlary Nädogry Doldurylsa (`422 Unprocessable Entity`):**

   ```json
   {
     "message": "Girizilen maglumatlar nädogry.",
     "errors": {
       "first_name": [
         "At meýdançasy doldurylmalydyr."
       ],
       "email": [
         "Dogry e-posta salgysyny giriziň."
       ]
     }
   }
   ```

---

### 3. Reallawyk Wagtda Orunlary Barlamak

Reýslerdäki boş orunlaryň sanyny aralykda täzeläp durmak üçin ulanylýar.

* **URL:** `/seats`
* **Usul:** `GET`

#### Şowly Jogap (`200 OK`)

```json
[
  {
    "flight_id": 101,
    "seats": 14
  },
  {
    "flight_id": 102,
    "seats": 20
  }
]
```

---

## 🗄️ Maglumat Bazasy we Test Maglumatlary (Seeding & Factories)

Laravel tarapda wagtlaýyn we barlag maglumatlaryny döretmek üçin aşakdaky buýruklar ulanylýar:

### Bazany täzelemek we Seeder işletmek:
```bash
php artisan migrate:fresh --seed
```

### Factory arkaly awtomatiki täze 35 reýs döretmek:
```bash
php artisan tinker
```
Tinker terminalynda:
```php
\App\Models\Flight::factory()->count(35)->create();
```