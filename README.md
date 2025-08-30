# 🚀 Proyecto CRUD con Laravel + MongoDB Atlas + Docker

## 📌 Resumen
Este proyecto implementa un **CRUD (Crear, Leer, Actualizar, Eliminar)** en **Laravel 12** que expone una **API RESTful** conectada a **MongoDB Atlas**.  
El sistema está contenerizado con **Docker**, por lo que se puede ejecutar sin instalar PHP, Composer o MongoDB en la máquina host.

---

## ⚙️ Tecnologías
- **Laravel 12.x**
- **PHP 8.2+**
- **MongoDB Atlas** (base de datos en la nube)
- **Paquete:** [`mongodb/laravel-mongodb`](https://github.com/mongodb/laravel-mongodb)  
  > Nota: la especificación mencionaba `jenssegers/laravel-mongodb`, pero este proyecto usa el **paquete oficial y actualizado de MongoDB**.
- **Docker & Docker Compose**
- **cURL / Postman** para pruebas

---

## 📂 Estructura del Proyecto
- **Backend (Laravel)** → contenedor `laravel-app`  
- **Base de datos** → MongoDB Atlas (se migraron pacientes desde Mongo local con `mongodump`/`mongorestore`)  
- **Endpoints API** → `/api/pacientes`
- **UI** → `/pacientes-ui` (Blade + Bootstrap)

---

## 🐳 Instalación con Docker

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/tu-usuario/laravel-mongo-crud.git
   cd laravel-mongo-crud
