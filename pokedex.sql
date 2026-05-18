
DROP DATABASE IF EXISTS pokedex;
CREATE DATABASE pokedex CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pokedex;

CREATE TABLE tipo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    imagen VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- ---------- Tabla principal de pokémon ----------
-- id          : autoincremental, no editable 
-- numero      : único, lo carga el admin a mano 
-- imagen      : ruta a archivo subido al servidor 
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
-- password se guarda con password_hash() de PHP
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- 4 tipos (mínimo que pide la consigna)
INSERT INTO tipo (nombre, imagen) VALUES
    ('Fuego',     'img/tipos/fuego.png'),
    ('Agua',      'img/tipos/agua.png'),
    ('Planta',    'img/tipos/planta.png'),
    ('Eléctrico', 'img/tipos/electrico.png');

-- Algunos pokémon de muestra (los 5 originales con imágenes locales + 25 con sprites de GitHub)
INSERT INTO pokemon (numero, nombre, descripcion, imagen, tipo_id) VALUES
    (1,   'Bulbasaur',   'Bulbasaur es un Pokémon que nace con una semilla en el lomo, la cual va creciendo a medida que evoluciona.', 'img/pokemones/001.png', 3),
    (4,   'Charmander',  'Charmander prefiere los sitios calientes. La llama de su cola indica su estado de ánimo y salud.',           'img/pokemones/004.png', 1),
    (6,   'Charizard',   'Charizard escupe llamas tan calientes que pueden derretir las rocas. Vuela buscando rivales fuertes.',       'img/pokemones/006.png', 1),
    (7,   'Squirtle',    'Squirtle se esconde en su caparazón ante el peligro y dispara agua a presión por su boca.',                  'img/pokemones/007.png', 2),
    (25,  'Pikachu',     'Pikachu almacena electricidad en sus mejillas. Suelta descargas cuando se enoja o se sorprende.',            'img/pokemones/025.png', 4),

    -- Planta
    (2,   'Ivysaur',     'El capullo de su lomo crece a medida que absorbe energía solar.',                     'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/2.png',   3),
    (3,   'Venusaur',    'La flor de su lomo libera un aroma relajante en primavera.',                          'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/3.png',   3),
    (43,  'Oddish',      'De día se entierra para evitar el sol. De noche sale a buscar comida.',               'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/43.png',  3),
    (45,  'Vileplume',   'Su flor venenosa esparce polen que provoca alergias y mareos.',                       'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/45.png',  3),
    (69,  'Bellsprout',  'Su cuerpo delgado le permite esquivar ataques y atrapar insectos con su boca.',       'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/69.png',  3),
    (71,  'Victreebel',  'Atrae a sus presas con un dulce aroma y las digiere con jugos ácidos.',               'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/71.png',  3),

    -- Fuego
    (37,  'Vulpix',      'Nace con una sola cola que se divide en seis a medida que crece.',                    'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/37.png',  1),
    (38,  'Ninetales',   'Se dice que vive mil años. Sus nueve colas albergan poderes místicos.',               'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/38.png',  1),
    (58,  'Growlithe',   'Es muy leal con su entrenador y ladra fuerte ante los desconocidos.',                 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/58.png',  1),
    (59,  'Arcanine',    'Es famoso por su belleza y velocidad. Puede correr 10.000 km en un día.',             'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/59.png',  1),
    (77,  'Ponyta',      'Su crin es de fuego puro. Recién nacido apenas puede caminar.',                       'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/77.png',  1),

    -- Agua
    (8,   'Wartortle',   'Su cola peluda es un símbolo de longevidad. Vive mucho tiempo.',                      'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/8.png',   2),
    (9,   'Blastoise',   'Los cañones de su caparazón disparan agua con una potencia tremenda.',                'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/9.png',   2),
    (54,  'Psyduck',     'Sufre dolores de cabeza constantes que liberan poderes psíquicos.',                   'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/54.png',  2),
    (72,  'Tentacool',   'Flota a la deriva en el mar. Sus tentáculos paralizan al contacto.',                  'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/72.png',  2),
    (129, 'Magikarp',    'Es famoso por ser débil. Solo sabe saltar fuera del agua.',                           'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/129.png', 2),
    (130, 'Gyarados',    'Es extremadamente violento cuando se enoja. Puede arrasar pueblos enteros.',          'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/130.png', 2),

    -- Eléctrico
    (26,  'Raichu',      'Si almacena demasiada electricidad, se descarga en el suelo con su cola.',            'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/26.png',  4),
    (81,  'Magnemite',   'Flota usando electromagnetismo. Se alimenta de electricidad.',                        'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/81.png',  4),
    (82,  'Magneton',    'Tres Magnemite unidos. Genera ondas magnéticas que afectan los aparatos.',            'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/82.png',  4),
    (100, 'Voltorb',     'Tiene forma de pokébola. Explota fácilmente si lo molestan.',                         'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/100.png', 4),
    (101, 'Electrode',   'Almacena tanta energía que puede estallar al menor toque.',                           'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/101.png', 4),
    (125, 'Electabuzz',  'Le encantan las tormentas. Cuando hay relámpagos corre hacia los pararrayos.',        'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/125.png', 4),
    (135, 'Jolteon',     'Su pelaje se carga de electricidad. Puede generar rayos de 10.000 voltios.',          'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/135.png', 4),
    (145, 'Zapdos',      'Pokémon legendario eléctrico. Vive entre las nubes y dispara rayos.',                 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/145.png', 4);

-- Usuario admin de prueba
-- usuario: admin
-- password: admin123  (hash bcrypt generado con password_hash)
INSERT INTO usuario (usuario, password) VALUES
    ('admin', '$2y$10$vQF/k5e1WXFSzz1vUMmAMuMpatE/6flMo3HyvSTjJhKbOHIElrjQu');