/*******************************************************************************
 * Database character set: utf8mb3
 * Server version: 5.5
 * Server version build: 5.5.5-10.6.12-MariaDB-0ubuntu0.22.10.1
 ******************************************************************************/

/*******************************************************************************
 * Selected metadata objects
 * -------------------------
 * Extracted at 3/2/2023 11:11:18 AM
 ******************************************************************************/

/*******************************************************************************
 * Tables
 * ------
 * Extracted at 3/2/2023 11:11:18 AM
 ******************************************************************************/

CREATE TABLE account_status (
  apiaryid Integer(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (
      apiaryid
  )
) ENGINE=InnoDB AUTO_INCREMENT=1 ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
ALTER TABLE account_status COMMENT = '';
CREATE TABLE alveo_export (
  account            Integer(11) NOT NULL,
  dashmin            Integer(11) NOT NULL,
  account_created_on Date,
  account_label      VarChar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  first_name         VarChar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  last_name          VarChar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  phone              VarChar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  email              VarChar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  start_balance      Decimal(10, 0),
  current_balance    Decimal(10, 0),
  highest_balance    Decimal(10, 0),
  lowest_balance     Decimal(10, 0),
  daily_return       Decimal(10, 0),
  num_trades         Integer(11),
  num_win_trades     Integer(11),
  num_loss_trades    Integer(11),
  amt_win_trades     Decimal(10, 0),
  amt_loss_trades    Decimal(10, 0),
  avg_win_trade_amt  Decimal(10, 0),
  avg_loss_trade_amt Decimal(10, 0),
  expectancy         Decimal(10, 0),
  sharpe_ratio       Double,
  report_date        Date,
  processing_date    Date,
  PRIMARY KEY (
      dashmin
  )
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE alveo_export COMMENT = '';
CREATE TABLE roles (
  id        Integer(11) NOT NULL,
  `name`    VarChar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  createdAt DateTime NOT NULL,
  updatedAt DateTime NOT NULL,
  PRIMARY KEY (
      id
  )
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE roles COMMENT = '';
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
) ENGINE=InnoDB AUTO_INCREMENT=12 ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE users COMMENT = '';
CREATE TABLE user_roles (
  createdAt DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updatedAt DateTime NOT NULL DEFAULT '0000-00-00 00:00:00',
  userId    Integer(11) NOT NULL,
  roleId    Integer(11) NOT NULL,
  PRIMARY KEY (
      roleId,
      userId
  )
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE user_roles COMMENT = '';
/*******************************************************************************
 * Indices
 * -------
 * Extracted at 3/2/2023 11:11:18 AM
 ******************************************************************************/

CREATE INDEX userId
 ON user_roles(userId);
/*******************************************************************************
 * Unique Constraints
 * ------------------
 * Extracted at 3/2/2023 11:11:18 AM
 ******************************************************************************/

ALTER TABLE users ADD CONSTRAINT apiaryid UNIQUE
    (apiaryid);

/*******************************************************************************
 * Foreign Key Constraints
 * -----------------------
 * Extracted at 3/2/2023 11:11:18 AM
 ******************************************************************************/

ALTER TABLE alveo_export ADD CONSTRAINT Dashmin_FK1 FOREIGN KEY (dashmin)
  REFERENCES users (apiaryid)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE user_roles ADD CONSTRAINT user_roles_ibfk_1 FOREIGN KEY (roleId)
  REFERENCES roles (id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE user_roles ADD CONSTRAINT user_roles_ibfk_2 FOREIGN KEY (userId)
  REFERENCES users (id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE account_status ADD CONSTRAINT fk_account_status_users FOREIGN KEY (apiaryid)
  REFERENCES users (apiaryid)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
