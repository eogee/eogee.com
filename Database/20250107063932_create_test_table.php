<?php

class CreateTestTable
{
    protected $tableName = 'test';

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function up()
    {
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS $this->tableName (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;
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
            echo "Query executed successfully.";
        } else {
            echo "Error executing query: " . $this->mysqli->error . "";
        }
    }
}