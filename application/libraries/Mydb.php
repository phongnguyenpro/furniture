<?php

class Mydb extends PDO
{
     
    public function __construct()
    {
        if ( ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/database.php')
			&& ! file_exists($file_path = APPPATH.'config/database.php'))
		{
			show_error('The configuration file database.php does not exist.');
		}
		include($file_path);
                $db=$db["default"];
        parent::__construct( "mysql". ':host=' . $db['hostname'] . ';dbname=' . $db["database"], $db["username"], $db["password"], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value, PDO::PARAM_STR);
        }

        $sth->execute();
        $kq = $sth->fetchAll($fetchMode);
        return $kq;

    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data)
    {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
        return array('row' => $sth->rowCount(), 'id' => $this->lastInsertId());
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    function update($table, $data, $where, $datawhere)
    {
        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");


        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        foreach ($datawhere as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
        return array('row' => $sth->rowCount());

    }

    /**
     * delete
     *
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    function delete($table, $where, $datawhere, $limit = 1)
    {
        $stmt = $this->prepare("DELETE FROM $table WHERE $where LIMIT $limit");
        foreach ($datawhere as $key => $value) {
            $stmt->bindValue(":$key",$value);
        }
        $stmt->execute();
        return array('row' => $stmt->rowCount(),);
    }

    function deleteall($table, $where, $datawhere)
    {

        $stmt = $this->prepare("DELETE FROM $table WHERE $where");
        foreach ($datawhere as $key => $value) {
            $stmt->bindValue(":$key",$value);
        }
        $stmt->execute();
        return array('row' => $stmt->rowCount());
    }

    function exec($sql)
    {
        return parent::exec($sql);
    }
}