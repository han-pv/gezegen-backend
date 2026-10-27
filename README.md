Gezegen: şäherler, oteller we uçar biletleri bilen işleýän syýahatçylyk programmasy. Backend **Laravel**, frontend **Vue**.

Bu faýl şu ýagdaý üçin ýazyldy: proýekt eýesiniň kompýuterinde işleýär, siz bolsa **şol bir Wi-Fi arkaly** onuň IP adresine birigip, **uçarlary (airplane), reýsleri (flight), biletleri (ticket), ýolagçylary (passenger)** we beýleki maglumatlary görýärsiňiz.

---

## Mazmuny

1. [Esasy düşünje](#1-esasy-düşünje)
2. [Eýesi üçin: serweri nädip açmaly](#2-eýesi-üçin-serweri-nädip-açmaly)
3. [Dostlar üçin: nädip birigmeli](#3-dostlar-üçin-nädip-birigmeli)
4. [Maglumatlary nädip görmeli](#4-maglumatlary-nädip-görmeli)
5. [Bilet ýolagçylary nirede görünýär](#5-bilet-we-ýolagçylar-nirede-görünýär)
6. [Maglumat goşmak (POST)](#6-maglumat-goşmak-post)
7. [Sahypany (frontend) açmak](#7-sahypany-frontend-açmak)
8. [Ýalňyşlyklar we çözgütler](#8-ýalňyşlyklar-we-çözgütler)
9. [Howpsuzlyk](#9-howpsuzlyk)

---

## 1. Esasy düşünje

- Proýekt **eýesiniň kompýuterinde** işleýär. Siziň kompýuteriňizde hiç zat gurmaly däl.
- Siz diňe **brauzer** (Chrome, Safari, Firefox) bilen eýesiniň **IP adresine** girýärsiňiz.
- Ikiňiz hem **bir Wi-Fi ulgamynda** bolmaly (bir router).
- Backend maglumatlary **JSON** görnüşinde berýär. Brauzerde ol tekst görnüşinde açylýar, bu dogry.

Aşakdaky mysallarda eýesiniň IP adresi `192.168.1.5` diýip alyndy. Siz **eýesinden öz IP adresini soraň** we ýazgylarda `192.168.1.5` ýerine şony ýazyň.

---

## 2. Eýesi üçin: serweri nädip açmaly

### 2.1. IP adresiňizi tapyň

Windows (PowerShell ýa-da CMD):

```powershell
ipconfig
```

**Wireless LAN adapter Wi-Fi** bölüminde **IPv4 Address** setirine seret. Mysal üçin `192.168.1.5`. Şol IP-ni dostlaryňyza beriň.

### 2.2. Laravel serweri hemmeler üçin açyň

Her gezek `127.0.0.1` däl, `0.0.0.0` bilen işledýär. Şonda başga enjamlar hem birigip bilýär:

```powershell
cd C:\Users\User\Desktop\gezegen_backend
php artisan serve --host=0.0.0.0 --port=8000
```

`php artisan serve` diňe (`--host` ýazman) işletseňiz, diňe öz kompýuteriňizden açylýar, dostlaryňyz birigip bilmeýär.

### 2.3. Windows Firewall-da portlary açyň

Dostlaryňyz birigip bilmese, köplenç sebäp firewall. PowerShell-i **Administrator** hökmünde açyp işlediň:

```powershell
New-NetFirewallRule -DisplayName "Laravel 8000" -Direction Inbound -Protocol TCP -LocalPort 8000 -Action Allow
New-NetFirewallRule -DisplayName "Vite 5173" -Direction Inbound -Protocol TCP -LocalPort 5173 -Action Allow
```

Wi-Fi ulgamynyň görnüşi **Private** bolmaly (Settings > Network & Internet > Wi-Fi > öz ulgamyňyz > Network profile type > **Private**). **Public** bolsa, Windows gelýän soraglary başda ýapýar.

### 2.4. Maglumat bazasyny taýýarlaň

Dostlaryňyz görer ýaly bazada maglumat bolmaly:

```powershell
php artisan migrate --seed
```

Nol-dan başlamak isleseňiz (**ähli maglumat pozulýar**):

```powershell
php artisan migrate:fresh --seed
```

### 2.5. Frontend-i hem açmak isleseňiz

Frontend papkasynda:

```powershell
npm run dev -- --host
```

`--host` Vite-i başga enjamlara açýar. Adresi terminalda **Network:** setirinde görersiňiz, mysal üçin `http://192.168.1.5:5173`.

`vite.config.js`-de `/api` Laravel-e ugrukdyrylmaly (`server.proxy`):

```js
server: {
  proxy: {
    '/api': 'http://127.0.0.1:8000',
  },
},
```

Bu ýagdaýda dostlaryňyz diňe `5173` portuna girýär, `/api` soraglary Vite arkaly sizde Laravel-e barýar.

---

## 3. Dostlar üçin: nädip birigmeli

1. **Eýesi bilen bir Wi-Fi-a** birigiň (mobil maglumat ýa-da başga Wi-Fi ýaramaýar).
2. VPN bar bolsa, **öçüriň**.
3. Brauzerde şu adresi açyň (IP-ni eýesinden alyň):

```
http://192.168.1.5:8000/api/v1/airplanes
```

JSON görünse, birigdiňiz. Netije şuňa meňzeş bolmaly:

```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "airline": "Turkish Airlines",
      "model": "Airbus A320",
      "registration_number": "AB-123",
      "capacity": 180,
      "active": true
    }
  ],
  "total": 10
}
```

> Esasy sahypa `http://192.168.1.5:8000/` Laravel-iň garşylama sahypasyny görkezip biler. Maglumatlar hemişe `/api/v1/...` ýollarynda.

**`127.0.0.1` ýa-da `localhost` ýazmaň.** Olar siziň öz kompýuteriňize ugrukdyrýar, eýesine däl.

---

## 4. Maglumatlary nädip görmeli

Hemme adresler `GET`, ýagny brauzeriň adres setirine ýazyp açylýar. `192.168.1.5` ýerine eýesiniň IP-ni ýazyň.

Ähli ýollar `http://192.168.1.5:8000/api/v1` bilen başlaýar.

| Näme görmeli | Adres | Düşündiriş |
|---|---|---|
| **Uçarlar (airplane)** | `/airplanes` | Uçarlaryň sanawy: aviakompaniýa, model, registrasiýa belgisi, sygym |
| Bir uçar | `/airplanes/1` | ID-si 1 bolan uçar |
| **Reýsler (flight)** | `/flights` | Geljekdäki reýsler (sahypalanan) |
| Bir reýs | `/flights/1` | ID-si 1 bolan reýs, şäherler bilen |
| Reýs gözlegi | `/flights?from=1&to=2` | 1-nji şäherden 2-nji şähere reýsler |
| Seneden gözleg | `/flights?from=1&to=2&date=2026-11-10` | Belli günüň reýsleri |
| Ýurtlar we şäherler | `/flights/locations` | Ýurt boýunça toparlanan şäherler we olaryň ID-leri |
| Şäherler | `/cities` | Şäherleriň sanawy |
| Oteller | `/hotels` | Otelleriň sanawy |
| Oteller (filtr) | `/hotels?rating=4` | 4 ýyldyzly oteller |
| **Bilet (ticket)** | `/tickets/KOD` | Bilet koduna görä bilet, **ýolagçylary bilen** |

### Sahypalama (pagination)

Uzyn sanawlar sahypa-sahypa berilýär. Indiki sahypa:

```
/flights?page=2
/airplanes?page=2
```

Jogapda şu meýdanlara serediň:

| Meýdan | Manysy |
|---|---|
| `current_page` | häzirki sahypa |
| `last_page` | iň soňky sahypa |
| `total` | jemi ýazgy sany |
| `data` | şu sahypadaky ýazgylar |

Bir sahypada näçe ýazgy görkezmelidigini `per_page` bilen üýtgedip bolýar (iň köp 50):

```
/flights?per_page=20
```

### Şäher ID-sini nädip tapmaly

`/flights?from=1&to=2` ýazanyňyzda `1` we `2` şäherleriň ID-si. Ony **`/flights/locations`** adresinde görýärsiňiz:

```json
[
  {
    "country": "Turkey",
    "cities": [
      { "id": 3, "name": "Istanbul", "country": "Turkey" }
    ]
  }
]
```

### Reýsde görünýän meýdanlar

| Meýdan | Manysy |
|---|---|
| `from_city`, `to_city` | nireden we nirä |
| `airline`, `flight_number` | aviakompaniýa we reýs belgisi |
| `departure_at`, `arrival_at` | uçýan we gonýan wagty (UTC) |
| `price` | bir ýeriň bahasy |
| `available_seats` | boş ýer sany |
| `total_price` | ýolagçy sanyna görä umumy baha (`passengers` parametri bilen) |

Boş ýer sany bilen 3 ýolagçy üçin bahany görmek:

```
/flights?from=1&to=2&passengers=3
```

> Brauzerde JSON okamak kyn bolsa, Chrome-a **JSON Viewer** goşundysyny guruň. Şonda JSON reňkli we agaç görnüşinde görünýär.

---

## 5. Bilet we ýolagçylar nirede görünýär

**Ýolagçylaryň aýratyn adresi ýok.** Olar **biletiň içinde** görünýär. Her biletiň 8 belgili kody bar (mysal üçin `K8D2Q7ZP`).

```
http://192.168.1.5:8000/api/v1/tickets/K8D2Q7ZP
```

Jogap:

```json
{
  "id": 5,
  "code": "K8D2Q7ZP",
  "total_price": "500.00",
  "status": "confirmed",
  "passengers": [
    { "id": 9,  "first_name": "Ata",  "last_name": "Atayew", "age": 30, "phone": "+99365123456" },
    { "id": 10, "first_name": "Aman", "last_name": "Atayew", "age": 8,  "phone": "+99365123456" }
  ],
  "flight": {
    "airline": "Turkish Airlines",
    "flight_number": "TK482",
    "departure_at": "2026-11-05T09:00:00.000000Z",
    "from_city": { "name": "Ashgabat" },
    "to_city":   { "name": "Istanbul" }
  }
}
```

| Meýdan | Manysy |
|---|---|
| `code` | bilet kody |
| `status` | `confirmed` (tassyklandy) ýa-da `cancelled` (ýatyryldy) |
| `total_price` | ähli ýolagçylar üçin umumy baha |
| `passengers` | bu biletdäki **ýolagçylaryň** sanawy (ady, familiýasy, ýaşy, telefon) |
| `flight` | bu bilet haýsy **reýse** degişli (we onuň şäherleri) |

### Bilet kodyny nireden almaly

1. **Özüňiz bilet satyn alyň** (6-njy bölüm ýa-da 7-nji bölüm). Satyn alandan soň kody görkezýär.
2. **Eýesinden soraň.** Eýesi bazadaky kodlary şeýle görüp biler:

```powershell
php artisan tinker
```
```php
App\Models\Ticket\Ticket::pluck('code');
```

---

## 6. Maglumat goşmak (POST)

Adres setirine ýazyp diňe **görüp** bolýar. Täze zat **goşmak** üçin **Postman** (ýa-da Insomnia) gerek.

Her soragda iki sany başlyk (headers) goýuň:

```
Accept: application/json
Content-Type: application/json
```

Body: **raw > JSON**.

### Uçar goşmak

`POST http://192.168.1.5:8000/api/v1/airplanes`

```json
{
  "airline": "Turkmenistan Airlines",
  "model": "Boeing 737-800",
  "registration_number": "EZ-A101",
  "capacity": 189
}
```

### Reýs goşmak

`POST http://192.168.1.5:8000/api/v1/flights`

```json
{
  "from_city_id": 1,
  "to_city_id": 2,
  "airplane_id": 1,
  "flight_number": "T5101",
  "departure_at": "2026-12-10 09:00:00",
  "arrival_at": "2026-12-10 12:30:00",
  "price": 250
}
```

`airplane_id` bar bolan uçaryň ID-si bolmaly. Ýer sany we aviakompaniýa uçardan awtomatiki alynýar.

### Bilet satyn almak (ýolagçylar bilen)

Ilki bahany barlap bilersiňiz: `POST /api/v1/tickets/quote`

```json
{ "flight_id": 1, "passengers": 2 }
```

Satyn almak: `POST http://192.168.1.5:8000/api/v1/tickets`

```json
{
  "flight_id": 1,
  "passengers": [
    { "first_name": "Ata",  "last_name": "Atayew", "age": 30, "phone": "+99365123456" },
    { "first_name": "Aman", "last_name": "Atayew", "age": 8,  "phone": "+99365123456" }
  ]
}
```

Jogapdaky `code` meýdany biletiň kody. Şol kody `/tickets/KOD` adresinde ulanyp, biletiňizi we ýolagçylaryňyzy görüp bilersiňiz.

### Bilet düzgünleri

- Bir biletde **1-den 9-a çenli** ýolagçy bolup biler.
- Iň az **bir ýolagçy 18 ýaşda ýa-da ondan uly** bolmaly. Hemmesi 18-den kiçi bolsa, bilet satylmaýar.
- Reýsde ýeterlik boş ýer bolmaly.
- Her ýolagçy üçin **ady, familiýasy, ýaşy we telefon belgisi** hökmany.
- Bilet satyn alnanda reýsiň boş ýer sany ýolagçy sany ýaly azalýar.

### Ýalňyşlyk jogaplary

`422` ýalňyşlygy dogry däl maglumat iberlenini aňladýar. Jogapda nämäniň nädogrydygy görkezilýär:

```json
{
  "message": "The passengers.0.age field is required.",
  "errors": {
    "passengers.0.age": ["The passengers.0.age field is required."]
  }
}
```

| Kod | Manysy |
|---|---|
| `200`, `201` | Üstünlikli |
| `404` | Tapylmady (ýalňyş ID ýa-da bilet kody) |
| `422` | Maglumat nädogry ýa-da düzgün bozuldy (ýer ýok, 18 ýaş düzgüni we ş.m.) |
| `500` | Serwer ýalňyşlygy, eýesine habar beriň |

---

## 7. Sahypany (frontend) açmak

Eýesi frontend-i hem işletse (`npm run dev -- --host`), JSON däl, **taýýar sahypany** görüp bilersiňiz:

```
http://192.168.1.5:5173
```

| Sahypa | Adres | Näme edip bolýar |
|---|---|---|
| Baş sahypa | `/` | Umumy görnüş we şäherler |
| Şäherler | `/cities` | Şäherleriň sanawy |
| Oteller | `/hotels` | Otelleriň sanawy |
| **Biletler** | `/tickets` | Reýs gözlemek we bilet satyn almak |

**Bilet satyn almak ädimleri:**

1. `/tickets` sahypasyny açyň, aşakda ähli reýsler görünýär.
2. Gerek bolsa ugry saýlaň: nireden (ýurt, şäher), nirä (ýurt, şäher), seneni, soň **Find flights**.
3. Reýs ýok bolsa, "No flights available for this route." ýazgysy çykýar.
4. Reýsi tapsaňyz **Select** basyň.
5. Ýolagçylary girizip: **ady, familiýasy, ýaşy, telefon belgisi**. Köp ýolagçy üçin **+ Add passenger** basyň.
6. Umumy baha serwerden hasaplanyp görkezilýär.
7. **Buy** basyň. Bilet kody çykýar. Ony ýazyp alyň.

Hiç bir ýolagçy 18 ýaşda bolmasa, duýduryş çykýar we **Buy** düwmesi işlemeýär.

Sahypanyň ýokarsynda dark mode düwmesi bar. Açyk we gara görnüşi çalşyp bolýar.

---

## 8. Ýalňyşlyklar we çözgütler

### Dostlar üçin

| Ýagdaý | Sebäp we çözgüt |
|---|---|
| Sahypa açylmaýar (`This site can't be reached`, `ERR_CONNECTION_TIMED_OUT`) | Bir Wi-Fi-dämi? Eýesiniň serweri `--host=0.0.0.0` bilen işleýärmi? Firewall port açykmy? Eýesine aýdyň. |
| `ERR_CONNECTION_REFUSED` | Serwer işlemeýär ýa-da `--host=0.0.0.0` ýok. Eýesine aýdyň. |
| Öň işledi, indi işlemeýär | Eýesiniň IP adresi üýtgän bolup biler (router adresi täzeden berýär). Täze IP-ni soraň. |
| `localhost` ýa-da `127.0.0.1` açylmaýar | Bu siziň öz kompýuteriňiz. Eýesiniň IP-ni ulanyň. |
| `404 Not Found` | Adresde ýalňyşlyk ýa-da şeýle ID ýok. `/api/v1/...` bilen başlandygyny barlaň. |
| Reýsler boş (`"data": []`) | Bazada bu ugurda reýs ýok. Başga şäherler synap görüň ýa-da `/flights` ugursyz açyň. |
| JSON-yň ýerine ak sahypa ýa-da HTML | Adres `/api/v1/` bilen başlamaýar. |

### Eýesi üçin

| Ýagdaý | Çözgüt |
|---|---|
| Dostlar birigip bilmeýär | `ipconfig` bilen IP-ni täzeden barlaň, firewall düzgünlerini goşuň, serweri `--host=0.0.0.0` bilen işledip görüň. |
| Router "AP isolation" / "Client isolation" ulanýar | Bu bar bolsa, enjamlar biri-birini görmeýär. Router sazlamalaryndan öçüriň. Myhman Wi-Fi-da köplenç ýapyk bolýar. |
| Wi-Fi ulgamy "Public" | "Private" edip üýtgediň. |
| VPN ýa-da başga antivirus | Wagtlaýynça öçürip synap görüň. |
| Frontend-de `/api` işlemeýär | `vite.config.js`-de `server.proxy` we Laravel serweriniň işleýändigini barlaň. |
| `500` ýalňyşlyk | `storage/logs/laravel.log` faýlyny açyp soňky ýalňyşlygy görüň. |
| Maglumat köne ýa-da boş | `php artisan migrate:fresh --seed` işlediň (ähli maglumat täzelenýär). |

Ýalňyşlyk bolanda käbir wagt keşi arassalamak kömek edýär:

```powershell
php artisan optimize:clear
```

---

## 9. Howpsuzlyk

Serweri öý ýa-da synp Wi-Fi-ynda ulanmak amatly, ýöne **ätiýaçly bolmaly**:

- Häzirki wersiýada **login ýok**. Şonuň üçin `POST` soraglary (uçar, reýs, bilet goşmak) **ulgamdaky islendik adam** üçin açyk. Diňe ynamly adamlar bilen paýlaşyň.
- Serweri **diňe zerur wagtynda** işlediň, işiňiz gutarandan soň `Ctrl + C` bilen duruzyň.
- Dostlaryňyz bilen synaglandan soň, bazadaky **hakyky şahsy maglumatlary** (hakyky telefon, hakyky at) girizmäň. Synag maglumatlaryny ulanyň.
- `.env` faýlyny **hiç kime iberme**. Içinde baza parolyňyz bar.
- Eýesi üçin: `.env`-de `APP_DEBUG=true` bolsa, ýalňyşlyk wagtynda faýl ýollary we koduň bölekleri başgalara görünýär. Dostlara açyk wagtynda `APP_DEBUG=false` etmek has howpsuz. Üýtgedeniňizden soň `php artisan optimize:clear` işlediň.
- Internete açmaň (router-de port forwarding etmäň). Bu gollanma diňe ýerli (öý) Wi-Fi ulgamy üçin.

---

## Gysga ýat kagyzy

```
Eýesi:     php artisan serve --host=0.0.0.0 --port=8000
           npm run dev -- --host
           ipconfig           ->  IPv4 Address (mysal: 192.168.1.5)

Dostlar:   http://192.168.1.5:8000/api/v1/airplanes
           http://192.168.1.5:8000/api/v1/flights
           http://192.168.1.5:8000/api/v1/flights/locations
           http://192.168.1.5:8000/api/v1/tickets/BILET_KODY   (ýolagçylar bilen)
           http://192.168.1.5:5173/tickets                      (taýýar sahypa)
```