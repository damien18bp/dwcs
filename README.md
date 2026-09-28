# Ejercicios de Desarrollo Web en Contorno Servidor
## DAW - IES Armando Cotarelo Valledor - Curso 26/27
# [Entorno de desarrollo](workspace)
> Estructura básica de proyectos y entorno de desarrollo con contenedores que utilizaremos durante el curso.
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

# [Unidad 1](UD1)
 > **Introducción a PHP** - **Interacción con BBDD** - **Depuración de código** - **TDD**
 ## Ejercicios
 - [Actividad 1](UD1/src/ejercicios/actividad1)
 ## Ejemplos
 - [Formularios](UD1/src/ejemplos/formulario.php)
 - [Arrays](UD1/src/ejemplos/arrays.php)