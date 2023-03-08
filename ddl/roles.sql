CREATE TABLE roles (
                       id        Integer(11) NOT NULL AUTO_INCREMENT,
                       `name`    VarChar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
                       createdAt DateTime DEFAULT CURRENT_TIMESTAMP,
                       updatedAt DateTime DEFAULT CURRENT_TIMESTAMP,
                       PRIMARY KEY (
                                    id
                           )
) ENGINE=InnoDB AUTO_INCREMENT=1 ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE roles COMMENT = '';

