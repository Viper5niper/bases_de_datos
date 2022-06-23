-- BASE
CREATE SCHEMA IF NOT EXISTS "Historico_Vuelos"
    AUTHORIZATION postgres;

COMMENT ON SCHEMA "Historico_Vuelos"
    IS 'Tabla Historica de Vuelos';


--- TABLA

CREATE TABLE IF NOT EXISTS "Historico_Vuelos".registro_vuelos
(
    -- vuelo
    -- avion
    -- aerolinea
    -- ubicacion
    -- pasajero
    id_registro bigint NOT NULL DEFAULT nextval('"Historico_Vuelos".registro_vuelos_id_registro_seq'::regclass),
    nombre_aerolinea character varying(100) COLLATE pg_catalog."default",
    pais_destino character varying(100) COLLATE pg_catalog."default",
    ciudad_destino character varying(100) COLLATE pg_catalog."default",
    pais_origen character varying(100) COLLATE pg_catalog."default",
    ciudad_origen character varying(100) COLLATE pg_catalog."default",
    despegue_vuelo datetime,
    aterrizaje_vuelo datetime,
    nombre_pasajero character varying(150) COLLATE pg_catalog."default",
    apellido_pasajero character varying(150) COLLATE pg_catalog."default",
    genero_pasajero character varying(10) COLLATE pg_catalog."default",
    llegada_pasajero timestamp without time zone[],
    fabricante_avion character varying(100) COLLATE pg_catalog."default",
    modelo_avion character varying(100) COLLATE pg_catalog."default",
    capacidad_avion character varying(4) COLLATE pg_catalog."default",
    CONSTRAINT registro_vuelos_pkey PRIMARY KEY (id_registro)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS "Historico_Vuelos".registro_vuelos
    OWNER to postgres;

COMMENT ON TABLE "Historico_Vuelos".registro_vuelos
    IS 'Tabla de registro de vuelos';

CREATE TABLE IF NOT EXISTS registro_vuelos
(
    -- vuelo
    -- avion
    -- aerolinea
    -- ubicacion
    -- pasajero
    id_registro INT NOT NULL,
    nombre_aerolinea VARCHAR(100) NOT NULL,
    pais_destino VARCHAR(100) NOT NULL,
    ciudad_destino VARCHAR(100) NOT NULL,
    pais_origen VARCHAR(100) NOT NULL,
    ciudad_origen VARCHAR(100) NOT NULL,
    despegue_vuelo timestamp,
    aterrizaje_vuelo timestamp,
    nombre_pasajero VARCHAR(100) NOT NULL,
    apellido_pasajero VARCHAR(100) NOT NULL,
    genero_pasajero VARCHAR(100)NOT NULL,
    llegada_pasajero timestamp without time zone[],
    fabricante_avion VARCHAR(100) NOT NULL,
    modelo_avion VARCHAR(100) NOT NULL,
    capacidad_avion VARCHAR(100) NOT NULL,
    CONSTRAINT registro_vuelos_pkey PRIMARY KEY (id_registro)
)

-- extract select

SELECT vu.*, ae.nombre AS nombre_aerolinea, ori.pais AS pais_origen, ori.ciudad AS ciudad_origen, 
des.pais AS pais_destino, des.ciudad AS ciudad_destino, 
av.fabricante AS fabricante_avion, av.modelo AS modelo_avion, av.capacidad AS capacidad_avion, 
pa.nombre AS nombre_pasajero, pa.apellido AS apellido_pasajero, pa.genero AS genero_pasajero,
bo.llegada AS llegada_pasajero
FROM vuelos vu 
INNER JOIN ubicaciones ori ON ori.id = vu.origen_id
INNER JOIN ubicaciones des ON des.id = vu.destino_id
INNER JOIN aviones av ON av.id = vu.avion_id
INNER JOIN boleto bo ON bo.vuelo_id = vu.id
INNER JOIN pasajeros pa ON pa.id = bo.pasajero_id
INNER JOIN aerolineas ae ON ae.id = av.aerolinea_id


CREATE TABLE `registro_vuelos` (
  `id_registro` int(11) NOT NULL,
  `vuelo_id` int(11) NOT NULL,
  `nombre_aerolinea` varchar(100) NOT NULL,
  `pais_destino` varchar(100) NOT NULL,
  `ciudad_destino` varchar(100) NOT NULL,
  `pais_origen` varchar(100) NOT NULL,
  `ciudad_origen` varchar(100) NOT NULL,
  `despegue_vuelo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `aterrizaje_vuelo` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombre_pasajero` varchar(100) NOT NULL,
  `apellido_pasajero` varchar(100) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `llegada` timestamp NOT NULL DEFAULT current_timestamp(),
  `fabricante_avion` varchar(100) NOT NULL,
  `modelo_avion` varchar(100) NOT NULL,
  `capacidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;