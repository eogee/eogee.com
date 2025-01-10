<?php

class CreateEmailQueueTable
{
    protected $tableName = 'emailQueue';

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS $this->tableName (
            id INT AUTO_INCREMENT PRIMARY KEY,
            recipient_email VARCHAR(255) NOT NULL,
            subject VARCHAR(255) NOT NULL,
            message TEXT NOT NULL,
            status ENUM('pending', 'sent', 'failed') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE= InnoDB DEFAULT CHARSET=utf8;
        ";
        $this->executeQuery($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS $this->tableName;";
        $this->executeQuery($sql);
    }

    private function executeQuery($sql)
    {
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Query executed successfully.\n";
        } else {
            echo "Error executing query: " . $this->mysqli->error . "\n";
        }
    }
}