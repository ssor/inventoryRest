<?php
// 本文档自动生成，仅供测试运行
class DemoAction extends Action
{
    // http://localhost:9002/index.php/Inventory/Demo/demo1
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
        $this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
    }
    public function demo1()
    {
        // echo "demo1";
        require_once('class.jsonClass.php');
        $jc = new jsonClass("zhang","21");
        $foo_json = json_encode($jc);
        
        echo $jc->name;
    }
    public function demo2()
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedOrder=json_decode($jsonInput);
        
        $name = $decodedOrder->name;
        $age = $decodedOrder->age;
        require_once('class.jsonClass.php');
        $jc = new jsonClass($name,"21");
        $foo_json = json_encode($jc);
        
        echo $foo_json;
    }
    /**
    +----------------------------------------------------------
    * 探针模式
    +----------------------------------------------------------
    */
    public function checkEnv()
    {
        load('pointer',THINK_PATH.'/Tpl/Autoindex');//载入探针函数
        $env_table = check_env();//根据当前函数获取当前环境
        echo $env_table;
    }

}
?>