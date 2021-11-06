# EPSILON

## SUID Bin

Compilamos el source de la siguiente manera:
```bash
gcc admintool.c -o admintool
```
Le hacemos un strip al ejecutable creado:
```
strip admintool
```
Asignamos los siguientes permisos:
```bash
chmod 4755 admintool
```
Lo movemos al `/usr/bin/`:
```bash
mv admintool /usr/bin/admintool
```

## Timer Caps Deletion

Primero se crea el servicio:

```bash
systemctl enable delete_caps.service
systemctl start delete_caps.service
```

Luego se crea el timer:

```bash
systemctl enable delete_caps.timer
systemctl start delete_caps.timer
```

## References

- https://es.wikihow.com/cambiar-la-zona-horaria-en-Linux
- https://linuxize.com/post/how-to-set-dns-nameservers-on-ubuntu-18-04/
