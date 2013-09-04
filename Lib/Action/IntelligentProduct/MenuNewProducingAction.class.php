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

    //查询待生产产品信息
    public function isexist()
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=$jsonInput;
        $sql="select '$decodedTags' from boxProduce  ";
        $M=new Model();
        $r=$M->execute($sql);
        if ($r) {
            echo "true";
        }
        else{echo "false";}

    }

    public function Find_TagInfo()
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from NewProducing where 
                    falg = '1';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from NewProducing where 
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
    //查询生产完成商品
      public function FindProduceddata()//查询待生产产品信息
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from NewProducing where 
                    falg = '2';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from NewProducing where 
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
    //添加数据
    public function loaddata()//添加待生产产品信息
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=json_decode($jsonInput);
        $code=$decodedTags->Pro_code;
        $name=$decodedTags->Pro_Name;
        $guige=$decodedTags->Pro_Gui;
        $order=$decodedTags->Pro_Order;
        $state=$decodedTags->Pro_state;
        $time=$decodedTags->Pro_Time;
        $company=$decodedTags->Pro_Company;
        $contact=$decodedTags->Contact;
        $remark=$decodedTags->Remark;
        $falg=$decodedTags->falg;
        $finishtime=$decodedTags->finishTime;
        $sqlExecute ="insert into Producing (Pro_code,Pro_Name,Pro_Gui,Pro_Order,Pro_State,Pro_Time,Pro_Company,Contact,Remark,falg,finishTime)
            values('$code','$name','$guige','$order','$state','$time','$company','$contact','$remark','$falg','$finishtime')";
        $M=new Model();
        $r = $M->execute($sqlExecute);
        
        

        if ($r) {
            echo "ok";
            
        }
        else
        {
            echo "fail";
        }




        /*$decodedTags->Pro_code="3333";
        $foo_json=json_encode($decodedTags);

        echo $foo_json;
        */



    }
    public function updateData()//更新生成完成的产品信息
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=json_decode($jsonInput);
        $code=$decodedTags->Pro_code;
        $name=$decodedTags->Pro_Name;
        $leibie=$decodedTags->Pro_Leibie;
        $guige=$decodedTags->Pro_Gui;
        $order=$decodedTags->Pro_Order;
        $state=$decodedTags->Pro_state;
        $pici=$decodedTags->Pro_Pici;
        $chej=$decodedTags->Pro_Chej;
        $person=$decodedTags->Pro_Person;
        $contact=$decodedTags->Contact;
        $remark=$decodedTags->Remark;
        $falg=$decodedTags->falg;
        $finishtime=$decodedTags->finishTime;
        $Pro_Tempre=$decodedTags->Pro_Tempre;
        $Pro_Wet=$decodedTags->Pro_Wet;
        require_once('class.MenuNewProducing.php');
        $product = new MenuNewProducing();
        $sqlupdate="update NewProducing set Pro_state='生产完成',falg='2' ,finishTime='$finishtime',Pro_Tempre='$Pro_Tempre',Pro_Wet='$Pro_Wet' where Pro_code='$code'";
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
    public function indexdata()//按条件查询产成品信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $identify=$decodedList->num;
        $Condition=$decodedList->conditon;        
        switch ($identify) {
            case 1:
               $sql="select * from Producing where Pro_code like'%$Condition%' and falg='2'";
                break;
            case 2:
               $sql="select * from Producing where Pro_Name like '%$Condition%' and falg='2'";
               break;
            case 3:
               $sql="select * from Producing where Pro_Order like '%$Condition%' and falg='2'";
               break;
            case 4:
               $sql="select * from Producing where Pro_Company like '%$Condition%' and falg='2'";
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
            require_once('class.NewProducing.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $product = new NewProducing(
                    $list[$i]['Pro_code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_Order'],
                    $list[$i]['Pro_state'],
                    $list[$i]['Pro_Time'],
                    $list[$i]['Pro_Company'],
                    $list[$i]['Contact'],
                    $list[$i]['Remark'],
                    $list[$i]['falg'],
                    $list[$i]['finishTime']
                    
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