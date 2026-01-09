# Membership Case API

Laravel 11 kullanılarak geliştirilmiş public bir üyelik API’sidir.

Sistem; firmalar ve bu firmalara bağlı kullanıcıların yönetilmesini sağlar.

---

## Özellikler

- Firma bilgisi ile kullanıcı oluşturma
- Kullanıcı listeleme (filtreleme destekli)
- Kullanıcı güncelleme
- Kullanıcı silme (soft delete)
- Repository – Service mimarisi

---

## Kullanılan Teknolojiler

- PHP 8.2+
- Laravel 11
- MySQL
- Postman

---

## Mimari Yapı

Projede Repository – Service mimarisi uygulanmıştır.

- Controller katmanı HTTP isteklerini yönetir
- Service katmanı iş kurallarını içerir
- Repository katmanı veritabanı işlemlerini gerçekleştirir
- Model katmanı veri yapısını ve ilişkileri tanımlar

Bu yapı sayesinde controller’lar sade tutulmuş ve kod okunabilirliği artırılmıştır.

---

## API Testleri

- Postman collection dosyası proje içerisinde yer almaktadır.
- Dosya yolu: postman/membership-case-api.postman_collection.json


---
## .env dosyasını güncelleyin:
- SQL dosyasını içe aktarma: mysql -u root -p membershipcase < sql/membershipCase.sql
- DB_DATABASE=membershipcase
- DB_USERNAME=root
- DB_PASSWORD=*****


---
## Kurulum
- git clone https://github.com/USERNAME/membership-case.git
- cd membership-case
- composer install
- cp .env.example .env
- php artisan key:generate
