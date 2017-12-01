<?php 
class DB{
	private $pdo=null;
	private $dbms="mysql"; //数据库类型
	private $host="localhost"; //服务器地址
	private $name="md"; //登录账号
	private $pwd="maida6868"; //密码
	private $Basename='zhoubao'; //数据库名称
	private $result; //结果集

	function __construct($host,$name,$pwd,$Basename){

		$this->host=$host;
		$this->name=$name;
		$this->pwd=$pwd;
		$this->Basename=$Basename;
		$type=$this->dbms;
		$dbname=$this->Basename;
		$host=$this->host;
		$port= "3306";
		$dsn="$type:host=$host:{$port}; dbname=$Basename";
		$this->pdo=new PDO($dsn,$name,$pwd);
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
	 查询所有结果集
    */
	public function mysql_query_fetchAll($sql){
		if ($sql!='') {
	        $this->result=$this->pdo->query($sql);
	        $this->res = $this->result->fetchAll(PDO::FETCH_ASSOC);
	        return $this->res;
        }
	}
    /*
    执行sql语句 增删改差
    */
    public function actionsql($sql){
        if ($sql!='') {
        if ($this->pdo->exec($sql) ){
        	return 1;
        }else{
        	return 0;
        }
        
        }
    }



    /*
	添加数据
    */
    public function insert($table,$arrData) {
	    $name = $values = '';
	    $flag = $flagV = 1;
	    $true = is_array(current($arrData) );//判断是否一次插入多条数据
	    if($true) {
	        //构建插入多条数据的sql语句
	        foreach($arrData as $arr) {
	            $values .= $flag ? '(' : ',(';
	            foreach($arr as $key => $value) {
	                if($flagV) {
	                    if($flag) $name .= "$key";
	                    $values .= "'$value'";
	                    $flagV = 0;
	                } else {
	                    if($flag) $name .= ",$key";
	                    $values .= ",'$value'";
	                }
	            }
	            $values .= ') ';
	            $flag = 0;
	            $flagV = 1;
	        }
	    } else {
	        //构建插入单条数据的sql语句
	        foreach($arrData as $key => $value) {
	            if($flagV) {
	                $name = "$key";
	                $values = "('$value'";
	                $flagV = 0;
	            } else {
	                $name .= ",$key";
	                $values .= ",'$value'";
	            }
	        }
	        $values .= ") ";
	    }
	     
	    $this->sql = $strSql = "insert into $table ($name) values $values";
	    if( ($this->result = $this->pdo->exec($strSql) ) > 0 ) {
	        return $this->result;
	    }
	    return false;
	}
}


?>
