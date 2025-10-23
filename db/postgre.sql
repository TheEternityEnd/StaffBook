/*
==========================================================================
 PASO 1: DEFINICIÓN DE TIPOS (ENUMs)
 Primero creamos todos los tipos de datos personalizados (ENUMs).
==========================================================================
*/

CREATE TYPE rol_usuario AS ENUM (
    'Admin', 
    'Usuario'
);

CREATE TYPE estado_empleado AS ENUM (
    'Activo', 
    'En Licencia', 
    'Pendiente', 
    'Baja'
);

CREATE TYPE sexo_enum AS ENUM (
    'Hombre', 
    'Mujer', 
    'Otro'
);

CREATE TYPE estado_civil_enum AS ENUM (
    'Casado', 
    'Soltero', 
    'Viudo', 
    'Divorciado'
);

CREATE TYPE tipo_sangre_enum AS ENUM (
    'A+', 'A-', 
    'B+', 'B-', 
    'AB+', 'AB-', 
    'O+', 'O-'
);

CREATE TYPE estado_permiso AS ENUM (
    'Pendiente', 
    'Aprobado', 
    'Rechazado'
);

/*
==========================================================================
 PASO 2: CREACIÓN DE TABLAS DE CATÁLOGO Y USUARIOS
 Tablas que almacenan opciones de menús desplegables y usuarios.
 No tienen dependencias complicadas.
==========================================================================
*/

CREATE TABLE areas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE catalogo_tipos_empleado (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE catalogo_funciones_empleado (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE catalogo_escolaridad (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE catalogo_tipos_permiso (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    limite_anual_dias INTEGER DEFAULT 0
);

CREATE TABLE catalogo_puestos_jefes (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    nombre VARCHAR(150),
    apellido VARCHAR(150),
    rol rol_usuario NOT NULL DEFAULT 'Usuario',
    verificado BOOLEAN DEFAULT false,
    ultima_sesion TIMESTAMP,
    fecha_creacion TIMESTAMP DEFAULT NOW()
);

/*
==========================================================================
 PASO 3: CREACIÓN DE TABLAS PRINCIPALES
 Creamos las tablas centrales del sistema.
 Nota: Las llaves foráneas entre 'empleados' y 'departamentos'
 se añaden en el Paso 4 para evitar un bloqueo circular.
==========================================================================
*/

CREATE TABLE departamentos (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) UNIQUE NOT NULL,
    area_id INTEGER NOT NULL REFERENCES areas(id),
    jefe_empleado_id INTEGER NULL, -- Se añade FK en Paso 4
    ruta_imagen VARCHAR(500) NULL
);

CREATE TABLE empleados (
    id SERIAL PRIMARY KEY,
    clave VARCHAR(50) UNIQUE NOT NULL,
    nombre_completo VARCHAR(255) NOT NULL,
    departamento_id INTEGER NULL, -- Se añade FK en Paso 4
    puesto VARCHAR(255) NOT NULL,
    tipo_empleado_id INTEGER REFERENCES catalogo_tipos_empleado(id),
    funcion_empleado_id INTEGER REFERENCES catalogo_funciones_empleado(id),
    tipo_docente VARCHAR(100) NULL,
    sexo sexo_enum,
    fecha_nacimiento DATE NOT NULL,
    estado_civil estado_civil_enum,
    curp VARCHAR(18) UNIQUE NOT NULL,
    rfc VARCHAR(13) UNIQUE NOT NULL,
    tipo_sangre tipo_sangre_enum,
    escolaridad_id INTEGER REFERENCES catalogo_escolaridad(id),
    fecha_ingreso DATE NOT NULL,
    fecha_baja DATE NULL,
    afiliacion VARCHAR(100),
    telefono VARCHAR(30),
    domicilio TEXT,
    email_personal VARCHAR(255) UNIQUE,
    email_tecnm VARCHAR(255) UNIQUE,
    ruta_imagen VARCHAR(500) NULL,
    estado_actual estado_empleado DEFAULT 'Activo'
);

CREATE TABLE permisos (
    id SERIAL PRIMARY KEY,
    empleado_id INTEGER NOT NULL REFERENCES empleados(id),
    tipo_permiso_id INTEGER NOT NULL REFERENCES catalogo_tipos_permiso(id),
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    motivo TEXT,
    jefe_autoriza_id INTEGER NOT NULL REFERENCES empleados(id),
    estado estado_permiso NOT NULL DEFAULT 'Pendiente',
    ruta_adjunto VARCHAR(500) NULL,
    fecha_solicitud TIMESTAMP DEFAULT NOW()
);

CREATE TABLE historial_actividad (
    id SERIAL PRIMARY KEY,
    fecha_hora TIMESTAMP DEFAULT NOW(),
    usuario_id INTEGER NULL REFERENCES usuarios(id),
    username_log VARCHAR(100),
    accion VARCHAR(255) NOT NULL,
    detalle TEXT,
    ip_address VARCHAR(50)
);

/*
==========================================================================
 PASO 4: ADICIÓN DE LLAVES FORÁNEAS CIRCULARES
 Ahora que 'empleados' y 'departamentos' existen,
 podemos crear las llaves foráneas que las conectan.
==========================================================================
*/

ALTER TABLE departamentos
ADD CONSTRAINT fk_departamentos_jefe
FOREIGN KEY (jefe_empleado_id) 
REFERENCES empleados(id);

ALTER TABLE empleados
ADD CONSTRAINT fk_empleados_departamento
FOREIGN KEY (departamento_id) 
REFERENCES departamentos(id);

/*
==========================================================================
 SCRIPT FINALIZADO
==========================================================================
*/