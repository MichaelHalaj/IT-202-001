ALTER TABLE Users
ADD visibility VARCHAR(15) DEFAULT 'public';
ALTER TABLE Users
DROP COLUMN visibility;