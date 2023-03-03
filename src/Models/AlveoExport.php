<?php

namespace Model;
use Exception;

class AlveoExport
{
    protected $table = 'alveo_export';

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $account;

    /**
     * @var int
     */
    private $dashmin;

    /**
     * @var date
     */
    private $accountCreatedOn;

    /**
     * @var string
     */
    private $accountLabel;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var double
     */
    private $startBalance;

    /**
     * @var double
     */
    private $currentBalance;

    /**
     * @var double
     */
    private $highestBalance;

    /**
     * @var double
     */
    private $lowestBalance;

    /**
     * @var double
     */
    private $dailyReturn;

    /**
     * @var int
     */
    private $numTrades;

    /**
     * @var int
     */
    private $numWinTrades;

    /**
     * @var int
     */
    private $numLossTrades;

    /**
     * @var double
     */
    private $amtWinTrades;

    /**
     * @var double
     */
    private $amtLossTrades;

    /**
     * @var double
     */
    private $avgWinTradeAmt;

    /**
     * @var double
     */
    private $avgLossTradeAmt;

    /**
     * @var double
     */
    private $expectancy;

    /**
     * @var double
     */
    private $sharpe_ratio;

    /**
     * @var date
     */
    private $reportDate;

    /**
     * @var date
     */
    private $processingDate;


    public function __construct(
        int $id,
        int $account,
        int $dashmin,
        date $accountCreatedOn,
        string $accountLabel,
        string $firstName,
        string $lastName,
        string $phone,
        string $email,
        double $startBalance,
        double $currentBalance,
        double $highestBalance,
        double $lowestBalance,
        double $dailyReturn,
        int $numTrades,
        int $numWinTrades,
        int $numLossTrades,
        double $amtWinTrades,
        double $amtLossTrades,
        double $avgWinTradeAmt,
        double $avgLossTradeAmt,
        double $expectancy,
        double $sharpeRatio,
        date $reportDate,
        date $processingDate
    ) {
        $this->id = $id;
        $this->account = $account;
        $this->dashmin = $dashmin;
        $this->accountCreatedOn = $accountCreatedOn;
        $this->accountLabel = $accountLabel;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
        $this->startBalance = $startBalance;
        $this->currentBalance = $currentBalance;
        $this->highestBalance = $highestBalance;
        $this->lowestBalance = $lowestBalance;
        $this->dailyReturn = $dailyReturn;
        $this->numTrades = $numTrades;
        $this->numWinTrades = $numWinTrades;
        $this->numLossTrades = $numLossTrades;
        $this->amtWinTrades = $amtWinTrades;
        $this->amtLossTrades = $amtLossTrades;
        $this->avgWinTradeAmt = $avgWinTradeAmt;
        $this->avgLossTradeAmt = $avgLossTradeAmt;
        $this->expectancy = $expectancy;
        $this->sharpeRatio = $sharpeRatio;
        $this->reportDate = $reportDate;
        $this->processingDate = $processingDate;
    }

    // Getters {

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAccount(): int
    {
        return $this->account;
    }

    /**
     * @return int
     */
    public function getDashmin(): int
    {
        return $this->dashmin;
    }

    /**
     * @return date
     */
    public function getAccountCreatedOn(): date
    {
        return $this->accountCreatedOn;
    }

