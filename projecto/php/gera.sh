rm out; for e in $(find . | grep php); do echo "\\section{"$e"}" >>out; echo -e "\\\begin{lstlisting}\n" >>out; cat $e >>out; echo -e "\\\end{lstlisting}\n" >>out; done;
sed -i -- 's/[áàãâ]/a/g' out
sed -i -- 's/[íìĩî]/i/g' out
sed -i -- 's/[óòõô]/o/g' out
sed -i -- 's/[úùũû]/u/g' out
sed -i -- 's/index_default/index\\_default/g' out
