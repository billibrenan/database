<?class DB {

    protected static $_instance;  //экземпляр объекта

    public static function getInstance() { // получить экземпляр данного класса
        if (self::$_instance === null) { // если экземпляр данного класса  не создан
            self::$_instance = new self;  // создаем экземпляр данного класса
        }
        return self::$_instance; // возвращаем экземпляр данного класса
    }

    private  function __construct() { // конструктор отрабатывает один раз при вызове DB::getInstance();
        echo "<br/><em>1.  Connection";
        //подключаемся к БД
        $this->connect = mysql_connect(HOST, USER, PASSWORD) or die("Невозможно установить соединение".mysql_error());
        // выбираем таблицу
        echo "<br/>2.  Choose a base";
        mysql_select_db(NAME_BD, $this->connect) or die ("Невозможно выбрать указанную базу".mysql_error());
        // устанавливаем кодировку таблицы
        echo "<br/>3.  Utf 8 code ";
        $this->query('SET names "utf8"');
        echo "<br/> Ok ok ok ok ok</em>";

    }

    private function __clone() { //запрещаем клонирование объекта модификатором private
    }

    private function __wakeup() {//запрещаем клонирование объекта модификатором private
    }

    public static function query($sql) {

        $obj=self::$_instance;

        if(isset($obj->connect)){
            $obj->count_sql++;
            $start_time_sql = microtime(true);
            $result=mysql_query($sql)or die("<br/><span style='color:red'>Error in SQL query</span> ".mysql_error());
            $time_sql = microtime(true) - $start_time_sql;
            echo "<br/><br/><span style='color:blue'> <span style='color:green'># qUER ".$obj->count_sql.": </span>".$sql."</span> <span style='color:green'>(".round($time_sql,4)." msec )</span>";

            return $result;
        }
        return false;
    }

    //возвращает запись в виде объекта
    public static function fetch_object($object)
    {
        return @mysql_fetch_object($object);
    }

    //возвращает запись в виде массива
    public static function fetch_array($object)
    {
        return @mysql_fetch_array($object);
    }

    //mysql_insert_id() возвращает ID,
    //сгенерированный колонкой с AUTO_INCREMENT последним запросом INSERT к серверу
    public static function insert_id()
    {
        return @mysql_insert_id();
    }


}
