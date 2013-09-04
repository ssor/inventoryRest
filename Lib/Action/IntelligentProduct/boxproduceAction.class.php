<?php
// 本文档自动生成，仅供测试运行
class boxproduceAction extends Action
{
    // http://localhost:9002/index.php/Inventory/Demo/demo1
    //http://localhost:9003/index.php/dazong/practise/pre
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
   
    public function index()
    {
        $this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
    }
    //检验编码是否存在
    public function isexist()
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=$jsonInput;
        $sqlselect="select * from boxProduce where Pro_code='$decodedTags'";
        $M=new Model();
        $r=$M->query($sqlselect);
        if($r)
        {
            echo "true";
        }
        else
        {
            echo "false";
        }
    }

    //查询库内标签信息
    public function Find_code_Info()
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from boxProduce where 
                    falg = '1';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from boxProduce where 
                        falg = '1';";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.MenuNewProducing.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $product = new MenuNewProducing(
                    $list[$i]['Pro_code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_state'],
                    $list[$i]['Pro_Pici'],
                    $list[$i]['Pro_Chej'],
                    $list[$i]['Pro_Person'],
                    $list[$i]['Contact'],
                    $list[$i]['Remark'],
                    $list[$i]['Pro_Tempre'],
                    $list[$i]['Pro_Wet'],
                    $list[$i]['finishTime'],
                    $list[$i]['falg']
                    );
                //var_dump($product);
                //return;
                array_push($result,$product);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             
    }
    public function add_New_Code()
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=json_decode($jsonInput);

        $code=$decodedTags->Pro_code;
        $name=$decodedTags->Pro_Name;
        $Leibie=$decodedTags->Pro_Leibie;
        $guige=$decodedTags->Pro_Gui;
        $state=$decodedTags->Pro_state;
        $Pro_Pici=$decodedTags->Pro_Pici;
        $Pro_Chej=$decodedTags->Pro_Chej;
        $Pro_Person=$decodedTags->Pro_Person;
        $contact=$decodedTags->Contact;
        $remark=$decodedTags->Remark;
        $Pro_Tempre=$decodedTags->Pro_Tempre;
        $Pro_Wet=$decodedTags->Pro_Wet;
        $falg=$decodedTags->falg;
        $finishtime=$decodedTags->finishTime;
        
        
       
        $sqlExecute ="insert into boxProduce (Pro_code,Pro_Name,Pro_Leibie,Pro_Gui,Pro_State,Pro_Pici,Pro_Chej,Pro_Person,Contact,Remark,Pro_Tempre,Pro_Wet,finishTime,falg)
            values('$code','$name','$Leibie','$guige','$state','$Pro_Pici','$Pro_Chej','$Pro_Person','$contact','$remark','$Pro_Tempre','$Pro_Wet','$finishtime','$falg')";
        $M=new Model();
        $r = $M->execute($sqlExecute);
        
        

        if ($r) {
            echo "ok";
            
        }
        else
        {
            echo "fail";
        }

    }
    public function Put_toProduce()//推送入毛坯库
    {
        $sql="select * from boxProduce where falg='1'";   
        $sqlupdate="update boxProduce set Pro_state='待生产',falg='2'  where falg='1'";
        $M=new Model();
        $r = $M->query($sql);       
        if ($r) {
            $M->execute($sqlupdate);
            echo "ok";    
        }
        else
        {
            echo "fail";
        }

    }
   
    //查询待生产产品信息
     public function FindProducingInfo()
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from boxProduce where 
                    falg = '2';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from boxProduce where 
                        falg = '2';";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.MenuNewProducing.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $product = new MenuNewProducing(
                    $list[$i]['Pro_code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_state'],
                    $list[$i]['Pro_Pici'],
                    $list[$i]['Pro_Chej'],
                    $list[$i]['Pro_Person'],
                    $list[$i]['Contact'],
                    $list[$i]['Remark'],
                    $list[$i]['Pro_Tempre'],
                    $list[$i]['Pro_Wet'],
                    $list[$i]['finishTime'],
                    $list[$i]['falg']
                    );
                //var_dump($product);
                //return;
                array_push($result,$product);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             
    }

    public function updateProducedData()//更新生成完成的产品信息
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=json_decode($jsonInput);

        $code=$decodedTags->Pro_code;
        $name=$decodedTags->Pro_Name;
        $Leibie=$decodedTags->Pro_Leibie;
        $guige=$decodedTags->Pro_Gui;
        $state=$decodedTags->Pro_state;
        $Pro_Pici=$decodedTags->Pro_Pici;
        $Pro_Chej=$decodedTags->Pro_Chej;
        $Pro_Person=$decodedTags->Pro_Person;
        $contact=$decodedTags->Contact;
        $remark=$decodedTags->Remark;
        $Pro_Tempre=$decodedTags->Pro_Tempre;
        $Pro_Wet=$decodedTags->Pro_Wet;
        $falg=$decodedTags->falg;
        $finishtime=$decodedTags->finishTime;

        $sqlExecute ="update boxProduce set Pro_state='生产完成',Pro_Tempre='$Pro_Tempre',Pro_Wet='$Pro_Wet',finishTime='$finishtime',falg='3' where Pro_code='$code'";
        $M=new Model();
        $r = $M->query($sqlExecute);
        
        if ($r) {
            echo "ok";
            
        }
        else
        {
            echo "fail";
        }
    }

     //查询生产完成商品
      public function FindProduceddata()
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from boxProduce where 
                    falg = '3';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from boxProduce where 
                        falg = '3';";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.MenuNewProducing.php');
            for($i = 0;$i < count($list);$i++)
            {               
               $product = new MenuNewProducing(
                    $list[$i]['Pro_code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_state'],
                    $list[$i]['Pro_Pici'],
                    $list[$i]['Pro_Chej'],
                    $list[$i]['Pro_Person'],
                    $list[$i]['Contact'],
                    $list[$i]['Remark'],
                    $list[$i]['Pro_Tempre'],
                    $list[$i]['Pro_Wet'],
                    $list[$i]['finishTime'],
                    $list[$i]['falg']
                    );
                //var_dump($product);
                //return;
                array_push($result,$product);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             
    }
    public function indexdata()//按条件查询产成品信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $identify=$decodedList->num;
        $Condition=$decodedList->conditon;        
        switch ($identify) {
            case 1:
               $sql="select * from boxProduce where Pro_code like'%$Condition%' and falg='3'";
                break;
            case 2:
               $sql="select * from boxProduce where Pro_Name like '%$Condition%' and falg='3'";
               break;
            case 3:
               $sql="select * from boxProduce where Pro_Leibie like '%$Condition%' and falg='3'";
               break;
            case 4:
               $sql="select * from boxProduce where Pro_Chej like '%$Condition%' and falg='3'";
               break;
            default:
                # code...
                break;
        }
        /*
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from Product;";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from Product ;";
            }
            */
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
      if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.MenuNewProducing.php');
            for($i = 0;$i < count($list);$i++)
            {               
               $product = new MenuNewProducing(
                    $list[$i]['Pro_code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_state'],
                    $list[$i]['Pro_Pici'],
                    $list[$i]['Pro_Chej'],
                    $list[$i]['Pro_Person'],
                    $list[$i]['Contact'],
                    $list[$i]['Remark'],
                    $list[$i]['Pro_Tempre'],
                    $list[$i]['Pro_Wet'],
                    $list[$i]['finishTime'],
                    $list[$i]['falg']
                    );
                //var_dump($product);
                //return;
                array_push($result,$product);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             
    }
    public function index_inventory_data()//按条件查询产成品信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $identify=$decodedList->num;
        $Condition=$decodedList->conditon;        
        switch ($identify) {
            case 1:
               $sql="select * from boxProduce where Pro_code like'%$Condition%' and falg='4'";
                break;
            case 2:
               $sql="select * from boxProduce where Pro_Name like '%$Condition%' and falg='4'";
               break;
            case 3:
               $sql="select * from boxProduce where Pro_Leibie like '%$Condition%' and falg='4'";
               break;
            case 4:
               $sql="select * from boxProduce where Pro_Chej like '%$Condition%' and falg='4'";
               break;
            default:
                # code...
                break;
        }
        /*
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from Product;";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from Product ;";
            }
            */
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
      if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.MenuNewProducing.php');
            for($i = 0;$i < count($list);$i++)
            {               
               $product = new MenuNewProducing(
                    $list[$i]['Pro_code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_state'],
                    $list[$i]['Pro_Pici'],
                    $list[$i]['Pro_Chej'],
                    $list[$i]['Pro_Person'],
                    $list[$i]['Contact'],
                    $list[$i]['Remark'],
                    $list[$i]['Pro_Tempre'],
                    $list[$i]['Pro_Wet'],
                    $list[$i]['finishTime'],
                    $list[$i]['falg']
                    );
                //var_dump($product);
                //return;
                array_push($result,$product);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             
    }
    public function loadinventory()
    {
        $jsonInput = file_get_contents("php://input");
        
        $sqlupdate="update boxProduce set Pro_state='已入库',falg='4' ,RukuTime='$jsonInput' where falg='3'";
        $M_update=new Model();
        $r=$M_update->execute($sqlupdate);
        if($r)
        {
            echo "ok";
        }
        else
        {
            echo "fail";
        }

    }
    public function product_chuku()//产品出库记录
    {
        $jsonInput = file_get_contents("php://input");
        $epc=$jsonInput;
        $datetime=date('Y-m-d H:i:s',time());

        $sqlupdate="update boxProduce set Pro_state='已出库',falg='5',ChuKuTime='$datetime' where Pro_code='$epc' and falg='4'";
        $M_update=new Model();
        $r=$M_update->execute($sqlupdate);
        if($r)
        {
            echo "ok";
        }
        else
        {
            echo "fail";
        }

    }
public function FindInventoryInfo()
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from boxProduce where 
                    falg = '4';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from boxProduce where 
                        falg = '4';";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.MenuNewProducing.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $product = new MenuNewProducing(
                    $list[$i]['Pro_code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_state'],
                    $list[$i]['Pro_Pici'],
                    $list[$i]['Pro_Chej'],
                    $list[$i]['Pro_Person'],
                    $list[$i]['Contact'],
                    $list[$i]['Remark'],
                    $list[$i]['Pro_Tempre'],
                    $list[$i]['Pro_Wet'],
                    $list[$i]['finishTime'],
                    $list[$i]['RukuTime'],
                    $list[$i]['ChuKuTime'],
                    $list[$i]['falg']
                    );
                //var_dump($product);
                //return;
                array_push($result,$product);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             
    }
      
      public function Findpro_Q()
    {
        $jsonInput = file_get_contents("php://input");
        $decodedList = json_decode($jsonInput);
        $id=$decodedList;
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select Pro_Name from boxProduce where 
            Pro_Name='$id' and falg='4';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select  Pro_Name from boxProduce where 
            Pro_Name='$id' and falg='4';";
            }
        $M=new Model();
        $list = $M->query($sql);
        $ct=count($list);

        echo $ct;
        
        return;             
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