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


call occurences_in_table('pagina' , '151489');


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
CREATE OR REPLACE TRIGGER upd_tables BEFORE INSERT OR UPDATE ON pagina
FOR EACH ROW
BEGIN
  DECLARE rowsCount int;
  SELECT COUNT(*)
  FROM pagina
  WHERE idseq is :new.idseq INTO rowsCount;
     IF rowsCount > 0
  THEN
      RAISE_APPLICATION_ERROR(-20101, 'A idseq with the same number currently exists.');
      ROLLBACK;
  END IF;
END //
Delimiter ;


-- CHECK THIS TABLES
tipo_registo
registo
pagina
campo
valor
reg_pag
------------------