# 📌 Apa Itu Docker?
Docker adalah platform open-source untuk mengembangkan, mengirim, dan menjalankan aplikasi dalam container. Container memungkinkan Anda mengemas aplikasi beserta semua dependensinya dalam satu unit yang standar untuk pengembangan perangkat lunak.


## Manfaat Utama

✔ Isolasi – Aplikasi berjalan di lingkungan terpisah

✔ Portabilitas – Berjalan di OS apapun yang mendukung Docker

✔ Efisiensi – Lebih ringan dibandingkan virtual machine

✔ Reproduktibilitas – Lingkungan yang sama antara development dan produksi


## 1. Struktur Proyek
```
project-folder/

├── backend/
│    └── Dockerfile     # Dockerfile untuk Backend CodeIgniter
│    └── .env          # Konfigurasi variabel lingkungan
├── frontend/
│    └── Dockerfile    # Dockerfile untuk Frontend Laravel
│    └── .env          # Konfigurasi variabel lingkungan
├── nginx/             # Konfigurasi Nginx
│    └── nginx.conf
├── docker-compose.yml # Konfigurasi utama Docker
```

![image](https://github.com/user-attachments/assets/bf45b2d3-0dd4-4ba3-ad2c-14d7e670c4cd)

## 2.Clone Repository
Untuk backend 
```
git clone https://github.com/azkaxfannx/be-krs.git
```
Untuk frontend
```
git clone https://github.com/AlfitoAdityaProtic/FE-PBF-KRS.git
```

## 3. File nginx.conf
  File nginx.conf adalah file konfigurasi utama untuk Nginx, file ini biasanya digunakan untuk:
  Konfigurasi Nginx sebagai reverse proxy untuk:  
  Melayani file static frontend
  Meneruskan request /api ke backend


## File docker-compose.yml
  Merupakan file yang akan dituju ketika akan ngebuild container. Docker compose berisi tentang informasi dan konfigurasi mengenai inti dari hasil dari proyek yang nanti dibuild
  File ini untuk Mengatur:
  Definisi semua service (backend, frontend, database)
  Jaringan antar container
  Port mapping
  Volume persistence
  Dependency management antar service
  Environment configuration
#### Docker pada container
Akses Aplikasi
```
app.baseURL = 'http://localhost:8080/' // Untuk backend
APP_URL=http://localhost:8000 // Untuk frontend
```
## Build Container
untuk membangun satu kontainer utuh dan menyatukan semua bagiain proyek, yang berjalan dalam satu lingkungan (contianer atau peti kemas)
Docker pada Container
![image](https://github.com/user-attachments/assets/96ac2d22-b26b-485b-84e0-15952bf8c1ed)
Docker pada images
![image](https://github.com/user-attachments/assets/708f8db1-cbfa-4e09-b606-5b91ff2b5af4)
Akses aplikasi 
Halaman Login
![image](https://github.com/user-attachments/assets/69ed76a9-0062-493a-bd9f-2f7af9fa9aae)
Halaman Register
![image](https://github.com/user-attachments/assets/c5b3f3d5-76c7-4afd-a605-970e811408ee)




