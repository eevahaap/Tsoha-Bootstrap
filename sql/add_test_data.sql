insert into opettaja (nimi, tunnus, salasana)
values('Eeva', 'Opettaja', 'salasana');-- Lisää INSERT INTO lauseet tähän tiedostoon

insert into oppilas (etunimi, sukunimi, luokka)
values('Pasi', 'Testi', '7B');

insert into oppiaine (nimi, opettaja_id)
values('Matematiikka', 1);

insert into arvosana (arvosana, oppilas_id, oppiaine_id)
values(8, 1, 1);
