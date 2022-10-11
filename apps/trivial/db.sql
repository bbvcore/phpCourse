-- CREACIÓN DE LA TABLA   "QUESTIONS"
CREATE TABLE `exams`.`questions` ( 
    `id` INT(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT ,
    `question` VARCHAR(255) NOT NULL ,
    `option01` VARCHAR(128) NOT NULL ,
    `option02` VARCHAR(128) NOT NULL ,
    `option03` VARCHAR(128) NOT NULL ,
    `option04` VARCHAR(128) NOT NULL ,    
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci; 


-- CREACIÓN DE LA TABLA   "ANSWERS"
CREATE TABLE `exams`.`answers` ( 
    `idAnswers` INT(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT ,
    `correct` VARCHAR(255) NOT NULL ,   
    `id` INT(8) UNSIGNED ZEROFILL NOT NULL ,
    PRIMARY KEY (`idAnswers`),
    foreign key(`id`) references `questions`(`id`) on delete cascade on update cascade
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci; 

-- MODIFICACIONES PARA AÑADIR CLAVE FORANEA
-- OPCION 1 (CREACIÓN TABLA): foreign key(`idAnswers`) references `answers`(`idAnswers`) on delete cascade on update cascade
-- OPCION 2 (MODIFICACIÓN TABLA CREADA): ALTER TABLE `answers` add CONSTRAINT `Add_FK` FOREIGN KEY (`id`) REFERENCES `questions`(`id`); 



-- INTRODUCCIÓN DE UNOS VALORES EN LA TABLA QUESTIONS
INSERT INTO `questions`(`question`, `option01`, `option02`, `option03`,`option04`) VALUES ('¿Quién descubrió América?','Americo Vespucio','Cristobal Colón','El Cano','Livingstone Supongo');
INSERT INTO `questions`(`question`, `option01`, `option02`, `option03`,`option04`) VALUES ('¿Qué equipo de la NBA tiene más anillos?','Angeles Lakers','Boston Celtics','Los Lakers y los Celtics','Golden State Warriors');
INSERT INTO `questions`(`question`, `option01`, `option02`, `option03`,`option04`) VALUES ('¿Qué equipo de fútbol posee el único titulo oficial Europeo para la UEFA?','Deportivo de la Coruña','C.D. Lugo','Celta','S.D. Ponferradina');
INSERT INTO `questions`(`question`, `option01`, `option02`, `option03`,`option04`) VALUES ('¿Que tienen en común Android y IOS?','Ser sistemas operativos móviles','Compartir tienda de aplicaciones','Compartir tipografía','Unix');

-- INTRODUCCIÓN DE UNOS VALORES EN LA TABLA ANSWERS
INSERT INTO `answers` (`idAnswers`, `correct`, `id`) VALUES (NULL, 'a', '00000001');
INSERT INTO `answers` (`idAnswers`, `correct`, `id`) VALUES (NULL, 'c', '00000002');
INSERT INTO `answers` (`idAnswers`, `correct`, `id`) VALUES (NULL, 'c', '00000003');
INSERT INTO `answers` (`idAnswers`, `correct`, `id`) VALUES (NULL, 'd', '00000004');


-- CONSULTA INNER JOIN TOTAL
SELECT *
FROM questions
INNER JOIN answers
ON questions.id = answers.id;

-- CONSULTA INNER JOIN SEGÚN VALOR ID para el primer registro id
SELECT correct
FROM questions
INNER JOIN answers
ON questions.id = answers.id
WHERE questions.id = '00000001';
