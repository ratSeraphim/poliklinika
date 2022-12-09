use poliklinika;

INSERT INTO adrese (valsts, regions, pilseta, iela, maja, pasta_indekss) VALUES 
('Latvija', 'Rīga', 'Rīga', 'Šampētera iela', '5', 'LV-1046'),
('Latvija', 'Rīga', 'Rīga', 'Dzeņu iela', '6', 'LV-1021'),
('Latvija', 'Rīga', 'Rīga', 'Dzirciema iela', '89', 'LV-1055' ),
('Latvija', 'Mārupes novads', 'Mazāvas', '', 'Jaunliepa', 'LV-2166'),
('Latvija', 'Jūrmala', 'Jūrmala', 'Cīruļu iela', '5', 'LV-2011'),
('Latvija', 'Jūrmala', 'Jūrmala', 'Telšu iela', '28', 'LV-2011'),
('Latvija', 'Olaines novads', 'Olaine', 'Misas iela', '5', 'LV-2114'),
('Latvija', 'Ķekavas novads', 'Ķekava', 'Atmodas iela', '21', 'LV-2123'),
('Latvija', 'Rīga', 'Rīga', 'Dārzciema iela', '60', 'LV-1073'),
('Latvija', 'Valmieras novads', 'Valmiera', 'Imantas iela', '3B', 'LV-4201'),
('Latvija', 'Rīga', 'Rīga', 'Bruņinieku iela', '59', 'LV-1011'),
('Latvija', 'Rīga', 'Rīga', 'Kalnciema iela', '116C-20', 'LV-1046');


INSERT INTO darbinieki (vards, uzvards, tips, personas_kods, talrunis, liguma_nr, id_adrese) VALUES
('Jānis', 'Pīrsis', 'Speciālists', '200600-42875', '27053567', '1235803664', 3),
('Ieva', 'Liepiņa', 'Vadītājs', '151078-57453', '20863567', '', 2),
('Aiva', 'Laiva', 'Speciālists', '050895-78953', '25670050', '2087932765', 1),
('Raivis', 'Ozols', 'Administrators', '111189-79560', '20993466', '1208634678', 4),
('Uldis', 'Jaunzemis', 'Apkopējs', '200202-69753', '230160345', '1040569083', 5),
('Olga', 'Petrovska', 'Māsa', '210697-46312', '20677545', '10897056079', 7),
('Igors', 'Kronis', 'Speciālists', '206442-50604', '20808080', '120546080', 8),
('Valters', 'Humberts', 'Speciālists', '206775-20604', '24540888', '1075502574', 6);

INSERT INTO lietotaji (lietotajvards, parole, epasts, id_darbinieks) VALUES
('raivisozols', 'Parole1', 'ozolsraivis@gmail.com', 4), -- administrators
('ievaliepina', '1234', 'liepinai@inbox.lv', 2), -- vaditaja
('janispirsis', 'PaPa1', 'pirsisjanis@gmail.lv', 1), -- neirologs, bernu neirologs
('aivalaiva', 'aivalaiva', 'aivalaiva@gmail.com', 3), --  gimenes arsts, pediatrs
('igorskronis', 'Kronis1', 'igorskronis@gmail.com', 7), -- gimenes arsts, kardiologs
('valtershumberts', 'Valters1', 'humbertsv@inbox.lv', 8); -- alergologs

INSERT INTO specialitate (nosaukums) VALUES
('Kardiologs'),
('Neirologs'),
('Ģimenes ārsts'),
('Alergologs'),
('Pediatrs'),
('Bērnu neirologs');

INSERT INTO darbinieka_specialitate (id_darbinieks, id_specialitate) VALUES
(1, 2),
(1, 6),
(3, 3),
(7, 3),
(3, 5),
(8, 4),
(7, 1);