    /**
     * @return string
     */
    public function getAccountLabel(): string
    {
        return $this->accountLabel;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return double
     */
    public function getStartBalance(): double
    {
        return $this->startBalance;
    }

    /**
     * @return double
     */
    public function getCurrentBalance(): double
    {
        return $this->currentBalance;
    }
    
    /**
     * @return double
     */
    public function getHighestBalance(): double
    {
        return $this->highestBalance;
    }

    /**
     * @return double
     */
    public function getLowestBalance(): double
    {
        return $this->lowestBalance;
    }

    /**
     * @return double
     */
    public function getDailyReturn(): double
    {
        return $this->dailyReturn;
    }

    /**
     * @return int
     */
    public function getNumTrades(): int
    {
        return $this->numTrades;
    }

    /**
     * @return int
     */
    public function getNumWinTrades(): int
    {
        return $this->numWinTrades;
    }

    /**
     * @return int
     */
    public function getNumLossTrades(): int
    {
        return $this->numLossTrades;
    }

    /**
     * @return double
     */
    public function getAmtWinTrades(): double
    {
        return $this->amtWinTrades;
    }

    /**
     * @return double
     */
    public function getAmtLossTrades(): double
    {
        return $this->amtLossTrades;
    }

    /**
     * @return double
     */
    public function getAvgWinTradeAmt(): double
    {
        return $this->avgWinTradeAmt;
    }

    /**
     * @return double
     */
    public function getAvgLossTradeAmt(): double
    {
        return $this->avgLossTradeAmt;
    }

    /**
     * @return double
     */
    public function getExpectancy(): double
    {
        return $this->expectancy;
    }

    /**
     * @return double
     */
    public function getSharpeRatio(): double
    {
        return $this->sharpeRatio;
    }

    /**
     * @return date
     */
    public function getReportDate(): date
    {
        return $this->reportDate;
    }

    /**
     * @return date
     */
    public function getProcessingDate(): date
    {
        return $this->processingDate;
    }

    // Setters {

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param int $account
     */
    public function setAccount(int $account)
    {
        $this->account = $account;
    }

    /**
     * @param int $dashmin
     */
    public function setDashmin(int $dashmin)
    {
        $this->dashmin = $dashmin;
    }

    /**
     * @param date $accountCreatedOn
     */
    public function setAccountCreatedOn(date $accountCreatedOn)
    {
        $this->accountCreatedOn = $accountCreatedOn;
    }

    /**
     * @param string $accountLabel
     */
    public function setAccountLabel(string $accountLabel)
    {
        $this->accountLabel = $accountLabel;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param string $email
     * @return void
     * @throws Exception
     */
    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address");
        }
        $this->email = $email;
    }

    /**
     * @param double $startBalance
     */
    public function setStartBalance(double $startBalance)
    {
        $this->startBalance = $startBalance;
    }

    /**
     * @param double $currentBalance
     */
    public function setCurrentBalance($currentBalance)
    {
        $this->currentBalance = currentBalance;
    }
    
    /**
     * @param double $highestBalance
     */
    public function setHighestBalance(double $highestBalance)
    {
        $this->highestBalance = $highestBalance;
    }

    /**
     * @param double $lowestBalance
     */
    public function setLowestBalance(double $lowestBalance)
    {
        $this->lowestBalance = $lowestBalance;
    }

    /**
     * @param double $dailyReturn
     */
    public function setDailyReturn(double $dailyReturn)
    {
        $this->dailyReturn = $dailyReturn;
    }

    /**
     * @param int $numTrades
     */
    public function setNumTrades(int $numTrades)
    {
        $this->numTrades = $numTrades;
    }

    /**
     * @param int $numWinTrades
     */
    public function setNumWinTrades(int $numWinTrades)
    {
        $this->numWinTrades = $numWinTrades;
    }

    /**
     * @param int $numLossTrades
     */
    public function setNumLossTrades(int $numLossTrades)
    {
        $this->numLossTrades = $numLossTrades;
    }

    /**
     * @param double $amtWinTrades
     */
    public function setAmtWinTrades(double $amtWinTrades)
    {
        $this->amtWinTrades = $amtWinTrades;
    }

    /**
     * @param double $amtLossTrades
     */
    public function setAmtLossTrades(double $amtLossTrades)
    {
        $this->amtLossTrades = $amtLossTrades;
    }

    /**
     * @param double $avgWinTradeAmt
     */
    public function setAvgWinTradeAmt(double $avgWinTradeAmt)
    {
         $this->avgWinTradeAmt = $avgWinTradeAmt;
    }

    /**
     * @param double $avgLossTradeAmt
     */
    public function setAvgLossTradeAmt(double $avgLossTradeAmt)
    {
        $this->avgLossTradeAmt = $avgLossTradeAmt;
    }

    /**
     * @param double $expectancy
     */
    public function setExpectancy(double $expectancy)
    {
        $this->expectancy = $expectancy;
    }

    /**
     * @param double $sharpeRatio
     */
    public function setSharpeRatio(double $sharpeRatio)
    {
         $this->sharpeRatio = $sharpeRatio;
    }

    /**
     * @param date $reportDate
     */
    public function setReportDate(date $reportDate)
    {
        $this->reportDate = $reportDate;
    }

    /**
     * @param date $processingDate
     */
    public function setProcessingDate(date $processingDate)
    {
        $this->processingDate = $processingDate;
    }


