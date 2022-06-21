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

SELECT vu.*, ae.nombre as nombre_aerolinea, ori.pais as pais_origen, ori.ciudad as ciudad_origen, 
des.pais as pais_destino, des.ciudad as ciudad_destino, 
av.fabricante as fabricante_avion, av.modelo as modelo_avion, av.capacidad as capacidad_avion, 
pa.nombre as nombre_pasajero, pa.apellido as apellido_pasajero, pa.genero as genero_pasajero,
bo.llegada as llegada_pasajero,
FROM vuelos vu 
INNER JOIN ubicaciones ori ON ori.ubicacion_id = vu.origen_id
INNER JOIN ubicaciones des ON des.ubicacion_id = vu.destino_id
INNER JOIN aviones av ON av.avion_id = vu.avion_id
INNER JOIN boleto bo ON bo.vuelo_id = vu.vuelo_id
INNER JOIN pasajeros pa ON bo.pasajero_id = pa.pasajero_id
INNER JOIN aerolineas ae ON ae.aerolinea_id = av.aerolinea_id