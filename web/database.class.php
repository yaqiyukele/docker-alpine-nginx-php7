<?php
/**
* 连接数据库及操作
*/
class linkMysql{
    private $pdo=null;
    private $dbms="mysql"; //数据库类型
    private $host="localhost"; //服务器地址
    private $name="root"; //登录账号
    private $pwd="root"; //密码
    private $Basename; //数据库名称
    private $result; //结果集
    function __construct($host,$name,$pwd,$Basename){
        // $this->dbh->query("SET NAMES 'UTF8'");  
        // $this->dbh->query("SET TIME_ZONE = '+8:00'");

        $this->host=$host;
        $this->name=$name;
        $this->pwd=$pwd;
        $this->Basename=$Basename;
        $type=$this->dbms;
        $dbname=$this->Basename;
        $host=$this->host;
        $port= "3306";
        $dsn="$type:host=$host:{$port}; dbname=$dbname";
        $this->pdo=new PDO($dsn,$this->name,$this->pwd);
        try{ 
        $sql=" SET NAMES 'utf8'";
        if ($this->pdo-> query($sql)==false) {
            echo "<script>alert('失败');</script>";
        }
        }catch(Exception $e){
            echo $e->getMessage()."<br>";
        }
    }
    /*
    获取结果集
    */
    public function get_result(){
        return $this->result;
    }
    /*
    查询结果集
    */
    public function mysql_query_rest($sql){
        if ($sql!='') {
        $this->result=$this->pdo->query($sql);
        $this->res = $this->result->fetch(PDO::FETCH_ASSOC);
        return $this->res;
        }
    }
    /*
    执行sql语句 增删改差
    */
    public function actionsql($sql){
        if ($sql!='') {
        if ($this->pdo->exec($sql) )
        return true;
        else
        return false;
        }
    }

 
}
   
?>