    /**
     * @return void
     */
    public function save(): void
    {
        if ($this->account) {
            $query = "
                UPDATE {$this->table}
                SET
                    dashmin = :dashmin,
                    account_created_on = :accountCreatedOn,
                    account_label = :accountLabel,
                    first_name = :firstName,
                    last_name = :lastName,
                    phone = :phone,
                    email = :email,
                    start_balance = :startBalance,
                    current_balance = :currentBalance,
                    highest_balance = :highestBalance,
                    lowest_balance = :lowestBalance,
                    daily_return = :dailyReturn,
                    num_trades = :numTrades,
                    num_win_trades = :numWinTrades,
                    num_loss_trades = :numLossTrades,
                    amt_win_trades = :amtWinTrades,
                    amt_loss_trades = :amtLossTrades,
                    avg_win_trade_amt = :avgWinTradeAmt,
                    avg_loss_trade_amt = :avgLossTradeAmt,
                    expectancy = :expectancy,
                    sharpe_ratio = :sharpeRatio,
                    report_date = :reportDate,
                    processing_date = :processingDate
                WHERE account = :account";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':account', $this->account);
        } else {
            $query = "
                INSERT INTO {$this->table}
                    (account, dashmin, account_created_on, account_label, first_name, last_name, phone, email, start_balance, current_balance, 
                    highest_balance, lowest_balance, daily_return, num_trades, num_win_trades, num_loss_trades, amt_win_trades, amt_loss_trades,
                    avg_win_trade_amt, avg_loss_trade_amt, expectancy, sharpe_ratio, report_date, processing_date)
                VALUES
                    (:account, :dashmin, :accountCreatedOn, :accountLabel, :firstName, :lastName, :phone, :email, :startBalance, :currentBalance, 
                    :highestBalance, :lowestBalance, :dailyReturn, :numTrades, :numWinTrades, :numLossTrades, :amtWinTrades, :amtLossTrades,
                    :avgWinTradeAmt, :avgLossTradeAmt, :expectancy, :sharpeRatio, :reportDate, :processingDate)";
            $stmt = $this->pdo->prepare($query);
        }

        $stmt->bindValue(':account', $this->account);
        $stmt->bindValue(':dashmin', $this->dashmin);
        $stmt->bindValue(':accountCreatedOn', $this->accountCreatedOn);
        $stmt->bindValue(':accountLabel', $this->accountLabel);
        $stmt->bindValue(':firstName', $this->firstName);
        $stmt->bindValue(':lastName', $this->lastName);
        $stmt->bindValue(':phone', $this->phone);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':startBalance', $this->startBalance);
        $stmt->bindValue(':currentBalance', $this->currentBalance);
        $stmt->bindValue(':highestBalance', $this->highestBalance);
        $stmt->bindValue(':lowestBalance', $this->lowestBalance);
        $stmt->bindValue(':dailyReturn', $this->dailyReturn);
        $stmt->bindValue(':numTrades', $this->numTrades);
        $stmt->bindValue(':numWinTrades', $this->numWinTrades);
        $stmt->bindValue(':numLossTrades', $this->numLossTrades);
        $stmt->bindValue(':amtWinTrades', $this->amtWinTrades);
        $stmt->bindValue(':amtLossTrades', $this->amtLossTrades);
        $stmt->bindValue(':avgWinTradeAmt', $this->avgWinTradeAmt);
        $stmt->bindValue(':avgLossTradeAmt', $this->avgLossTradeAmt);
        $stmt->bindValue(':expectancy', $this->expectancy);
        $stmt->bindValue(':sharpeRatio', $this->sharpeRatio);
        $stmt->bindValue(':reportDate', $this->reportDate);
        $stmt->bindValue(':processingDate', $this->processingDate);

        $stmt->execute();
    }

    /**
     * Load the AlveoExport from the database
     * @param int $id
     * @return AlveoExport|null
     */
    public static function load(PDO $pdo, int $id): ?self
    {
        $query = "SELECT * FROM alveo_export WHERE account = :account";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':account', $account);
        $stmt->execute();
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new self(
            $pdo,
            $data['account'],
            $data['dashmin'],
            $data['account_created_on'],
            $data['account_label'],
            $data['first_name'],
            $data['last_name'],
            $data['phone'],
            $data['email'],
            $data['start_balance'],
            $data['current_balance'],
            $data['highest_balance'],
            $data['lowest_balance'],
            $data['daily_return'],
            $data['num_trades'],
            $data['num_win_trades'],
            $data['num_loss_trades'],
            $data['amt_win_trades'],
            $data['amt_loss_trades'],
            $data['avg_win_trade_amt'],
            $data['avg_loss_trade_amt'],
            $data['expectancy'],
            $data['sharpe_ratio'],
            $data['report_date'],
            $data['processing_date']
        );
    }
}