INSERT INTO pakalpojums (nosaukums, apraksts, cena) VALUES
('Ģimenes ārsta konsultācija', 'Ģimenes ārsts uzrauga veselības stāvokli kopumā, informē par profilaktiski veicamajām darbībām, diagnosticē un ārstē akūtas un hroniskas slimības, dodas mājas vizītēs. Konsultē un izsniedz nosūtījumus, kad nepieciešama papildu diagnostika un ārstēšana speciālistu uzraudzībā.', '2.00'),
('Neirologa konsultācija', 'Konsultācija - ārstam iztaujājot un izmeklējot pacientu. Vispirms pacients tiek iztaujāts par slimības simptomiem, to raksturu, lokalizāciju, sākšanos, iespējamajiem cēloņiem, attīstību, iepriekšējo saslimšanu vēsturi.', 30.00),
('EEG izmeklējums', 'Elektroencefalogrāfijas ( EEG ) izmeklējums ir neinvazīvs galvas smadzeņu bioelektriskās aktivitātes pieraksts. To kā palīgmetodi izmanto epilepsijas diagnostikā, kā arī migrēnas tipa galvassāpju, neskaidru paroksizmālu stāvokļu un bezsamaņas lēkmju diferenciāldiagnostikā. Atsevišķos gadījumos EEG metodi izmanto psihiatrijā un neirodeģeneratīvo slimību diagnostikā.', 74.00),
('Ādas alerģiskie dūriena testi', 'Ādas alerģisko dūriena testu laikā uz apakšdelmu iekšējās virsmas uzpilina negatīvās, pozitīvās kontroles pilienus un pārbaudāmo alergēnu pilienus.', 28.00),
('Alergologa konsultācija', 'Alerģisko slimību diagnostika un ārstēšana pieaugušajiem un bērniem. Alergologs noteiks alerģijas cēloņus.', 4.00),
('Individuālas hipoalergēnas diētas sastādīšana', 'Hipoalergēnas diētas ir īpašas ēdienkartes, kas nesatur produktus ar paaugstinātām alerģiskām vai sensibilizējošām īpašībām.', 10.00),
('Kardiologa konsultācija', 'Kardioloģisko saslimšanu precīzas diagnostikas un veiksmīgas ārstēšanas pamatā ir pirmreizējā kardiologa konsultācija.', 50.00),
('Pediatra konsultācija', 'Konsultācija ietver sevī sarunu ar vecākiem, bērna apskati un analīžu izvērtēšanu. Tiek izvērtēta svara un auguma atbilstība vecumam. Var tikt nozīmētas papildus analīzes, speciālistu konsultācijas vai izmeklējumi.', 25.00);

INSERT INTO diagnoze (diagnozes_kods, nosaukums) VALUES
('M75.1', 'Rotatoru aproces sindroms'),
('M79.1', 'Mialģija'),
('J10.0', 'Gripa ar pneimoniju, identificēts sezonālās gripas vīruss'),
('J45.0', 'Pārsvarā alerģiska astma'),
('I10', 'Esenciāla (primāra) hipertensija'),
('I06.1', 'Reimatiska aortāla insuficience'),
('Z88.5', 'Alerģija pret narkozes līdzekļiem dzīves anamnēzē'),
('Q90.2', 'Trisomija 21, translokācija');

INSERT INTO kabinets (kabinets_id, stavs) VALUES
('A-201', 2),
('C-124', 2),
('A-214', 2),
('B-111', 1),
('B-108', 1);

INSERT INTO pacienti (vards, uzvards, personas_kods, dzim_datums, talrunis, epasts, nacionalitate, gimenes_arsts, id_adrese) VALUES
('Annija', 'Devona', '201202-20562', '2002-12-20', '21066755', 'annijadev@inbox.lv', 'Latviete', 7, 12),
('Kārlis', 'Mednis', '080898-25786', '1998-08-08', '28601111', 'medniskarlis@gmail.com', 'Latvietis', 3, 10),
('Olafs', 'Ingvers', '160580-25166', '1980-05-16', '21060000', 'olafsingvers@gmail.lv', 'Latvietis', 7, 11),
('Marija', 'Moroza', '', '1989-10-01', '21079999', 'mariyaost@gmail.com', 'Ukrainiete', 3, 9),
('Sofija', 'Moroza', '', '2015-06-27', '', '', 'Ukrainiete', 3, 9),
('Gundars', 'Ingvers', '210219-21676', '2019-02-21', '', '','Latvietis', 7, 11);

INSERT INTO pacienta_diagnoze VALUES
(1, 'M75.1', 'Aktīvs'),
(5, 'J10.0', 'Izārstēts'),
(2, 'Z88.5', 'Aktīvs'),
(3, 'M79.1', 'Izmeklēšanā'),
(4, 'I10', 'Aktīvs'),
(6, 'Q90.2', 'Aktīvs'),
(2, 'I06.1', 'Izmeklēšanā');

