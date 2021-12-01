ALTER TABLE Bank_Accounts
DROP Check `Bank_Accounts_chk_1`;
ADD Check(length(account_number) =12);