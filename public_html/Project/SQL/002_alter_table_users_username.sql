ALTER TABLE Users ADD COLUMN username varchar(30) 
not null unique default (substring_index(email, '@', 1)) 
COMMENT 'Username field that defaults to the name of the email given';
ALTER TABLE Users
ADD is_active varchar(15) NOT NULL default "true";