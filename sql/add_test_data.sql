insert into opettaja (nimi, tunnus, salasana)
values('Eeva', 'Opettaja', 'salasana');-- Lisää INSERT INTO lauseet tähän tiedostoon

insert into oppilas (etunimi, sukunimi, luokka, opiskelijanro)
values('Pasi', 'Testi', '7B', '1234567');

insert into oppiaine (nimi, opettaja_id)
values('Matematiikka', 3);

insert into arvosana (arvosana, oppilas_id, oppiaine_id)
values('10', 5, 1);
