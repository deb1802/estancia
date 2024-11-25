# Proyecto [Sistema Web de Gestión de Movilidad Sustentable en la Comunidad Universitaria]

Este repositorio contiene los archivos necesarios para implementar y utilizar el sistema, incluida la configuración de la base de datos.

## Configuración de la Base de Datos

### Importar la Base de Datos

1. Asegúrate de tener instalado el sistema de gestión de base de datos requerido:
   - MySQL 8.0+ o PostgreSQL 13+.

2. Descarga el archivo SQL incluido en este repositorio (`[initial_data.sql]`) y guárdalo en tu máquina local.

3. Abre tu terminal y utiliza uno de los siguientes comandos, dependiendo del sistema de gestión de base de datos que estés utilizando:

   - **Para MySQL**:
     ```bash
     mysql -u [usuario] -p [nombre_base_datos] < [ruta_del_archivo.sql]
     ```
     Reemplaza `[usuario]` con tu nombre de usuario, `[nombre_base_datos]` con el nombre de la base de datos, y `[ruta_del_archivo.sql]` con la ubicación del archivo SQL.

   - **Para PostgreSQL**:
     ```bash
     psql -U [usuario] -d [nombre_base_datos] -f [ruta_del_archivo.sql]
     ```
     Reemplaza `[usuario]`, `[nombre_base_datos]`, y `[ruta_del_archivo.sql]` según corresponda.

### Dependencias Necesarias

Antes de importar y usar la base de datos, verifica que cuentas con lo siguiente:

- **Sistema de gestión de bases de datos**:
  - MySQL: [Descargar MySQL](https://dev.mysql.com/downloads/)
  - PostgreSQL: [Descargar PostgreSQL](https://www.postgresql.org/download/)

- **Administrador de base de datos opcional**:
  - phpMyAdmin (para MySQL): [Descargar phpMyAdmin](https://www.phpmyadmin.net/)
  - pgAdmin (para PostgreSQL): [Descargar pgAdmin](https://www.pgadmin.org/download/)

- **Archivo de configuración del proyecto**:  
  Asegúrate de que el archivo `estancia/model/db.php` esté correctamente configurado para conectar el sistema con la base de datos.