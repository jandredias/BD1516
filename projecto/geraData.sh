echo $(
#echo "SET_FOREIGN_KEY_CHECKS = 0"

#INSERE UTILIZADOR
inicioMail="putas"
echo "insert into utilizador (userid, email) values ";
for userid in {10001..13000};
do
  mail=$inicioMail$userid;
  echo  -n "($userid,'$mail'),";

done;
userid=10000
mail=${inicioMail}${userid};
echo "(${userid},'$mail');";

#INSERE TIPO REGISTO
echo "insert into tipo_registo (userid, typecnt, nome, ativo) VALUES ";
for userid in {10001..13000};
do
  echo -n "($userid, 1${userid}, 'tipo de regsito', 1),";

done;
userid=10000
echo "(${userid}, 1${userid}, 'tipo de regsito', 1);";

#INSERE REGISTO
echo "insert into registo (userid, typecounter, regcounter, nome, ativo) VALUES ";
for userid in {10001..13000};
do
  for idRegisto in {10..20}; do
    echo -n "($userid, 1${userid}, 1${userid}${idRegisto}, 'registo', 1),";
  done;
done;
userid=10000
echo -n "($userid, 1${userid}, 1${userid}${idRegisto}, 'registo', 1);";

#INSERE IDSEQ FOR PAGE
echo "insert into sequencia (userid, contador_sequencia) VALUES ";
for userid in {10001..13000};
do
  for idPagina in {10..99}; do
    echo -n "( 12000, ${userid}1${idPagina} ),";
  done;
done;
idPagina=37
userid=10000
echo -n "( 12000, ${userid}1${idPagina} );";


#INSERE PAGINA
echo "insert into pagina (userid, pagecounter, nome, ativa, idseq) VALUES ";
for userid in {10001..13000};
do
  for idPagina in {10..99}; do
    echo -n "($userid, 1${userid}${idPagina}, 'pagina', 1, ${userid}1${idPagina}),";
  done;
done;
idPagina=37
userid=10000
echo -n "($userid, 1${userid}${idPagina}, 'pagina', 1, ${userid}1${idPagina});";

#INSERE IDSEQ FOR REG_PAG
echo "insert into sequencia (userid, contador_sequencia) VALUES ";
for userid in {10001..13000};
do
  #NEW
  for idPagina in {20..37}; do
    for idRegisto in {10..20}; do
      echo -n "(12000, ${userid}2${idPagina}${idRegisto}),";
    done;
  done;

done;
userid=10000
echo -n "( 12000, ${userid}2${idPagina}${idRegisto} );";

#INSERE REG_PAG
echo "insert into reg_pag (userid, pageid, typeid, regid, ativa, idseq) VALUES ";
for userid in {10001..13000};
do
  for idPagina in {20..37}; do
    for idRegisto in {10..20}; do
      echo -n "($userid, 1${userid}${idPagina}, 1${userid}, 1${userid}${idRegisto}, 1, ${userid}2${idPagina}${idRegisto}),";
    done;
  done;
done;
userid=10000
echo -n "($userid, 1${userid}${idPagina}, 1${userid}, 1${userid}${idRegisto}, 1,${userid}2${idPagina}${idRegisto});";


) >input