INSERT INTO vizite (id_pacients, id_arsts, laiks, id_pakalpojums, gim_arsta_nosutijums, valsts_apmaksats, apdrosinasana, id_kabinets) VALUES
(5, 3, '2022-11-02 12:10:00', 1, NULL, 0, 0, 'A-201'),
(1, 1, '2022-12-21 8:40:00', 2, 1, 0, 1, 'B-111'),
(2, 8, '2022-12-08 10:30:00', 6, 0, 0, 1, 'B-108'),
(6, 3, '2022-12-19 9:00:00',8, 1, 1, 0, 'C-124'),
(4, 7, '2023-01-12 14:20:00', 7, 1, 1, 0, 'A-214'),
(3, 8, '2023-01-06 13:00:00', 4, 0, 0, 1, 'A-201');

-- admin 
CREATE USER 'administrators'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT USAGE ON *.* TO 'administrators'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `poliklinika`.* TO 'administrators'@'localhost' WITH GRANT OPTION;

-- procedūra, kas ļaus tīmekļvietnei parādīt sesijas lietotājam viņa vārdu un uzvārdu (lai skaidri redzetu, kas dotajā brīdī ir ielogojies)
DELIMITER $$
CREATE PROCEDURE lietotajaVards ( IN lietotajs varchar(45) ) 
BEGIN
	SELECT CONCAT(vards,' ', uzvards) AS nosaukums
	FROM darbinieki 
	JOIN lietotaji 
	ON id_darbinieks = darbinieks_id
	WHERE lietotajvards = lietotajs;
END $$
DELIMITER ;

CALL lietotajaVards('ievaliepina');

-- aprēķina, cik pacientam jāmaksā par vizīti. ja ir ģimenes ārsta nosūtījums, tad maksā 4 EUR. 
-- Ja ir apdrošināšana, tad pacientam ir jāmaksā uz pusi mazāk. Ja vizīte ir valsts apmaksāta, pacientam nav jāmaksā.
DELIMITER $$
CREATE PROCEDURE izmaksas (IN vizite INT, OUT samaksa decimal(10,2))
BEGIN
	DECLARE valstsapm TINYINT;
    DECLARE gimnosutijums TINYINT;
    DECLARE apdrosinats TINYINT;
    DECLARE pakcena DECIMAL(10,2);
    
	SELECT cena, gim_arsta_nosutijums, apdrosinasana, valsts_apmaksats
    INTO pakcena, gimnosutijums, apdrosinats, valstsapm
    FROM vizite AS v
    INNER JOIN pakalpojums
    ON id_pakalpojums = pakalpojums_id
    WHERE vizite = vizite_id;
	
    IF valstsapm = 1 THEN
		SET samaksa = 0.00;
	ELSEIF gimnosutijums = 1 THEN
		SET samaksa = 4.00;
	ELSEIF apdrosinats = 1 THEN
		SET samaksa = (pakcena / 2);
	ELSE 
		SET samaksa = pakcena;
	END IF;
END $$
DELIMITER ;

-- jamaksa 2 eur, jo ģimenes ārsta apmeklējums
CALL izmaksas (1,@vizite1);
SELECT @vizite1; 
-- nav jāmaksā, jo ir valsts apmaksāts
CALL izmaksas (5,@vizite5);
SELECT @vizite5;
-- jāmaksā 5 eur, jo kardiologa apmeklējums ir 10 eur un pacientam ir apdrošināšana.
CALL izmaksas (3,@vizite3);
SELECT @vizite3;

-- skats, kas parāda ģimenes ārstu pēc vārda, uzvārda, nevis pēc id numura
CREATE VIEW gimenesarstsPacientiem AS
SELECT pacients_id, p.vards, p.uzvards, p.personas_kods, p.dzim_datums, p.talrunis, p.epasts, p.nacionalitate, CONCAT(d.vards, ' ',d.uzvards) AS gimenesarsts
FROM pacienti AS p
INNER JOIN darbinieki AS d
ON gimenes_arsts = darbinieks_id;

SELECT * from gimenesarstsPacientiem;

-- skats, kas glītāk izvadīs vizītes datus (reāli uzraksti, nevis cipari) 
CREATE VIEW vizites AS 
;