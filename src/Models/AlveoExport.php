<?php

namespace App\Models;
use Exception;

class AlveoExport
{
    private $table = 'alveo_export';
    protected $db;

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
     * @var float
     */
    private $startBalance;

    /**
     * @var float
     */
    private $currentBalance;

    /**
     * @var float
     */
    private $highestBalance;

    /**
     * @var float
     */
    private $lowestBalance;

    /**
     * @var float
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
     * @var float
     */
    private $amtWinTrades;

    /**
     * @var float
     */
    private $amtLossTrades;

    /**
     * @var float
     */
    private $avgWinTradeAmt;

    /**
     * @var float
     */
    private $avgLossTradeAmt;

    /**
     * @var float
     */
    private $expectancy;

    /**
     * @var float
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

    public function __construct($db) {
        $this->db = $db;
    }
/*
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
        float $startBalance,
        float $currentBalance,
        float $highestBalance,
        float $lowestBalance,
        float $dailyReturn,
        int $numTrades,
        int $numWinTrades,
        int $numLossTrades,
        float $amtWinTrades,
        float $amtLossTrades,
        float $avgWinTradeAmt,
        float $avgLossTradeAmt,
        float $expectancy,
        float $sharpeRatio,
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
    }*/

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
     * @return float
     */
    public function getStartBalance(): float
    {
        return $this->startBalance;
    }

    /**
     * @return float
     */
    public function getCurrentBalance(): float
    {
        return $this->currentBalance;
    }
    
    /**
     * @return float
     */
    public function getHighestBalance(): float
    {
        return $this->highestBalance;
    }

    /**
     * @return float
     */
    public function getLowestBalance(): float
    {
        return $this->lowestBalance;
    }

    /**
     * @return float
     */
    public function getDailyReturn(): float
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
     * @return float
     */
    public function getAmtWinTrades(): float
    {
        return $this->amtWinTrades;
    }

    /**
     * @return float
     */
    public function getAmtLossTrades(): float
    {
        return $this->amtLossTrades;
    }

    /**
     * @return float
     */
    public function getAvgWinTradeAmt(): float
    {
        return $this->avgWinTradeAmt;
    }

    /**
     * @return float
     */
    public function getAvgLossTradeAmt(): float
    {
        return $this->avgLossTradeAmt;
    }

    /**
     * @return float
     */
    public function getExpectancy(): float
    {
        return $this->expectancy;
    }

    /**
     * @return float
     */
    public function getSharpeRatio(): float
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
     * @param float $startBalance
     */
    public function setStartBalance(float $startBalance)
    {
        $this->startBalance = $startBalance;
    }

    /**
     * @param float $currentBalance
     */
    public function setCurrentBalance($currentBalance)
    {
        $this->currentBalance = $currentBalance;
    }
    
    /**
     * @param float $highestBalance
     */
    public function setHighestBalance(float $highestBalance)
    {
        $this->highestBalance = $highestBalance;
    }

    /**
     * @param float $lowestBalance
     */
    public function setLowestBalance(float $lowestBalance)
    {
        $this->lowestBalance = $lowestBalance;
    }

    /**
     * @param float $dailyReturn
     */
    public function setDailyReturn(float $dailyReturn)
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
     * @param float $amtWinTrades
     */
    public function setAmtWinTrades(float $amtWinTrades)
    {
        $this->amtWinTrades = $amtWinTrades;
    }

    /**
     * @param float $amtLossTrades
     */
    public function setAmtLossTrades(float $amtLossTrades)
    {
        $this->amtLossTrades = $amtLossTrades;
    }

    /**
     * @param float $avgWinTradeAmt
     */
    public function setAvgWinTradeAmt(float $avgWinTradeAmt)
    {
         $this->avgWinTradeAmt = $avgWinTradeAmt;
    }

    /**
     * @param float $avgLossTradeAmt
     */
    public function setAvgLossTradeAmt(float $avgLossTradeAmt)
    {
        $this->avgLossTradeAmt = $avgLossTradeAmt;
    }

    /**
     * @param float $expectancy
     */
    public function setExpectancy(float $expectancy)
    {
        $this->expectancy = $expectancy;
    }

    /**
     * @param float $sharpeRatio
     */
    public function setSharpeRatio(float $sharpeRatio)
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
    public static function load(PDO $pdo, int $account): ?self
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
