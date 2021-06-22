<?php
namespace core;
/**
 *Database class
*/

class Database extends \PDO
{
    protected $table = 'events';
    private $condition = '';
    private $value = '';
    private $placeholder = '';
    private $result;

    function __construct()
    {
        parent::__construct(DSN, DB_USER, DB_PASS);
        $this->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }


    public function all()
    {
        $statement = $this->prepare("SELECT * FROM {$this->table}");
        $statement->execute();
        return $statement->fetchAll();
    }


    public function count()
    {
        return count($this->result);
    }


    public function get()
    {
        if(empty($this->condition)){
            $statement = $this->prepare("SELECT * FROM {$this->table}");
        }else{
            $statement = $this->prepare("SELECT * FROM {$this->table} WHERE {$this->condition}");
            $statement->bindValue($this->placeholder,$this->value);
        }
        $statement->execute();
        $this->result = $statement->fetchAll(\PDO::FETCH_OBJ);
        return $this->result;
    }



    public function create($data = [])
    {
        $attributes = array_keys($data);
        $fields     = implode(',',$attributes);
        $params     = implode(',',array_map(fn($attr)=>":$attr" ,$attributes));
        $sql        = "INSERT INTO $this->table($fields) VALUES($params)";
        $statement  = self::prepare($sql);
        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute",$data[$attribute]);
        }
        $statement->execute();
        return true;
    }


    public function where($field,$operator = '=',$value)
    {
        $this->value = $value;
        $this->placeholder = ":{$field}";
        $this->condition = "{$field} {$operator} :{$field}";
        return $this;
    }



    public function createEventsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `events` (
          `id` bigint(11) NOT NULL,
          `title` varchar(255) DEFAULT NULL,
          `description` text DEFAULT NULL,
          `start` int(11) NOT NULL,
          `end` int(11) NOT NULL,
          `all_day` tinyint(1) NOT NULL DEFAULT 0,
          `admin_id` int(11) NOT NULL,
          `recur_id` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        return $this->exec($sql);
    }


}
