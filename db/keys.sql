
ALTER TABLE `rf_campaign` ADD FOREIGN KEY (`organization_id`) REFERENCES `rf_organization` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `rf_campaign` ADD FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `rf_campaign_setting` ADD FOREIGN KEY (`campaign_id`) REFERENCES `rf_campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `rf_user` ADD FOREIGN KEY (`organization_id`) REFERENCES `rf_organization` (`id`) ON DELETE SET NULL ON UPDATE CASCADE; -- ?!
-- ALTER TABLE `rf_user` ADD FOREIGN KEY (`country_id`) REFERENCES `rf_country` (`id`) ON DELETE SET NULL ON UPDATE CASCADE; -- ?! -- think about

ALTER TABLE `rf_invitation` ADD FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE; -- ?!
ALTER TABLE `rf_invitation` ADD FOREIGN KEY (`inviter_id`) REFERENCES `rf_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE; -- ?!

ALTER TABLE `rf_user_statistic` ADD FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `rf_purchase` ADD FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `rf_payout` ADD FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
