#  Sistema de Gestión de Mascotas para Veterinaria

Mi examen sobre un sistema de gestión de mascotas para un veterinaria. Es una app web simple donde se registrar mascotas, dueños, visitas médicas, buscar info y exportar datos a CSV. Principalmente use PHP, y un poquito de CSS para  que no se vea feo y JS para unas interacciones.

NOTA IMPORTANTE⚠️: Todo se guarda en sesiones PHP (no usé base de datos real, solo memoria temporal, así que si cierras el servidor se borra todo). ¿Por qué hice esto? Usando sesiones me parecía más portable a la hora de revisarlo  y menos invasivo xd 

## 📋 ¿Qué hace el sistema?

- **Login simple**: Para entrar, usas cualquier usuario y contraseña (no hay validación real, es solo para simular).
- **Registrar mascotas**: Pon nombre y especie (como "perro" o "gato" o lo que sea). Valida que no metas números o símbolos.
- **Registrar dueños**: Agrega nombre, teléfono y linkea a una mascota existente. Solo números en el tel.
- **Registrar visitas médicas**: Fecha, diagnóstico y tratamiento para una mascota. La fecha tiene que ser válida.
- **Buscar mascotas**: Por nombre, te muestra dueños y historial de visitas. Si no existe, te dice "no encontrado".
- **Listado de mascotas**: Una tabla que muestra todas las mascotas con dueños y última visita.
- **Exportar a CSV**: Descarga un archivo con la info de las mascotas.
- **Logout**: Sale y lo devuelve al login.
- **Paneles desplegables**: Con JS, los headers se abren y cierran al clickear, para que no sea un muro de texto.
- **Validaciones**: No dejes campos vacíos, y chequea formatos para no meter basura.


## 🚀 Cómo instalar y correr esto

1. **Requisitos**: 
   - Un servidor web como XAMPP, WAMP o el built-in de PHP.
   - O por consiguiente entrar a este link para probarlo sin necesidad de instalar nada: http://sistemamascotas.zeabur.app/
   - No necesita base de datos, todo en sesiones.

2. **Pasos**:
   - Clona o descarga este repo:
 `git clone [https://github.com/maulopezdavila/SistemaGestionMascotas]`.
   - Mete los archivos en una carpeta en tu servidor (ej: htdocs en XAMPP).
   - Enciende el servidor y Apache.
   - Abre en el browser: `http://localhost/tu-carpeta/index.php` (pero primero vas al login).
   - ¡Listo! Regístrate con cualquier user/pass.
   - O de nuevo, entra a este link: http://sistemamascotas.zeabur.app/

NOTA: Vuelvo a recalcar que para este caso especifico decidí usar sesiones porque considere que era más fácil de revisar. Para algo real, usaría una DB como MySQL.

## 🛠️ Cómo usarlo

- **Login**: Ve a `login.php`, mete lo que sea y entra. NOTA: En un caso real si hubiera hecho un login más complejo donde se guardaran usuarios, contraseñas se hashean y demás.
- **Dashboard (index.php)**: Ahí ves el menú con formas para registrar y la tabla de mascotas.
- **Buscar**: Escribe el nombre y dale enter.
- **Exportar**: Botón abajo de la tabla, descarga el CSV.
- **Logout**: Arriba a la derecha.

Ejemplo: Registra una mascota "Firulais" (perro), agrega dueño "Juan" (tel 123456), y una visita con fecha hoy, diag "resfriado", tratamiento "pastillas". Busca "Firulais" y ve el historial.

Si algo falla, checa los mensajes de error (con links para volver).

## 📂 Estructura de archivos

- `index.php`: El dashboard principal con formas y tabla.
- `estilos.css`: Todo el estilo.
- `script.js`: JS para paneles desplegables.
- `models/`: Clases PHP.
  - `Mascota.php`: Maneja mascotas, dueños y visitas.
  - `Dueno.php`: Info de dueños.
  - `VisitaMedica.php`: Detalles de visitas.
- `procesar_mascota.php`, `procesar_dueno.php`, `procesar_visita.php`: Procesan los forms.
- `buscar_mascota.php`: Página de resultados de búsqueda.
- `exportar_csv.php`: Genera el CSV.
- `login.php`, `procesar_login.php`, `logout.php`: Manejo de sesión.

Todo está comentado en el código, así que si abres los archivos, ves qué hace cada parte. Hay validaciones con regex para no meter datos locos.

## 👀Lo que agregaría si tuviera que hacerlo más complejo (ideas mías)

- Agregar una base de datos real (MySQL) para que no se pierda info.
- Validación de login con usuarios reales.
- Editar/borrar mascotas (ahora solo agregas).
- Fotos de mascotas o más campos.
- Más seguridad, como hashing de passwords (esto es básico).


## 📜 nose
Gracias por leer el README✌️ 
