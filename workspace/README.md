# Entorno de desarrollo

Entorno Docker para las prácticas de **Desarrollo Web en Entorno Servidor** (PHP 8.4 + Apache, MariaDB y phpMyAdmin). El código PHP se edita en el host y se sirve dentro del contenedor.

## Estructura

```text
workspace/
├── docker-compose.yml      # Orquestación de los servicios
├── .env                    # Variables de MariaDB y puerto de phpMyAdmin
├── .vscode/
│   └── launch.json         # Depuración con Xdebug (puerto 9003)
├── docker/
│   ├── Dockerfile          # Imagen PHP 8.4 + Apache + Xdebug + Composer
│   ├── apache/vhost.conf   # VirtualHost (DocumentRoot /var/www/html)
│   └── php/conf.d/
│       └── xdebug.ini      # Xdebug en modo debug hacia el host
└── src/                    # Código de la aplicación (montar en el contenedor)
    └── index.php
```

| Servicio     | Contenedor     | Función                                      | Acceso                         |
|--------------|----------------|----------------------------------------------|--------------------------------|
| `web`        | `php-apache`   | Apache + PHP 8.4, Xdebug y Composer          | http://localhost               |
| `db`         | `db`           | MariaDB 11.8 (volumen persistente)           | puerto interno 3306            |
| `phpmyadmin` | `phpmyadmin`   | Administración web de la base de datos       | http://localhost:8000          |

El directorio [src](src) se monta en `/var/www/html`. Cualquier cambio en los ficheros se refleja al recargar el navegador, sin reconstruir la imagen.

La imagen instala `pdo_mysql` y `mysqli`, habilita `mod_rewrite` y copia Composer 2. Xdebug se conecta al host mediante `host.docker.internal:9003`.

Credenciales y nombre de la base de datos están en [.env](.env). El puerto de phpMyAdmin es `PMA_PORT` (por defecto `8000`).

## Requisitos

