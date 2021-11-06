# OMEGA

## Simulación Sesión interactiva de Cesar Gandia

Para simular la actividad del usuario cgandia en la máquina se opta por una tarea programada.

Pero, para que el usuario cgandia pueda ejecutar una tarea programada en la máquina y dejar sus credenciales cacheadas en los vaults, se necesita que se le asigne este privilegio: "iniciar sesión como trabajo por lotes". Esto se hace desde "Panel de Control > Cuentas de usuario > Conceder acceso al equipo a otros usuarios", se selecciona el usuario y después en "propiedades", se marca el checkbox "Otro" y se selecciona "Usuarios del registro del rendimiento".

Una vez hecho esto, se crea una tarea programada que la ejecute el usuario cgandia, con el comando `powershell.exe -c "Start-Sleep -s 15"` y que se ejecute al inciar el sistema y se repita cadad 5 minutos indefinidamente.
