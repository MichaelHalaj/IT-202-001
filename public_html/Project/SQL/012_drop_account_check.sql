ALTER TABLE Bank_Accounts
DROP Check `Bank_Accounts_chk_1`;

ALTER TABLE Bank_Accounts 
ADD Check(length(account) =12);