1 a)
  drop function IF EXISTS account_balance;
  Delimiter //
  create function account_balance (c_name varchar(255))
    returns decimal(20,2)
  begin
    declare positive_balance decimal(20,2);
    declare negative_balance decimal(20,2);
    SELECT sum(l.amount) into negative_balance
      FROM borrower b, loan l
      WHERE l.loan_number = b.loan_number AND
            b.customer_name = c_name;

    SELECT sum(a.balance) into positive_balance
      FROM  depositor d, account a
      WHERE a.account_number = d.account_number AND
            d.customer_name = c_name;
    IF positive_balance is NULL then set positive_balance=0; END IF;
    IF negative_balance is NULL then set negative_balance=0; END IF;
    return positive_balance - negative_balance;
  END //
  Delimiter ;
b)
  drop function IF EXISTS branch_avg_balance;
  Delimiter //
  create function branch_avg_balance (b_name varchar(255))
    returns decimal(20,2)
  begin
    declare avg_balance decimal(20,2);
    SELECT avg(a.balance) into avg_balance
      FROM  account a
      WHERE a.branch_name = b_name;
    IF avg_balance is NULL then set avg_balance=0; END IF;
    return avg_balance;
  END //
  Delimiter ;

  drop function IF EXISTS diif_branch_avg;
  Delimiter //
  create function diif_branch_avg (b1_name varchar(255),b2_name varchar(255))
    returns decimal(20,2)
  begin
    declare avg_balance1 decimal(20,2);
    declare avg_balance2 decimal(20,2);
    SELECT branch_avg_balance(b1_name) INTO avg_balance1;
    SELECT branch_avg_balance(b2_name) INTO avg_balance2;
    return avg_balance1 - avg_balance2;
  END //
  Delimiter ;

c)
  drop function IF EXISTS consulting;
  Delimiter //
  create function consulting ()
    returns varchar(255)
  begin
    SELECT a1.branch_name
    FROM account a1, account a2
    WHERE a1.branch_name != a2.branch_name
    GROUP BY a1.branch_name
    HAVING min(diif_branch_avg(a1.branch_name,a2.branch_name)>=0);

  END //
  Delimiter ;

d)
 alter table depositor drop foreign key depositor_ibfk_2;

 (?? -v)
 alter table depositor add foreign key(account_number) on delete cascade;
 (?? -^)

2 a)
  Delimiter //
  CREATE TRIGGER upd_loan AFTER UPDATE ON loan
  FOR EACH ROW
  BEGIN
    IF NEW.amount <= 0 then
      UPDATE branch b
      SET assets = assets + NEW.amount*(-1)
      WHERE b.branch_name = NEW.branch_name;
      delete from borrower where loan_number = new.loan_number
    END IF;
  END //
  Delimiter ;
