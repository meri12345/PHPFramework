<?php


namespace app\core;


class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo=new \PDO($dsn,$user,$password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_WARNING);
    }
    public function applyMigration(){
        $this->createMigrationTable();
        $getAppliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR."/migrations");
        $toApplyMigrations = array_diff($files,$getAppliedMigrations);

        foreach ($toApplyMigrations as $migration){
            if($migration==='..'||$migration==='.'){
                continue;
            }
            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
           $className = pathinfo($migration,PATHINFO_FILENAME);
           $instance = new $className;
           $this->log("Applying migration $migration");
           $instance->up();
           $this->log("$migration applied");
           $newMigrations[]=$migration;
        }
        if(!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }
        else{
            $this->log("All migrations are applied");
        }
    }

    public function createMigrationTable(){
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY ,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        )");
    }

    private function getAppliedMigrations()
    {
        $statement=$this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations){
        $migrations=implode(',',array_map(fn($m)=>"('$m')",$migrations));
        $statement=$this->pdo->prepare("INSERT INTO migrations (migration) VALUES $migrations");
        $statement->execute();
    }

    protected function log($message){
        echo '['.date('Y-m-d H:i:s').'] - '.$message . PHP_EOL;

    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}