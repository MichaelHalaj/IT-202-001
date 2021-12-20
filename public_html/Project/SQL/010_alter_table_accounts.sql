ALTER TABLE Bank_Accounts
ADD account_type varchar(15);
ALTER TABLE Bank_Accounts
ADD updated TIMESTAMP;
ALTER TABLE Bank_Accounts
MODIFY COLUMN balance BIGINT;

ALTER TABLE Bank_Accounts
ADD frozen varchar(15) DEFAULT 'false';