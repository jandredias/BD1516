/* ---------------------------------------------------------------------------
   ---------------------------------------------------------------------------
Todo o valor de contador sequencia existente na relação sequencia existe numa e
uma vez no universo das relaçõoes tipo registo, pagina, campo, registo e valor.
   ---------------------------------------------------------------------------
   ---------------------------------------------------------------------------
*/
drop PROCEDURE IF EXISTS occurences_in_table;
Delimiter //
CREATE  PROCEDURE `occurences_in_table`(IN tab_name VARCHAR(60), IN idseq_value int , OUT number_ocurrences int )
BEGIN

 SET @table = tab_name;
 SET @seq = idseq_value;
 SET @t1 =CONCAT('SELECT count(*) as times FROM ',@table,' t WHERE t.idseq = ',@seq ,' into number_ocurrences');
 PREPARE stmt3 FROM @t1;
 EXECUTE stmt3;
 DEALLOCATE PREPARE stmt3;
END //
Delimiter ;


call occurences_in_table('pagina' , '151489', value);


drop function IF EXISTS consulting;
Delimiter //
create function consulting ()
  returns int
begin
  declare value int;
  call occurences_in_table('pagina' , '151489', value);
  return value
END //
Delimiter ;





Delimiter //
CREATE TRIGGER upd_tables BEFORE UPDATE ON pagina
FOR EACH ROW
BEGIN
  DECLARE rowsCount int;
  DECLARE value1     int;
  DECLARE value2     int;
  DECLARE value3     int;
  DECLARE value4     int;
  DECLARE value5     int;
  DECLARE msg VARCHAR(255);
  call occurences_in_table('pagina'       , new.idseq, value1);
  set rowsCount = rowsCount + value1;
  call occurences_in_table('tipo_registo' , new.idseq, value2);
  set rowsCount = rowsCount + value2;
  call occurences_in_table('registo'      , new.idseq, value3);
  set rowsCount = rowsCount + value3;
  call occurences_in_table('campo'        , new.idseq, value4);
  set rowsCount = rowsCount + value4;
  call occurences_in_table('valor'        , new.idseq, value5);
  set rowsCount = rowsCount + value5;


  IF rowsCount > 0 THEN
  	  set msg = "DIE: You broke the rules... I will now Smite you, hold still...";
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
      /*ROLLBACK;*/
  END IF;
END //
Delimiter ;

  SELECT COUNT(*)
  FROM pagina
  WHERE idseq is :new.idseq INTO rowsCount;

-- CHECK THIS TABLES
tipo_registo
registo
pagina
campo
valor
reg_pag
------------------