- [Docker y docker-compose](https://www.docker.com/products/docker-desktop/)
- [Visual Studio Code](https://code.visualstudio.com/)
- Extensión **PHP Debug** (`xdebug.php-debug`)

Abre la carpeta `workspace` como raíz del proyecto en VS Code para que coincidan las rutas de depuración.

## Cómo lanzarlo

Desde `workspace`:

```bash
docker compose up -d --build
```

La primera vez construye la imagen. Arranques posteriores pueden omitir `--build` si no has cambiado [docker/Dockerfile](docker/Dockerfile) ni la configuración de PHP/Apache.

Comprueba que los tres contenedores están en marcha:

```bash
docker compose ps
```

- Aplicación: http://localhost (desde [src/index.php](src/index.php))
- phpMyAdmin: http://localhost:8000 (servidor `db`)

Parar los servicios (el volumen de MariaDB se conserva):

```bash
docker compose down
Ctrl+C #si se ejecuta en primer plano.
```

Ver logs de Apache/PHP:

```bash
docker compose logs -f web
```

Entrar en el contenedor web:

```bash
docker compose exec web bash
```

## Depurar con Visual Studio Code

Xdebug ya está activo (`xdebug.start_with_request=yes`) y [`.vscode/launch.json`](.vscode/launch.json) escucha en el puerto **9003**, con el mapeo:

```text
/var/www/html  →  ${workspaceFolder}/src
```

Pasos:

1. Coloca un punto de interrupción en un fichero de `src/` (por ejemplo en `index.php`).
2. Abre **Ejecutar y depurar** (`Ctrl+Shift+D`) y elige **Listen for Xdebug**.
3. Pulsa **Iniciar depuración** (`F5`). El estado debe quedar en *escuchando*.
4. Recarga http://localhost (o la ruta del script). La ejecución se detendrá en el breakpoint.

Si no entra en el depurador:

- Confirma que el contenedor `php-apache` está en ejecución.
- La carpeta abierta en VS Code debe ser `workspace` (no el repositorio padre), para que `${workspaceFolder}/src` sea correcto.
- En Windows, `extra_hosts: host.docker.internal:host-gateway` en [docker-compose.yml](docker-compose.yml) permite que Xdebug alcance el IDE.

Para comprobar Xdebug, abre http://localhost y busca la sección **xdebug** en `phpinfo()`.

## Instalar dependencias con Composer

Composer está instalado **dentro del contenedor** `web`. No hace falta Composer en el host.

El `WORKDIR` de la imagen es `/var/www/html`, que es el volumen `src/`. Los comandos se ejecutan contra el código del proyecto.

Crear `composer.json` (si aún no existe) e instalar un paquete:

```bash
docker compose exec web composer init
docker compose exec web composer require monolog/monolog
```

Instalar lo declarado en `composer.json` / `composer.lock` (por ejemplo tras clonar el repo):

```bash
docker compose exec web composer install
```

Actualizar dependencias:

```bash
docker compose exec web composer update
```

`vendor/` se genera en `src/vendor`. Está en [`.gitignore`](.gitignore): cada entorno debe ejecutar `composer install`. En PHP, carga el autoload con:

```php
require __DIR__ . '/vendor/autoload.php';
```

Si Composer no encuentra el proyecto, indica el directorio de trabajo de forma explícita:

```bash
docker compose exec web composer install --working-dir=/var/www/html
```

## Configurar Docker para que no utilice un rango de red

Docker utiliza por defecto determinados rangos de direcciones privadas para crear las redes de los contenedores. Si alguno de esos rangos entra en conflicto con la red `172.20.0.0/16`, se puede configurar el **default address pool** de Docker para que utilice otros rangos.

En Debian, esta configuración se realiza mediante el archivo:

```text
/etc/docker/daemon.json
```

### 1. Configurar el `default-address-pool`

#### 1.1. Crear o editar `/etc/docker/daemon.json`

Abrir el archivo con el editor que se prefiera:

```bash
sudo nano /etc/docker/daemon.json
```

Añadir la configuración `default-address-pools`. Por ejemplo:

```json
{
  "default-address-pools": [
    {
      "base": "172.21.0.0/16",
      "size": 24
    }
  ]
}
```

En este ejemplo:

* `base`: define el rango del que Docker obtendrá las subredes.
* `size`: define el tamaño de cada subred que Docker creará. Un valor de `24` significa que cada red será `/24`.
* Al utilizar `172.21.0.0/16` como rango base, Docker dejará de utilizar `172.20.0.0/16` para las nuevas redes creadas mediante el pool configurado.

> **Importante:** el `default-address-pools` afecta a las redes que Docker cree posteriormente. Las redes que ya existen no se modifican automáticamente.

### 1.2. Reiniciar Docker

Después de modificar `daemon.json`, reiniciar el servicio:

```bash
sudo systemctl restart docker
```

Comprobar que Docker se ha iniciado correctamente:

```bash
sudo systemctl status docker
```

### 1.3. Comprobar las redes existentes

Listar las redes de Docker:

```bash
docker network ls
```

Para consultar la configuración de una red concreta:

```bash
docker network inspect NOMBRE_DE_LA_RED
```

Por ejemplo:

```bash
docker network inspect bridge
```

En la salida se puede localizar la sección `IPAM` y comprobar el `Subnet` utilizado.

---

## 2. Eliminar una red de Docker que ya existe

Si la red que queremos evitar ya ha sido creada, cambiar `daemon.json` **no la elimina ni cambia su subnet**. Es necesario eliminarla y volver a crearla.

### 2.1. Identificar la red

Primero, listar las redes:

```bash
docker network ls
```

Por ejemplo:

```text
NETWORK ID     NAME      DRIVER    SCOPE
a1b2c3d4e5f6   bridge    bridge    local
b2c3d4e5f6a7   mi_red    bridge    local
```

Para conocer el rango utilizado por `mi_red`:

```bash
docker network inspect mi_red
```

También se puede obtener únicamente la subnet con:

```bash
docker network inspect mi_red \
  --format '{{range .IPAM.Config}}{{.Subnet}}{{end}}'
```

Si devuelve:

```text
172.20.0.0/16
```

esa red está utilizando el rango que queremos evitar.

### 2.2. Comprobar si hay contenedores conectados

Antes de eliminar la red, comprobar qué contenedores están conectados a ella:

```bash
docker network inspect mi_red \
  --format '{{range .Containers}}{{.Name}}{{"\n"}}{{end}}'
```

Si aparecen contenedores, será necesario detenerlos y/o desconectarlos de la red antes de eliminarla.

Por ejemplo:

```bash
docker stop contenedor1
```

Si únicamente queremos desconectar un contenedor sin eliminarlo:

```bash
docker network disconnect mi_red contenedor1
```

Repetir el proceso para los contenedores que sigan conectados.

### 2.3. Eliminar la red

Una vez que no tenga contenedores conectados:

```bash
docker network rm mi_red
```

También se puede utilizar:

```bash
docker network remove mi_red
```

Comprobar que ya no existe:

```bash
docker network ls
```

### 2.4. Volver a crear la red

Si se necesita una red con el mismo nombre, después de eliminarla se puede crear de nuevo:

```bash
docker network create mi_red
```

Como el `default-address-pools` ya está configurado, Docker seleccionará una subred disponible del pool configurado, por ejemplo:

```text
172.21.0.0/24
```

Se puede comprobar con:

```bash
docker network inspect mi_red \
  --format '{{range .IPAM.Config}}{{.Subnet}}{{end}}'
```

El resultado debería ser un rango perteneciente al nuevo pool y no `172.20.0.0/16`.

### 2.5. Si la red pertenece a Docker Compose

Si la red fue creada mediante Docker Compose, normalmente es preferible detener el proyecto antes de eliminarla:

```bash
docker compose down
```

Después de haber configurado `/etc/docker/daemon.json` y reiniciado Docker, volver a levantar el proyecto:

```bash
docker compose up -d
```

Docker Compose volverá a crear las redes necesarias y, para las redes que no tengan una subnet definida explícitamente, Docker utilizará el `default-address-pool` configurado.

> **Advertencia:** si el archivo `compose.yaml` o `docker-compose.yml` define explícitamente una `subnet`, por ejemplo `172.20.0.0/16`, el `default-address-pool` de Docker no la sustituirá. En ese caso hay que modificar también la configuración de Compose.