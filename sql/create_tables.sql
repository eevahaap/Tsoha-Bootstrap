CREATE TABLE opettaja
(
id serial primary key,
nimi varchar(50),
tunnus varchar(20),
salasana varchar(20)
);

CREATE TABLE oppilas
(
id serial primary key,
etunimi varchar(50),
sukunimi varchar(50),
luokka varchar(5)
);

CREATE TABLE oppiaine
(
id serial primary key,
nimi varchar(255),
opettaja_id integer references opettaja(id) on delete cascade on update cascade
);

CREATE TABLE arvosana
(
id serial primary key,
arvosana varchar(2),
oppilas_id integer references oppilas(id) on delete cascade on update cascade,
oppiaine_id integer references oppiaine(id) on delete cascade on update cascade
);

