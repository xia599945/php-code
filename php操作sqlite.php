class Sqlite extends SQLite3{
    function __construct($db_name=''){
        $db_name=preg_match('/[^\w\.]+/',$db_name)>0 ? false : $db_name;
        if($db_name==''){
            exit('请输入数据库名称');
        }else if($db_name===false){
            exit('数据库名称有误(只能使用大小写字母、数字、点和下划线组合)');
        }else{
            $this->open("{$db_name}.db");
        }
    }
    function run($q){
        $q=$this->escapeString($q);
        $this->exec($q);
        $data=array();
        if($this->lastErrorCode()){
            $data[0]=false;
            $data[1]=$this->lastErrorMsg();
            return $data;
        }
        $data[0]=true;
        $data[1]=$this->changes();
        return $data;
    }
    function select($q){
        $q=$this->escapeString($q);
        $d=$this->query($q);
        $data=array();
        if($this->lastErrorCode()){
            $data[0]=false;
            $data[1]=$this->lastErrorMsg();
            return $data;
        }
        $data[0]=true;
        while($tmp=$d->fetchArray(SQLITE3_ASSOC)){
            $data[1][]=$tmp;
        }
        if(!isset($data[1])){
            $data[1]=[];
        }
        return $data;
    }
    function __destruct(){
        $this->close();
    }
}
