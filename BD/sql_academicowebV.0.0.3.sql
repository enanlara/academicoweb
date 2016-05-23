SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `academicoweb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `academicoweb` ;

-- -----------------------------------------------------
-- Table `academicoweb`.`Disciplinas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `academicoweb`.`Disciplinas` ;

CREATE TABLE IF NOT EXISTS `academicoweb`.`Disciplinas` (
  `disc_codigo` INT NOT NULL,
  `disc_nome` VARCHAR(45) NOT NULL,
  `disc_ementa` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`disc_codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `academicoweb`.`Estudantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `academicoweb`.`Estudantes` ;

CREATE TABLE IF NOT EXISTS `academicoweb`.`Estudantes` (
  `estu_matricula` VARCHAR(30) NOT NULL,
  `estu_nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`estu_matricula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `academicoweb`.`Cursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `academicoweb`.`Cursos` ;

CREATE TABLE IF NOT EXISTS `academicoweb`.`Cursos` (
  `curs_id` INT NOT NULL AUTO_INCREMENT,
  `curs_nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`curs_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `academicoweb`.`Professores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `academicoweb`.`Professores` ;

CREATE TABLE IF NOT EXISTS `academicoweb`.`Professores` (
  `prof_siape` INT NOT NULL,
  `prof_nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`prof_siape`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `academicoweb`.`Responsaveis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `academicoweb`.`Responsaveis` ;

CREATE TABLE IF NOT EXISTS `academicoweb`.`Responsaveis` (
  `resp_disc_id` INT NOT NULL,
  `resp_prof_siape` INT NOT NULL,
  `resp_ano` VARCHAR(45) NOT NULL,
  `resp_semestre` ENUM('1','2','0') NOT NULL COMMENT '1=primeiro semestre\n2=segundo semestre\n0=matéria não sendo lessionada',
  PRIMARY KEY (`resp_disc_id`, `resp_prof_siape`),
  INDEX `fk_Disciplinas_has_Professores_Professores1_idx` (`resp_prof_siape` ASC),
  INDEX `fk_Disciplinas_has_Professores_Disciplinas_idx` (`resp_disc_id` ASC),
  CONSTRAINT `fk_Disciplinas_has_Professores_Disciplinas`
    FOREIGN KEY (`resp_disc_id`)
    REFERENCES `academicoweb`.`Disciplinas` (`disc_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Disciplinas_has_Professores_Professores1`
    FOREIGN KEY (`resp_prof_siape`)
    REFERENCES `academicoweb`.`Professores` (`prof_siape`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `academicoweb`.`Matricula_por_disciplina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `academicoweb`.`Matricula_por_disciplina` ;

CREATE TABLE IF NOT EXISTS `academicoweb`.`Matricula_por_disciplina` (
  `matrd_estu_matricula` VARCHAR(30) NOT NULL,
  `matrd_disc_id` INT NOT NULL,
  `matrd_nota` VARCHAR(45) NOT NULL,
  `matrd_status` ENUM('0','1') NULL COMMENT '0=não aprovado\n1=aprovado',
  `matrd_data_inicial` DATE NOT NULL,
  `matrd_data_final` DATE NULL,
  PRIMARY KEY (`matrd_estu_matricula`, `matrd_disc_id`),
  INDEX `fk_Estudantes_has_Disciplinas_Disciplinas1_idx` (`matrd_disc_id` ASC),
  INDEX `fk_Estudantes_has_Disciplinas_Estudantes1_idx` (`matrd_estu_matricula` ASC),
  CONSTRAINT `fk_Estudantes_has_Disciplinas_Estudantes1`
    FOREIGN KEY (`matrd_estu_matricula`)
    REFERENCES `academicoweb`.`Estudantes` (`estu_matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estudantes_has_Disciplinas_Disciplinas1`
    FOREIGN KEY (`matrd_disc_id`)
    REFERENCES `academicoweb`.`Disciplinas` (`disc_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `academicoweb`.`Matriculas_por_curso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `academicoweb`.`Matriculas_por_curso` ;

CREATE TABLE IF NOT EXISTS `academicoweb`.`Matriculas_por_curso` (
  `matrc_curs_id` INT NOT NULL,
  `matrc_estu_matricula` VARCHAR(30) NOT NULL,
  `matrc_data_inicial` DATE NOT NULL,
  `matrc_data_final` DATE NULL,
  PRIMARY KEY (`matrc_curs_id`, `matrc_estu_matricula`),
  INDEX `fk_Cursos_has_Estudantes_Estudantes1_idx` (`matrc_estu_matricula` ASC),
  INDEX `fk_Cursos_has_Estudantes_Cursos1_idx` (`matrc_curs_id` ASC),
  CONSTRAINT `fk_Cursos_has_Estudantes_Cursos1`
    FOREIGN KEY (`matrc_curs_id`)
    REFERENCES `academicoweb`.`Cursos` (`curs_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cursos_has_Estudantes_Estudantes1`
    FOREIGN KEY (`matrc_estu_matricula`)
    REFERENCES `academicoweb`.`Estudantes` (`estu_matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `academicoweb`.`Matrizes_de_cursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `academicoweb`.`Matrizes_de_cursos` ;

CREATE TABLE IF NOT EXISTS `academicoweb`.`Matrizes_de_cursos` (
  `matrz_curs_id` INT NOT NULL,
  `matrz_disc_codigo` INT NOT NULL,
  PRIMARY KEY (`matrz_curs_id`, `matrz_disc_codigo`),
  INDEX `fk_Cursos_has_Disciplinas_Disciplinas1_idx` (`matrz_disc_codigo` ASC),
  INDEX `fk_Cursos_has_Disciplinas_Cursos1_idx` (`matrz_curs_id` ASC),
  CONSTRAINT `fk_Cursos_has_Disciplinas_Cursos1`
    FOREIGN KEY (`matrz_curs_id`)
    REFERENCES `academicoweb`.`Cursos` (`curs_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cursos_has_Disciplinas_Disciplinas1`
    FOREIGN KEY (`matrz_disc_codigo`)
    REFERENCES `academicoweb`.`Disciplinas` (`disc_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
