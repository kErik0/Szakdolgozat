# README – Állásportál Projekt (Laravel + Vue + Vite)

Ez a dokumentum a projekt gyors és egyszerű futtatásához szükséges lépéseket tartalmazza.

## 1. Szükséges programok
A projekt futtatásához telepíteni kell:
* **PHP:** 8.1+
* **Composer**
* **Node.js:** 18+
* **MySQL**
* **Git**

## 2. Projekt letöltése
```bash
git clone https://github.com/kErik0/Szakdolgozat.git
cd Szakdolgozat
```
A projekt tartalmazza a .env fájlt → nincs teendő vele, csak győződjön meg róla, hogy MySQL fut.

## 3. Adatbázis importálása
A projekt tartalmazza az adatbázis dumpot: allasportal.sql

Importálás menete:
phpMyAdminban: Importálás → fájl kiválasztása → allasportal.sql → Indítás <br>
VAGY parancssorból: (Feltételezve, hogy az adatbázis neve: allasportal — ez szerepel a .env-ben is.)
```bash
mysql -u root -p allasportal < allasportal.sql
```

## 4. Backend telepítése
```bash
composer install
```

## 5. Frontend telepítése
```bash
npm install
```

## 6. Backend indítása
```bash
php artisan serve
```
A projekt elérhető itt: http://127.0.0.1:8000

## 7. Frontend indítása
```bash
npm run dev
```
## 7+1. 
Képek megjelenítése (Storage Link) Laravelnél gyakori, hogy a feltöltött képek nem jelennek meg azonnal. Ha a "Backend telepítése" után nem látszanak a képek/ikonok, akkor futtatni kell még ezt az egy parancsot: 
```bash
php artisan storage:link
```
