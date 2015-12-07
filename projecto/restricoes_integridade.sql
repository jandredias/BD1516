/* ---------------------------------------------------------------------------
   ---------------------------------------------------------------------------
Todo o valor de contador sequencia existente na relação sequencia existe numa e
uma vez no universo das relaçõoes tipo registo, pagina, campo, registo e valor.
   ---------------------------------------------------------------------------
   ---------------------------------------------------------------------------
*/




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



drop function IF EXISTS consulting;
Delimiter //
create function consulting (new_idseq int)
  returns int
begin
	DECLARE rowsCount int;
	DECLARE number_ocurrences int;
	set rowsCount = 0;
	/*pagina*/
	SELECT count(*)
	FROM pagina t
	WHERE t.idseq = new_idseq
	into number_ocurrences;
	set rowsCount = rowsCount + number_ocurrences;

	/*tipo_registo*/
	SELECT count(*)
	FROM tipo_registo t
	WHERE t.idseq = new_idseq
	into number_ocurrences;
	set rowsCount = rowsCount + number_ocurrences;

	/*registo*/
	SELECT count(*)
	FROM registo t
	WHERE t.idseq = new_idseq
	into number_ocurrences;
	set rowsCount = rowsCount + number_ocurrences;

	/*campo*/
	SELECT count(*)
	FROM campo t
	WHERE t.idseq = new_idseq
	into number_ocurrences;
	set rowsCount = rowsCount + number_ocurrences;

	/*valor*/
	SELECT count(*)
	FROM valor t
	WHERE t.idseq = new_idseq
	into number_ocurrences;
	set rowsCount = rowsCount + number_ocurrences;

	return rowsCount;
END //
Delimiter ;

select  consulting('151489');




Delimiter //
CREATE TRIGGER upd_tables BEFORE UPDATE ON pagina
FOR EACH ROW
BEGIN
  DECLARE rowsCount int;
  DECLARE msg VARCHAR(512)
  set rowsCount = select consulting(new.idseq);


  IF rowsCount <> 0 THEN
  	  set msg = "DIE: You broke the rules... I will now Smite you, hold still...";
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
      /*ROLLBACK;*/
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
