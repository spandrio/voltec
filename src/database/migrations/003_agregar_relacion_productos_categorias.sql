-- Migración 3: agrega la relación entre productos y categorias
-- Una categoría puede tener muchos productos

ALTER TABLE productos
    ADD COLUMN categoria_id INT UNSIGNED NULL AFTER id;
 
ALTER TABLE productos
    ADD CONSTRAINT fk_productos_categoria
    FOREIGN KEY (categoria_id) REFERENCES categorias (id)
    ON DELETE SET NULL
    ON UPDATE CASCADE;
 
CREATE INDEX idx_productos_categoria_id ON productos (categoria_id);