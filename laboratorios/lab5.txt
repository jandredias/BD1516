1 a)
    SELECT distinct d.customer_name     FROM depositor d, account a     WHERE d.account_number = a.account_number AND a.balance > 500;
  b)
    SELECT distinct l.branch_name FROM borrower b, loan l WHERE b.loan_number = l.loan_number and l.amount >= 1000 and l.amount <= 2000;
  c)
    SELECT a.balance*1.1 FROM account a WHERE a.branch_name = "Downtown";
  d)
    SELECT a.balance
    FROM         account a
    NATURAL JOIN depositor d
    NATURAL JOIN customer c
    NATURAL JOIN borrower b
    WHERE b.loan_number = "L-15";
  e)
    SELECT DISTINCT c.customer_name
    FROM customer c, branch b
    WHERE c.customer_city = ANY (select b.branch_city);
  f)
     SELECT b.assets
     FROM branch b, account a, depositor d
     WHERE a.branch_name = b.branch_name AND a.account_number = d.account_number AND d.customer_name = "Jones";
  g)
     SELECT b.branch_name
     FROM branch b, account a, depositor d
     WHERE a.branch_name = b.branch_name AND a.account_number = d.account_number AND d.customer_name LIKE 'J%s';
  h)
     SELECT l.amount
     FROM loan l, borrower b, customer c
     WHERE b.customer_name = c.customer_name AND l.loan_number = b.loan_number AND c.customer_street LIKE '____';
  i)
    SELECT c.*
    FROM customer c, borrower bo, loan l, branch br
    WHERE bo.customer_name = c.customer_name AND bo.loan_number = l.loan_number AND l.branch_name = br.branch_name AND br.branch_city = c.customer_city;

2 a)
    SELECT c.*
    FROM customer c NATURAL JOIN depositor d
    WHERE c.customer_name NOT IN (
      SELECT b.customer_name
      FROM borrower b
    );
  b)
  c)
    SELECT COUNT( DISTINCT c.customer_name)
    FROM customer c, depositor d, account a, branch b
    WHERE c.customer_name = d.customer_name AND d.account_number = a.account_number AND a.branch_name = b.branch_name AND b.branch_city = c.customer_city
    ;
  d)
    SELECT SUM(a.balance)
    FROM account a, branch b
    WHERE a.branch_name = b.branch_name AND b.branch_city = "Brooklyn"
    ;
  e)
  f)
    CREATE TEMPORARY TABLE IF NOT EXISTS
    total_loans
      SELECT b.customer_name , SUM(l.amount) as TOTAL
      FROM loan l NATURAL JOIN borrower b
      GROUP BY customer_name
      ;

    CREATE TEMPORARY TABLE IF NOT EXISTS
    max_loan
      SELECT MAX(t.TOTAL) as maxi_loan
      FROM total_loans t
    ;
### This
    SELECT customer_name, customer_street, customer_city
    FROM total_loans NATURAL JOIN customer, max_loan
    WHERE  TOTAL = maxi_loan
    ;
### Or this one
    SELECT t.*
    FROM total_loans t , max_loan m
    WHERE t.TOTAL = m.maxi_loan
    ;


---------------
  f) the same
    SELECT c.*
    FROM borrower NATURAL JOIN loan NATURAL JOIN customer c
    GROUP BY customer_name
    HAVING sum(amount) >= ALL
      (
        SELECT sum(amount)
        FROM loan NATURAL JOIN borrower
        GROUP BY customer_name
      )
    ;

  g)
    SELECT c.*
    FROM depositor d, customer c, account a
    WHERE d.customer_name = c.customer_name AND a.account_number = d.account_number
    HAVING sum(a.balance) >= ALL
      (
        SELECT sum(balance)
        FROM account NATURAL JOIN depositor
        GROUP BY account_number
      )
    ;
  h)
    same mechanism as the previous 2
  i)
    SELECT DISTINCT d.customer_name
    FROM depositor d NATURAL JOIN account a NATURAL JOIN branch
    WHERE NOT EXISTS (
      SELECT branch_name
      FROM branch b
      WHERE branch_name NOT IN (
        SELECT branch_name
        FROM account a2
        WHERE a.account_number = a2.account_number
      )
    )
    ;
