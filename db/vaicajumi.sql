-- admin 
CREATE USER 'administrators'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT USAGE ON *.* TO 'administrators'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `poliklinika`.* TO 'administrators'@'localhost' WITH GRANT OPTION;

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
('Olga', 'Petrovska', 'Māsa', '210697-46312', '20677545', '1089705609', 7),
('Igors', 'Kronis', 'Speciālists', '206442-50604', '20808080', '120546080', 8),
('Valters', 'Humberts', 'Speciālists', '206775-20604', '24540888', '1075502574', 6);

INSERT INTO lietotaji (lietotajvards, parole, epasts, id_darbinieks, adminpiekluve) VALUES
('raivisozols', 'Parole1', 'ozolsraivis@gmail.com', 4, 'yes'), -- administrators
('ievaliepina', '1234', 'liepinai@inbox.lv', 2, 'yes'), -- vaditaja
('janispirsis', 'PaPa1', 'pirsisjanis@gmail.lv', 1, 'no'), -- neirologs, bernu neirologs
('aivalaiva', 'aivalaiva', 'aivalaiva@gmail.com', 3, 'no'), --  gimenes arsts, pediatrs
('igorskronis', 'Kronis1', 'igorskronis@gmail.com', 7, 'no'), -- gimenes arsts, kardiologs
('valtershumberts', 'Valters1', 'humbertsv@inbox.lv', 8, 'no'); -- alergologs

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



INSERT INTO pacienta_diagnoze (id_pacients, id_diagnoze, statuss) VALUES
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

UPDATE `lietotaji` SET `parole` = '$2y$10$.NwG4vRuJR2u5WpDnfaUcOHJl3u9TLDfXqYj7utnYOrJsfeqvjVl2' WHERE `lietotaji`.`lietotajs_id` = 1 AND `lietotaji`.`id_darbinieks` = 4; 
UPDATE `lietotaji` SET `parole` = '$2y$10$0XeFucMPskKKJwsCS/7x7eb13oDZkkCd5m/53DYDhGHUI2z9Px3ei' WHERE `lietotaji`.`lietotajs_id` = 2 AND `lietotaji`.`id_darbinieks` = 2;
UPDATE `lietotaji` SET `parole` = '$2y$10$vKIV8FArUGAyhUzPJuUS6.dqpr2f4cEOx.vvMHbUE4w3/gFZAleQy' WHERE `lietotaji`.`lietotajs_id` = 3 AND `lietotaji`.`id_darbinieks` = 1; 
UPDATE `lietotaji` SET `parole` = '$2y$10$qV9m4Xthd0vDxXgMW17rC./Yfjd.9AgpCOCKdVhBzzOn8A/3eEtsy' WHERE `lietotaji`.`lietotajs_id` = 4 AND `lietotaji`.`id_darbinieks` = 3; 
UPDATE `lietotaji` SET `parole` = '$2y$10$o6qwzkekoPuOtYF5tOL0SOnfgnQN/vJWOIVWFJx42vlM0CrFc3njq' WHERE `lietotaji`.`lietotajs_id` = 5 AND `lietotaji`.`id_darbinieks` = 7; 
UPDATE `lietotaji` SET `parole` = '$2y$10$aRD43lA4QTpvNzVabK7jC.gXHCk5GD2srYbmTLMMxQx4JliO8AzPC' WHERE `lietotaji`.`lietotajs_id` = 6 AND `lietotaji`.`id_darbinieks` = 8;


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

-- ja lietotājam ir admin piekļuve, tad output ir 1. Ja lietotājam nav, tad output ir 0. Procedūra palīdzēs nodrošināt, ka nevar izdzēst lietotājus, kuriem ir admin piekļuve
DELIMITER $$
CREATE PROCEDURE vaiAdmins (IN darbID INT)
BEGIN
	DECLARE isadmin VARCHAR(3);
	DECLARE output TINYINT;
    
	SELECT adminpiekluve
    INTO isadmin
	FROM lietotaji 
    INNER JOIN darbinieki
    ON id_darbinieks = darbinieks_id
    WHERE darbinieks_id = darbID;
    
    IF isadmin = 'yes' THEN
		SET output = 1;
	ELSEIF isadmin = 'no' THEN
		SET output = 0;
	END IF;
    SELECT output;
END $$
DELIMITER ;

CALL vaiAdmins (4);
CALL vaiAdmins (1);

-- aprēķina, cik pacientam jāmaksā par vizīti. ja ir ģimenes ārsta nosūtījums, tad maksā 4 EUR. 
-- Ja ir apdrošināšana, tad pacientam ir jāmaksā uz pusi mazāk. Ja vizīte ir valsts apmaksāta, pacientam nav jāmaksā.
DELIMITER $$
CREATE PROCEDURE izmaksas (IN vizite INT)
BEGIN
	DECLARE valstsapm TINYINT;
    DECLARE gimnosutijums TINYINT;
    DECLARE apdrosinats TINYINT;
    DECLARE samaksa DECIMAL(10,2);
    
	SELECT cena, gim_arsta_nosutijums, apdrosinasana, valsts_apmaksats
    INTO samaksa, gimnosutijums, apdrosinats, valstsapm
    FROM vizite AS v
    INNER JOIN pakalpojums
    ON id_pakalpojums = pakalpojums_id
    WHERE vizite = vizite_id;
	
    IF valstsapm = 1 THEN
		SET samaksa = 0.00;
	ELSEIF gimnosutijums = 1 THEN
		SET samaksa = 4.00;
	ELSEIF apdrosinats = 1 THEN
		SET samaksa = (samaksa / 2);
	ELSE 
		SET samaksa = samaksa;
	END IF;
    
    SELECT samaksa;
