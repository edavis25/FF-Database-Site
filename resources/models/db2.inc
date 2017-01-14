<?php
class DB
{
	// The database connection
    protected static $connection;
	
	public function connect() 
	{    
        // Try and connect to the database
        if(!isset(self::$connection)) 
        {
            self::$connection = mysqli_connect('localhost', 'Read_User', 'readOnly', 'ffdatabase') or die('Error connecting to MySQL server.');
        }

        // If connection was not successful, handle the error
        if(self::$connection === false) 
        {
            // TODO Handle error
            return false;
        }
        return self::$connection;
    }
	
	
	public function query($query) 
	{
        // Connect to the database
        $connection = $this -> connect();

        // Query the database
        $result = $connection -> query($query);

        return $result;
    }
	
	
	/**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query) 
    {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) 
        {
            return false;
        }
        while ($row = $result -> fetch_assoc()) 
        {
            $rows[] = $row;
        }
        //return sizeof($rows[0]);
        return $rows;
    }
}
