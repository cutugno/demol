<?php
    abstract class Database_Object
    {
        protected static $DB_Name;
        protected static $DB_Open;
        protected static $DB_Conn;

			
		

        protected function __construct($database, $hostname, $username, $password, $port)
        {
            self::$DB_Name = $database;
            self::$DB_Conn = new mysqli($hostname, $username, $password, $database, $port);
            
        }

        private function __clone() {}

        public function __destruct()
        {
//            mysqli_close(self::$DB_Conn);  <-- commented out due to current shared-link close 'feature'.  If left in, causes a warning that this is not a valid link resource.
        }
    }

    final class DB extends Database_Object
    {
        public static function Open($database = DB_NAME, $hostname = DB_HOST, $username = DB_USER, $password = DB_PASS, $port = DB_PORT)
        {
            if (!self::$DB_Open)
            {
                self::$DB_Open = new self($database, $hostname, $username, $password, $port);
            }
            else
            {
                self::$DB_Open = null;
                self::$DB_Open = new self($database, $hostname, $username, $password, $port);
            }
            return self::$DB_Open;
        }

        public function qry($sql, $return_format = 0)
        {
            $query = mysqli_query(self::$DB_Conn, $sql) OR die("Errore database $sql <br> ".self::$DB_Conn->error);
            switch ($return_format)
            {
                case 1:
                    $query = mysqli_fetch_row($query);
                    return $query;
                    break;
                case 2:
                    $query = mysqli_fetch_array($query);
                    return $query;
                    break;
                case 3:
                    $query = mysqli_fetch_row($query);
                    $query = $query[0];
                    return $query;
                default:
					return $query;
            }
        }
        public function insert($sql) {
        	mysqli_query(self::$DB_Conn, $sql) OR die("$sql <br> ".mysqli_error(self::$DB_Conn));
        	mysqli_set_charset("utf8");
        	return self::$DB_Conn->insert_id;
        }
        public function update($sql) {
        	mysqli_query(self::$DB_Conn, $sql) OR die("$sql <br> ".mysqli_error(self::$DB_Conn));
        	return self::$DB_Conn->affected_rows;
        }
        public function date2db($day) {
			return substr($day,6)."-".substr($day,3,2)."-".substr($day,0,2);
		}
			
		public function numrs($sql) {
			$query=mysqli_query(self::$DB_Conn, $sql) OR die("$sql <br> ".mysqli_error(self::$DB_Conn));
			$query=mysqli_num_rows($query);
			return $query;
		}
    }
?>
