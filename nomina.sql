create database nomina;
drop database nomina;
use nomina;
CREATE TABLE empleados (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    cedula VARCHAR(50),
    telefono VARCHAR(20),
    correo VARCHAR(150),
    puesto VARCHAR(100),
    salario_base DECIMAL(10,2),
    fecha_ingreso DATE,
    activo TINYINT DEFAULT 1,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE empleados_cuentas (
    id_cuenta INT AUTO_INCREMENT PRIMARY KEY,
    id_empleado INT NOT NULL,
    numero_cuenta VARCHAR(50) NOT NULL,
    tipo_cuenta VARCHAR(50),    
    moneda VARCHAR(10),
    estado TINYINT DEFAULT 1,     
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    cedula_juridica VARCHAR(50),
    telefono VARCHAR(20),
    correo VARCHAR(150),
    direccion VARCHAR(255),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE empresa_cuentas (
    id_cuenta INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    numero_cuenta VARCHAR(50) NOT NULL,
    tipo_cuenta VARCHAR(50),           
    moneda VARCHAR(10) ,
    estado TINYINT DEFAULT 1,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE planilla (
    id_planilla INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    periodo VARCHAR(50), 
    fecha_inicio DATE,
    fecha_fin DATE,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE planilla_detalle (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_planilla INT NOT NULL,
    id_empleado INT NOT NULL,
    horas_trabajadas DECIMAL(10,2),
    salario_bruto DECIMAL(10,2),
    deducciones DECIMAL(10,2),
    salario_neto DECIMAL(10,2),
    observaciones VARCHAR(255)
);
CREATE TABLE pago_planilla (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_planilla_detalle INT NOT NULL,      
    id_empleado_cuenta INT NOT NULL,      
    id_empresa_cuenta INT NOT NULL,  
    monto_pagado DECIMAL(10,2) NOT NULL, 
    fecha_pago DATETIME DEFAULT CURRENT_TIMESTAMP,
    metodo_pago VARCHAR(50),             
    referencia VARCHAR(100),           
    observaciones VARCHAR(255)
);
DROP  TABLE usuarios ;
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(150) UNIQUE,    
    password VARCHAR(255) NOT NULL, 
    rol ENUM('admin', 'empleado') DEFAULT 'empleado',    
    estado TINYINT DEFAULT 1,
    ultimo_login DATETIME,    
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO usuarios (nombre, usuario, password, rol)
VALUES (
    'Admin',
    'admin',
    '123456',
    'admin'
);
SELECT * FROM usuarios;

UPDATE usuarios 
SET password = '$2y$10$FFKk9X/ez0VSZWEIJxXCT./AmVgnetgL137.sczzXPP6UlOX2Z5ty'
WHERE usuario = 'admin';
SELECT * FROM empleados;
ALTER TABLE empleados_cuentas ADD FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado);
ALTER TABLE empresa_cuentas ADD FOREIGN KEY (id_empresa) REFERENCES empresa(id_empresa);
ALTER TABLE planilla ADD FOREIGN KEY (id_empresa) REFERENCES empresa(id_empresa);
ALTER TABLE planilla_detalle ADD FOREIGN KEY (id_planilla) REFERENCES planilla(id_planilla);
ALTER TABLE planilla_detalle ADD FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado);
ALTER TABLE pago_planilla ADD FOREIGN KEY (id_planilla_detalle) REFERENCES planilla_detalle(id_detalle);
ALTER TABLE pago_planilla ADD FOREIGN KEY (id_empleado_cuenta) REFERENCES empleados_cuentas(id_cuenta);
ALTER TABLE pago_planilla ADD FOREIGN KEY (id_empresa_cuenta) REFERENCES empresa_cuentas(id_cuenta);

