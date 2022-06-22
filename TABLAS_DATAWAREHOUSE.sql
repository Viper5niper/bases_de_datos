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