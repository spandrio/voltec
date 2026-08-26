-- Migración 1: crea la tabla de la primera entidad
-- Una categoría agrupa productos relacionados
-- aajajaja al fin chicooos, llegue al 10 profe hola oajala me leas
CREATE TABLE categorias (   
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;