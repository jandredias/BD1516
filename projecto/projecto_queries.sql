/* Quais s~ao os utilizadores que falharam o login mais vezes do que tiveram sucesso? */
/*Check again..*/
SELECT DISTINCT COUNT(*), userid
FROM login l1
WHERE sucesso=0
GROUP BY userid
HAVING COUNT(*) > (
	SELECT COUNT(*)
	FROM login l2
	WHERE sucesso=1 AND l1.userid=l2.userid
	GROUP BY userid);

/* Quais s~ao os registos          que aparecem em todas as paginas de um utilizador?*/
/*FIXME check if active maybe!!!*/
SELECT r.regcounter
FROM registo r
WHERE
-- if we want a particular user
-- r.userid=33333 and
NOT EXISTS (
	SELECT p.pagecounter
	FROM pagina p
	WHERE p.userid=r.userid and NOT EXISTS (
	SELECT rp.pageid
		FROM reg_pag rp
		WHERE rp.pageid=p.pagecounter
		AND   rp.regid=r.regcounter));

/*  IGUAL MAS SEM TABS, IDEAL PARA TESTAR NO mysql
SELECT r.regcounter
FROM registo r
WHERE
-- if we want a particular user
-- r.userid=33333 and
NOT EXISTS (
SELECT p.pagecounter
FROM pagina p
WHERE p.userid=r.userid and NOT EXISTS (
SELECT rp.pageid
FROM reg_pag rp
WHERE rp.pageid=p.pagecounter
AND   rp.regid=r.regcounter))
order by r.regcounter
;

*/

/*Quais os utilizadores que tem o maior numero medio de registos por pagina?*/
DROP TABLE if EXISTS
numero_reg_cada_pag;
CREATE TEMPORARY TABLE IF NOT EXISTS
numero_reg_cada_pag
select p.userid, p.pagecounter,sum(rp.ativa) as numero_registos
from pagina p left outer join reg_pag rp on (p.pagecounter=rp.pageid)
where p.ativa=1
/* for specific user */
-- and p.userid=439
group by p.userid, p.pagecounter;


/* avg did not take into account the nulls */
SELECT nrcp.userid, sum(numero_registos)/count(*) /*avg(numero_registos)*/ as media
FROM numero_reg_cada_pag nrcp
GROUP BY nrcp.userid
HAVING media > 0
ORDER BY media DESC;
*/


/* Alternativo */
DROP TABLE if EXISTS
numero_reg;
CREATE TEMPORARY TABLE IF NOT EXISTS
numero_reg
SELECT rp.userid, count(*) as numero_registos
FROM pagina p, reg_pag rp
where p.pagecounter=rp.pageid
and rp.ativa=1 and p.ativa=1
/* for specific user */
/* and p.userid=439 */
GROUP BY rp.userid;

DROP TABLE if EXISTS
numero_pag;
CREATE TEMPORARY TABLE IF NOT EXISTS
numero_pag
SELECT p.userid, count(*) as numero_paginas
FROM pagina p
WHERE p.ativa=1
/* for specific user */
/* and p.userid=439 */
GROUP BY p.userid;

SELECT np.userid, numero_registos/numero_paginas as media
FROM numero_pag np, numero_reg nr
WHERE np.userid = nr.userid
ORDER BY media DESC;

DROP TABLE if EXISTS
numero_pag;
DROP TABLE if EXISTS
numero_reg;


/* Quais os utilizadores que, em todas as suas paginas, tem registos de todos os
tipos de registos que criaram? */
DROP TABLE if EXISTS
tipo_reg_cada_pag;
CREATE TEMPORARY TABLE IF NOT EXISTS
tipo_reg_cada_pag
select p.userid, p.pagecounter, rp.typeid
from pagina p left outer join reg_pag rp on (p.pagecounter=rp.pageid)
where p.ativa=1 and rp.ativa=1
/* for specific user */
-- and p.userid=33333
group by p.pagecounter, rp.typeid;

DROP TABLE if EXISTS
todos_tipos_user;
CREATE TEMPORARY TABLE IF NOT EXISTS
todos_tipos_user
select tr.userid, tr.typecnt
from tipo_registo tr
where tr.ativo=1
/* for specific user */
-- and tr.userid=33333
;

DROP TABLE if EXISTS
numero_tip_reg;
CREATE TEMPORARY TABLE IF NOT EXISTS
numero_tip_reg
select userid, count(*) as numero_registos_user
from tipo_registo
where ativo=1
/* for specific user */
-- and userid=33333
group by userid;


DROP TABLE if EXISTS
join_pag_tip_reg;
CREATE TEMPORARY TABLE IF NOT EXISTS
join_pag_tip_reg
select trcp.userid, pagecounter, typeid, typecnt, sum(typeid=typecnt) as numero_tipos_reg_pagina, numero_registos_user
from tipo_reg_cada_pag trcp , todos_tipos_user ttu , numero_tip_reg ntr
where trcp.userid = ttu.userid and ntr.userid = ttu.userid
group by pagecounter;

SELECT userid
from join_pag_tip_reg jptr
group by userid
having sum(numero_tipos_reg_pagina<>numero_registos_user)=0;
