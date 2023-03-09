<?php

namespace App\Models;

use PDO;
use Exception;

class AlveoExport
{
    private $table = 'alveo_export';
    protected $db;

    /**
     * @var int
     */
    private int $account;

    /**
     * @var int
     */
    private int $dashmin;

    /**
     * @var string|null
     */
    private ?string $accountCreatedOn = null;

    /**
     * @var string|null
     */
    private ?string $accountLabel = null;

    /**
     * @var string|null
     */
    private ?string $firstName = null;

    /**
     * @var string|null
     */
    private ?string $lastName = null;

    /**
     * @var string|null
     */
    private ?string $phone = null;

    /**
     * @var string|null
     */
    private ?string $email = null;

    /**
     * @var float|null
     */
    private ?float $startBalance = null;

    /**
     * @var float|null
     */
    private ?float $currentBalance = null;

    /**
     * @var float|null
     */
    private ?float $highestBalance = null;

    /**
     * @var float|null
     */
    private ?float $lowestBalance = null;

    /**
     * @var float|null
     */
    private ?float $dailyReturn = null;

    /**
     * @var int|null
     */
    private ?int $numTrades = null;

    /**
     * @var int|null
     */
    private ?int $numWinTrades = null;

    /**
     * @var int|null
     */
    private ?int $numLossTrades = null;

    /**
     * @var float|null
     */
    private ?float $amtWinTrades = null;

    /**
     * @var float|null
     */
    private ?float $amtLossTrades = null;

    /**
     * @var float|null
     */
    private ?float $avgWinTradeAmt = null;

    /**
     * @var float|null
     */
    private ?float $avgLossTradeAmt = null;

    /**
     * @var float|null
     */
    private ?float $expectancy = null;

    /**
     * @var float|null
     */
    private ?float $sharpeRatio = null;

    /**
     * @var string
     */
    private string $reportDate;

    /**
     * @var string
     */
    private string $processingDate;


    public function __construct(
        $db,
        $data
    ) {
        $this->db = $db;

        $this->account = (int) $data['account'];
        $this->dashmin = (int) $data['dashmin'];
        $this->accountCreatedOn = date_create_from_format('Y-m-d', $data['accountCreatedOn']) ? date_create_from_format('Y-m-d', $data['accountCreatedOn'])->format('Y-m-d') : null;
        $this->accountLabel = (string) $data['accountLabel'];
        $this->firstName = (string) $data['firstName'];
        $this->lastName = (string) $data['lastName'];
        $this->phone = (string) $data['phone'];
        $this->email = (string) $data['email'];
        $this->startBalance = (float) preg_replace('/[^0-9\.]/', '', $data['startBalance']);
        $this->currentBalance = (float) preg_replace('/[^0-9\.]/', '', $data['currentBalance']);
        $this->highestBalance = (float) $data['highestBalance'];
        $this->lowestBalance = (float) $data['lowestBalance'];
        $this->dailyReturn = (float) rtrim($data['dailyReturn'], '%');
        $this->numTrades = (int) $data['numTrades'];
        $this->numWinTrades = (int) $data['numWinTrades'];
        $this->numLossTrades = (int) $data['numLossTrades'];
        $this->amtWinTrades = (float) $data['amtWinTrades'];
        $this->amtLossTrades = (float) $data['amtLossTrades'];
        $this->avgWinTradeAmt = (float) $data['avgWinTradeAmt'];
        $this->avgLossTradeAmt = (float) $data['avgLossTradeAmt'];
        $this->expectancy = (float) $data['expectancy'];
        $this->sharpeRatio = (float) $data['sharpeRatio'];
        $this->reportDate = date_create_from_format('Y-m-d', $data['reportDate']) ? date_create_from_format('Y-m-d', $data['reportDate'])->format('Y-m-d') : null;
        $this->processingDate = date_create_from_format('Y-m-d', $data['processingDate']) ? date_create_from_format('Y-m-d', $data['processingDate'])->format('Y-m-d') : null;
    }

    // Getters {

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
     * @return DateTime|null
     */
    public function getAccountCreatedOn(): ?DateTime
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
     * @param DateTime|null $accountCreatedOn
     */
    public function setAccountCreatedOn(?DateTime $accountCreatedOn)
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
    public function setCurrentBalance(float $currentBalance)
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
        $dupQuery = "
                    SELECT COUNT(*)
                    FROM alveo_export
                    WHERE account = :account
                    AND report_date = :reportDate";
        $stmt = $this->db->prepare($dupQuery);
        $stmt->bindValue(':account', $this->account);
        $stmt->bindValue(':reportDate', $this->reportDate);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $query = "
                INSERT INTO alveo_export
                    (account, dashmin, account_created_on, account_label, first_name, last_name, phone, email, start_balance, current_balance, 
                    highest_balance, lowest_balance, daily_return, num_trades, num_win_trades, num_loss_trades, amt_win_trades, amt_loss_trades,
                    avg_win_trade_amt, avg_loss_trade_amt, expectancy, sharpe_ratio, report_date, processing_date)
                VALUES
                    (:account, :dashmin, :accountCreatedOn, :accountLabel, :firstName, :lastName, :phone, :email, :startBalance, :currentBalance, 
                    :highestBalance, :lowestBalance, :dailyReturn, :numTrades, :numWinTrades, :numLossTrades, :amtWinTrades, :amtLossTrades,
                    :avgWinTradeAmt, :avgLossTradeAmt, :expectancy, :sharpeRatio, :reportDate, :processingDate)";
            $stmt = $this->db->prepare($query);

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

    }

    /**
     * Load the AlveoExport from the database
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
