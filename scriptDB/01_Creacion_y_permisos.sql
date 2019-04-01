-- Creación de la base de datos si no existe. --
CREATE DATABASE IF NOT EXISTS DAW202_DBDepartamentos;

-- Creación de la tabla Departamento si no existe. --
CREATE TABLE IF NOT EXISTS Departamento(
    CodDepartamento varchar(3) PRIMARY KEY, 
    DescDepartamento varchar(255) NOT NULL,
    FechaBaja date,
    VolumenNegocio int(5) NOT NULL
)Engine=InnoDB;

-- Creación del usuario si no existe. --
CREATE USER IF NOT EXISTS 'usuarioDAW202_DBDepartamento'@'%' IDENTIFIED BY 'paso';

-- Damos los permisos al usuario creado. --
GRANT ALL PRIVILEGES ON *.* TO 'usuarioDAW202_DBDepartamentos'@'%';
