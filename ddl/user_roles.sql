CREATE TABLE user_roles (
                            createdAt DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            updatedAt DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            userId    Integer(11) NOT NULL,
                            roleId    Integer(11) NOT NULL,
                            PRIMARY KEY (
                                         roleId,
                                         userId
                                )
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE user_roles COMMENT = '';

