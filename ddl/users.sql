CREATE TABLE users (
                       id        Integer(11) NOT NULL AUTO_INCREMENT,
                       apiaryid  Integer(11),
                       firstname VarChar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
                       lastname  VarChar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
                       email     VarChar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
                       username  VarChar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
                       password  VarChar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
                       lastLogin DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                       createdAt DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                       updatedAt DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                       PRIMARY KEY (
                                    id
                           )
) ENGINE=InnoDB AUTO_INCREMENT=16 ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE users COMMENT = '';

