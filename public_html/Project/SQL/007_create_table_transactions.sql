CREATE TABLE IF NOT EXISTS Bank_Account_Transactions(
    id int AUTO_INCREMENT PRIMARY KEY,
    src int,
    dest int,
    diff int,
    typeTrans varchar(15) not null COMMENT 'The type of transaction that occurred',
    memo varchar(240) default null COMMENT  'Any extra details to attach to the transaction',
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (src) REFERENCES Bank_Accounts(id),
    FOREIGN KEY(dest) REFERENCES Bank_Accounts(id),
    constraint ZeroTransferNotAllowed CHECK(diff != 0)
)