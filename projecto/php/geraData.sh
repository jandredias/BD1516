echo $(

#INSERE UTILIZADOR
inicioMail="putas"
echo "insert into utilizador (userid, email) values ";

for userid in {1001..2000};
do
  mail=$inicioMail$userid;
  echo  -n "($userid,'$mail'),";

done;
userid=1000
mail=${inicioMail}${userid};
echo "(${userid},'$mail');";

#INSERE TIPO REGISTO
echo "insert into tipo_registo (userid, typecnt, nome, ativo) VALUES ";
for userid in {1001..2000};
do
  mail=$inicioMail$userid;
  echo -n "($userid, 1000${userid}, 'tipo de regsito', 1),";

done;
userid=1000
mail=${inicioMail}${userid};
echo "(${userid}, 1000${userid}, 'tipo de regsito', 1);";

#INSERE REGISTO
echo "insert into registo (userid, typecounter, regcounter, nome, ativo) VALUES ";
for userid in {1001..2000};
do
  mail=$inicioMail$userid;
  for idRegisto in {10..20}; do
    echo -n "($userid, 1000${userid}, 1000${userid}${idRegisto}, 'registo', 1),";
  done;
done;
userid=1000
mail=${inicioMail}${userid};
echo -n "($userid, 1000${userid}, 1000${userid}${idRegisto}, 'registo', 1);";

#INSERE PAGINA
echo "insert into pagina (userid, pagecounter, nome, ativa) VALUES ";
for userid in {1001..2000};
do
  mail=$inicioMail$userid;
  for idPagina in {20..37}; do
    echo -n "($userid, 1000${userid}${idPagina}, 'pagina', 1),";
  done;
done;
userid=1000
mail=${inicioMail}${userid};
echo -n "($userid, 1000${userid}${idPagina}, 'pagina', 1);";

#INSERE REG_PAG
echo "insert into reg_pag (userid, pageid, typeid, regid, ativa) VALUES ";
for userid in {1001..2000};
do
  mail=$inicioMail$userid;
  for idPagina in {20..37}; do
    for idRegisto in {10..20}; do
      echo -n "($userid, 1000${userid}${idPagina}, 1000${userid}, 1000${userid}${idRegisto}, 1),";
    done;


    #echo -n "($userid, 1000${userid}, 1000${userid}${idRegisto}, 'pagina', 1),";
  done;
done;
userid=1000
mail=${inicioMail}${userid};
echo -n "($userid, 1000${userid}${idPagina}, 1000${userid}, 1000${userid}${idRegisto}, 1);";


) >input
