CREATE TABLE alveo_export (
                              export_id          Integer(11) NOT NULL AUTO_INCREMENT,
                              account            Integer(11) NOT NULL,
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
                                           export_id
                                  )
) ENGINE=InnoDB AUTO_INCREMENT=1 ROW_FORMAT=DYNAMIC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
ALTER TABLE alveo_export COMMENT = '';

