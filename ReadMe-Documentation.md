# Gezegen — Uçar biletlerini gözlemek we bronlamak ulgamy

Bu taslama okuw maksatly bolup, **Laravel 13** (Backend) we **Vue 3** (Composition API, Vite, Tailwind CSS - Frontend) tehnologiýalaryny ulanyp, serwer bilen müşderi tarapynyň özara arabaglanyşygyny öwrenmek üçin döredildi.

---

## 1. Maglumat binýadynyň gurluşy (Migrasiýalar we Siderler)

Maglumat binýady özara baglanyşykly 5 sany tablisadan ybarat:

### 1. `cities` (Şäherler)
* `id` — Esasy düwün (Primary Key)
* `name` — Şäheriň ady (mysal üçin: *New York*, *Los Angeles*)
* `slug` — Unikal tekst belgisi (mysal üçin: *new-york*)

### 2. `airports` (Aeraportlar)
* `id` — Esasy düwün
* `name` — Aeraportyň doly ady (mysal üçin: *John F. Kennedy International Airport*)
* `code` — 3 harply IATA kody (unikal, mysal üçin: *JFK*)
* `city_id` — Daşky düwün (`cities.id` bilen baglanyşykly)

### 3. `flights` (Uçuşlar)
* `id` — Esasy düwün
* `from_airport_id` — Uçulýan aeroport (`airports.id` bilen baglanyşykly)
* `to_airport_id` — Barylýan aeroport (`airports.id` bilen baglanyşykly)
* `from_time` / `to_time` — Uçuş we konuş wagty (görnüşi: `time`)
* `code` — Uçuş belgisi (unikal, mysal üçin: *AA101*)
* `airlines` — Awiakompaniýanyň ady (mysal üçin: *American Airlines*)

### 4. `tickets` (Mugt biletler we seneler)
* `id` — Esasy düwün
* `flight_id` — Daşky düwün (`flights.id` bilen baglanyşykly)
* `date` — Uçuş senesi (görnüşi: `date`)
* `price` — Biletiň bahasy
* `seats` — Boş ýerleriň sany (görnüşi: `unsignedSmallInteger`, başlangyç bahasy: `20`)

### 5. `passengers` (Ýolagçylar)
* `id` — Esasy düwün
* `first_name` / `last_name` — Ýolagçynyň ady we familiýasy
* `email` — E-poçta salgysy
* `phone` — Telefon belgisi
* `passport_number` — Pasport belgisi (unikal)

---

## 2. API Salgylary (Laravel Backend)

Bütin API salgylary `routes/api.php` faýlynda `/v1` prefiksi bilen ýazylan:

* `GET /api/v1/cities` — Bütin şäherleriň sanawy
* `GET /api/v1/airports` — Bütin aeroportlaryň sanawy
* `GET /api/v1/flights` — Bütin uçuşlaryň sanawy
* `GET /api/v1/tickets` — Bütin biletleriň sanawy
* `POST /api/v1/tickets/{ticket}/book` — Bilet bronlamak:
  * Ýolagçynyň maglumatlaryny قبول edýär (`first_name`, `last_name`, `email`, `phone`, `passport_number`)
  * `passengers` tablisasynda täze ýolagçy döredýär
  * Degişli biletiň boş ýerlerini 1 sany azaldýar (`$ticket->decrement('seats')`)

---

## 3. Müşderi tarapy (Vue 3 Frontend)

Esasy komponent — **`FlightsPage.vue`**:

1. **Maglumatlary ýüklemek (`onMounted`):**
   Sahypa açylanda `Promise.all` arkaly şäherler, aeroportlar, uçuşlar we biletler birwagtda serwerden çekilýär.
2. **Maglumatlary birleşdirmek (`normalize`):**
   Uçuşlaryň we aeroportlaryň ID-lerini biletler bilen birleşdirip, uçuş müddetini (`durationOf`) we wagtlary amatly görnüşe geçirýär.
3. **Gözleg we süzgüç (Filter):**
   Uçulýan/barylýan şäherleri we uçuş senesini saýlamaga mümkinçilik berýär.
4. **Bilet satyn almak:**
   Forma doldurylyp ugradylanda, serwere `POST` haýyşy gidýär we hem maglumat binýadynda, hem-de ekranda boş ýerleriň sany (mysal üçin 20-den 19-a) täzelenýär.

---
