-- =====================================================
-- TP N°2: Pokédex - Programación web avanzada
-- Script de creación de la base de datos completa
-- =====================================================
-- Para correr:
--   1) Abrir phpMyAdmin
--   2) Pestaña SQL (sin elegir base) o Importar este archivo
--   3) Listo: crea la base, las tablas y los datos de prueba
-- =====================================================

DROP DATABASE IF EXISTS pokedex;
CREATE DATABASE pokedex CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pokedex;

-- ---------- Tabla de tipos ----------
-- La consigna pide al menos 4 valores posibles de tipo.
CREATE TABLE tipo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    imagen VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- ---------- Tabla principal de pokémon ----------
-- id          : autoincremental, no editable (consigna)
-- numero      : único, lo carga el admin a mano (consigna)
-- imagen      : ruta a archivo subido al servidor (consigna)
-- tipo_id     : FK a tipo (para mostrar el ícono, no texto)
CREATE TABLE pokemon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255) NOT NULL,
    tipo_id INT NOT NULL,
    FOREIGN KEY (tipo_id) REFERENCES tipo(id)
) ENGINE=InnoDB;

-- ---------- Tabla de administradores ----------
-- password se guarda con password_hash() de PHP, NUNCA en texto plano.
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- =====================================================
-- DATOS DE PRUEBA
-- =====================================================

-- 4 tipos (mínimo que pide la consigna)
INSERT INTO tipo (nombre, imagen) VALUES
    ('Fuego',     'img/tipos/fuego.png'),
    ('Agua',      'img/tipos/agua.png'),
    ('Planta',    'img/tipos/planta.png'),
    ('Eléctrico', 'img/tipos/electrico.png');

-- Algunos pokémon de muestra
INSERT INTO pokemon (numero, nombre, descripcion, imagen, tipo_id) VALUES
    (1,  'Bulbasaur',  'Bulbasaur es un Pokémon que nace con una semilla en el lomo, la cual va creciendo a medida que evoluciona.', 'img/pokemones/001.png', 3),
    (4,  'Charmander', 'Charmander prefiere los sitios calientes. La llama de su cola indica su estado de ánimo y salud.',           'img/pokemones/004.png', 1),
    (6,  'Charizard',  'Charizard escupe llamas tan calientes que pueden derretir las rocas. Vuela buscando rivales fuertes.',     'img/pokemones/006.png', 1),
    (7,  'Squirtle',   'Squirtle se esconde en su caparazón ante el peligro y dispara agua a presión por su boca.',               'img/pokemones/007.png', 2),
    (25, 'Pikachu',    'Pikachu almacena electricidad en sus mejillas. Suelta descargas cuando se enoja o se sorprende.',         'img/pokemones/025.png', 4);

-- Usuario admin de prueba
-- usuario: admin
-- password: admin123  (hash bcrypt generado con password_hash)
-- Si querés cambiar el password, corré generar_hash.php y reemplazá este valor.
INSERT INTO usuario (usuario, password) VALUES
    ('admin', '$2y$10$vQF/k5e1WXFSzz1vUMmAMuMpatE/6flMo3HyvSTjJhKbOHIElrjQu');