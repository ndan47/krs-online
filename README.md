📌 Apa Itu Docker?
Docker adalah platform open-source untuk mengembangkan, mengirim, dan menjalankan aplikasi dalam container. Container memungkinkan Anda mengemas aplikasi beserta semua dependensinya dalam satu unit yang standar untuk pengembangan perangkat lunak.



Manfaat Utama
✔ Isolasi – Aplikasi berjalan di lingkungan terpisah
✔ Portabilitas – Berjalan di OS apapun yang mendukung Docker
✔ Efisiensi – Lebih ringan dibandingkan virtual machine
✔ Reproduktibilitas – Lingkungan yang sama antara development dan produksi







Struktur Proyek
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
