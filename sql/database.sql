--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_create` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`uid`),
  UNIQUE KEY `users_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger for table `users`
--

CREATE OR REPLACE TRIGGER add_role
AFTER INSERT
ON users FOR EACH ROW
BEGIN
	INSERT INTO user_role (uid_user) VALUES (NEW.uid);
END

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Datas for table `roles`
--

INSERT INTO `roles` VALUES
(1,'user'),
(10,'administrator');

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `uid_user` varchar(32) NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT 1,
  `date_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`uid_user`,`id_role`),
  KEY `user_role_roles_FK` (`id_role`),
  CONSTRAINT `user_role_roles_FK` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`),
  CONSTRAINT `user_role_users_FK` FOREIGN KEY (`uid_user`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
