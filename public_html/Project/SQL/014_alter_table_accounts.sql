ALTER TABLE Bank_Accounts
ADD active varchar(15) DEFAULT 'true';
ALTER TABLE Bank_Accounts
ALTER active SET DEFAULT 'active';
ALTER Table Bank_Accounts
DROP Column active;