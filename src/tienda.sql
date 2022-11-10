DROP TABLE IF EXISTS articulos ;


CREATE TABLE articulos (
    id          bigserial    PRIMARY KEY,
    codigo      varchar(13)  NOT NULL UNIQUE,
    descripcion varchar(255) NOT NULL,
    precio      numeric(7,2) NOT NULL
);

-- Carga inicial de datos de prueba:

INSERT INTO articulos (codigo, descripcion, precio)
    VALUES  ('1234567893558', 'Yogur piña', 200.50),
            ('8468438924684', 'Tigretón', 50.10),
            ('3576413246572', 'Disco duro SSD 500 GB', 150.30);