END $$
DELIMITER ;



-- jāmaksā 2 eur, jo ģimenes ārsta apmeklējums
CALL izmaksas (1);

-- nav jāmaksā, jo ir valsts apmaksāts
CALL izmaksas (5);

-- jāmaksā 5 eur, jo kardiologa apmeklējums ir 10 eur un pacientam ir apdrošināšana.
CALL izmaksas (3);



-- skats, kas parāda ģimenes ārstu pēc vārda, uzvārda, nevis pēc id numura
CREATE VIEW gimenesarstsPacientiem AS
SELECT pacients_id, p.vards, p.uzvards, p.dzim_datums, CONCAT(d.vards, ' ',d.uzvards) AS gimenesarsts
FROM pacienti AS p
INNER JOIN darbinieki AS d
ON gimenes_arsts = darbinieks_id;

SELECT * from gimenesarstsPacientiem;

-- parāda visu informāciju (izņemot diagnozes) ieskaitot ģimenes ārstu un adresi
CREATE VIEW vissParPacientu AS
SELECT pacients_id, p.vards, p.uzvards, p.personas_kods, p.dzim_datums, p.talrunis, p.epasts, p.nacionalitate, CONCAT(d.vards, ' ',d.uzvards) AS gimenesarsts, 
CONCAT(a.valsts,', ', a.regions,', ',a.pilseta,', ',a.iela,' ',a.maja,', ',pasta_indekss) AS adrese
FROM pacienti AS p
INNER JOIN darbinieki AS d
ON gimenes_arsts = darbinieks_id
INNER JOIN adrese AS a
ON a.adrese_id = p.id_adrese;

SELECT * from vissParPacientu;


-- skats, kas glītāk izvadīs vizītes datus (reāli uzraksti, nevis cipari) 
CREATE VIEW vizites AS 
SELECT DISTINCT vizite_id, CONCAT(pac.vards, ' ', pac.uzvards) AS pacients, CONCAT(darb.vards,' ',darb.uzvards) AS arsts,
 laiks, pak.nosaukums AS pakNosaukums, gim_arsta_nosutijums, valsts_apmaksats, apdrosinasana, id_kabinets AS kabinets
FROM vizite
INNER JOIN pacienti AS pac 
ON vizite.id_pacients = pac.pacients_id
INNER JOIN pakalpojums AS pak
ON id_pakalpojums = pakalpojums_id
INNER JOIN darbinieki AS darb
ON id_arsts = darbinieks_id
ORDER BY laiks ASC;

SELECT * FROM vizites;


-- parāda informāciju par darbinieku (ieskaitot informāciju no citām tabulām!)
CREATE VIEW darbiniekaInfo AS
SELECT darbinieks_id, vards, uzvards, talrunis, liguma_nr, tips, epasts, lietotajvards, CONCAT(a.valsts,', ', a.regions,', ',a.pilseta,', ',a.iela,' ',a.maja,', ',pasta_indekss) AS adrese
FROM darbinieki 
LEFT JOIN lietotaji
ON darbinieks_id = id_darbinieks
INNER JOIN adrese AS a
ON adrese_id = id_adrese;

SELECT * FROM darbiniekaInfo WHERE darbinieks_id = 5;

-- parāda informāciju par darbinieka specialitātēm
CREATE VIEW darbSpecialitates AS
SELECT darbinieka_specialitate_id, specialitate_id, darbinieks_id, CONCAT(vards,' ', uzvards) AS darbinieks, nosaukums
FROM darbinieki
INNER JOIN darbinieka_specialitate 
ON darbinieks_id = id_darbinieks
INNER JOIN specialitate
ON specialitate_id = id_specialitate;

SELECT * FROM darbSpecialitates WHERE darbinieks_id = 3;

-- skats, kas atbild par pacienta diagnožu attēlot
CREATE VIEW diagnozes AS
SELECT id_pacients, id_diagnoze, pacienta_diagnoze_id, nosaukums, statuss
FROM pacienta_diagnoze 
INNER JOIN diagnoze
ON id_diagnoze = diagnozes_kods;

-- skats tiks izmantots, lai pie vizīšu ievietošanas/rediģēšanas var ievietot tikai speciālistus (ārstus)
CREATE VIEW arsti AS
SELECT * FROM darbinieki
WHERE tips = "Speciālists";

SELECT * FROM arsti;

-- skats tiks izmantots, lai pie pacientu ievietošanas/rediģēšanas var ievietot tikai ģimenes ārstus
CREATE VIEW gimenesarsti AS 
SELECT * FROM darbinieki 
INNER JOIN darbinieka_specialitate
ON darbinieks_id = id_darbinieks
WHERE id_specialitate = 3;

SELECT * FROM gimenesarsti;

-- skats, kas attēlo adreses dažādās vērtības kā vienu atlasāmu vērtību
CREATE VIEW adreseOneLine AS
SELECT adrese_id, CONCAT(valsts,', ', regions,', ',pilseta,', ',iela,' ',maja,', ',pasta_indekss) AS adrese
FROM adrese;

SELECT * FROM adreseOneLine;