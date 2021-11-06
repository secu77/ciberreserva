# ZETA

## Simulación Sesión interactiva de Cesar Gandia y Alicia Sierra

Para simular la actividad de los usuarios cesar gandia y alicia sierra en la máquina EPSILON se opta por una tarea programada.

Tareas programadas para simular actividad de los usuarios accediendo a Epsilon:

```powershell
C:\Program Files\PuTTY\putty.exe -ssh ciberreserva\cgandia@epsilon.ciberreserva.com -pw "PASSWORD" -m "C:\Program Files\PuTTY\example_commands.txt"
C:\Program Files\PuTTY\putty.exe -ssh ciberreserva\asierra@epsilon.ciberreserva.com -pw "PASSWORD" -m "C:\Program Files\PuTTY\example_commands.txt"
```

El contenido del example_commands.txt

```
whoami
sleep 15
hostname
```

De esta forma se generan dos TGTs en el directorio temporal de Epsilon.
