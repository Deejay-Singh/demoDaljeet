ALTER TABLE `users`
  DROP `email`,
  DROP `mobile`,
  DROP `last_name`;
  
ALTER TABLE `users` ADD `is_deleted` BOOLEAN NOT NULL DEFAULT '0'
