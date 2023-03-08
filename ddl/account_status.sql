CREATE TABLE account_status (
                                id     Integer(11) NOT NULL AUTO_INCREMENT,
                                status VarChar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                                PRIMARY KEY (
                                             id
                                    )
) ENGINE=InnoDB AUTO_INCREMENT=1 ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE account_status COMMENT = '';

