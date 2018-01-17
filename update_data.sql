SELECT * FROM wp_options WHERE option_name LIKE '%show_avatars%';

UPDATE wp_options SET option_value = 0 WHERE option_id = 55; -- option value: 1