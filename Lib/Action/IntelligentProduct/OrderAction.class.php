<?php
// 本文档自动生成，仅供测试运行
class OrderAction extends Action
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
        $this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
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
    public function allOrderInfo()//所有订单信息
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from OrderSheet where Buyer='配送中心' and state in ('未受理','已受理');";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from OrderSheet where Buyer='配送中心' and state in ('未受理','已受理');";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.Order.php');
            for($i = 0;$i < count($list);$i++)
            {               
               $order = new Order(
                    $list[$i]['OrderId'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Q'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Buyer'],
                    $list[$i]['Contact'],
                    $list[$i]['DeliverAdr'],
                    $list[$i]['DeadLine'],
                    $list[$i]['ProviderName'],
                    $list[$i]['state'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    
                    );
                //var_dump($product);
                //return;
                array_push($result,$order);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             

    }

    public function selectorderinfo()//按条件查询订单信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $identify=$decodedList->num;
        $Condition=$decodedList->conditon;  
        $state=$decodedList->state;    
        if($state=="全部订单")
        {
            switch ($identify) {
            case 1:
               $sql="select * from OrderSheet where OrderId like'%$Condition%' and buyer='配送中心' ;";
                break;
            case 2:
               $sql="select * from OrderSheet where Pro_Name like '%$Condition%' and buyer='配送中心';";
               break;
            case 3:
               $sql="select * from OrderSheet where Buyer like '%$Condition%' and buyer='配送中心' ;";
               break;
            case 4:
               $sql="select * from OrderSheet where Time like '%$Condition%' and buyer='配送中心'; ";
               break;
            
            default:
                # code...
                break;
        } 
        }  
        else
        {
           switch ($identify) {
            case 1:
               $sql="select * from OrderSheet where OrderId like'%$Condition%' and state='$state' and buyer='配送中心';";
                break;
            case 2:
               $sql="select * from OrderSheet where Pro_Name like '%$Condition%' and state='$state' and buyer='配送中心';";
               break;
            case 3:
               $sql="select * from OrderSheet where Buyer like '%$Condition%' and state='$state' and buyer='配送中心';";
               break;
            case 4:
               $sql="select * from OrderSheet where Time like '%$Condition%' and state='$state' and buyer='配送中心';";
               break;
           
            default:
                # code...
                break;
        } 
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
            require_once('class.Order.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $product = new Order(
                    $list[$i]['OrderId'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Q'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Buyer'],
                    $list[$i]['Contact'],
                    $list[$i]['DeliverAdr'],
                    $list[$i]['DeadLine'],
                    $list[$i]['ProviderName'],
                    $list[$i]['state'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    
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
    public function updateOrderstate()//接受订单，修改状态
    {
         $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        //$decodedTags=json_decode($jsonInput);
        $orderid=$jsonInput;
        
        $sql="update OrderSheet set state='已受理' where OrderId='$orderid'";
        $M_update=new Model();
        $r=$M_update->execute($sql);
        if($r)
        {
             echo "ok";
        }
        else
        {
             echo "fail";
        }
    }
    public function updateOrder_chukustate()//订单出库，修改状态（待出库）
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        //$decodedTags=json_decode($jsonInput);
        $orderid=$jsonInput;
        
        $sql="update OrderSheet set state='出库处理' where OrderId='$orderid'";
        $M_update=new Model();
        $r=$M_update->execute($sql);
        if($r)
        {
             echo "ok";
        }
        else
        {
             echo "fail";
        }
    }
    public function updateOrder_Out_state()//订单出库，修改状态（出库）
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        //$decodedTags=json_decode($jsonInput);
        $orderid=$jsonInput;
        
        $sql="update OrderSheet set state='已发货' where OrderId='$orderid'";
        $M_update=new Model();
        $r=$M_update->execute($sql);
        if($r)
        {
             echo "ok";
        }
        else
        {
             echo "fail";
        }
    }
    public function addOrderinfo()
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=json_decode($jsonInput);

        $OrderId=$decodedTags->OrderId;
        $Pro_Name=$decodedTags->Pro_Name;
        $Pro_Q=$decodedTags->Pro_Q;
        $Pro_Gui=$decodedTags->Pro_Gui;
        $Buyer=$decodedTags->Buyer;
        $Contact=$decodedTags->Contact;
        $DeliverAdr=$decodedTags->DeliverAdr;
        $DeadLine=$decodedTags->DeadLine;
        $ProviderName=$decodedTags->ProviderName;
        $state=$decodedTags->state;
        $Time=$decodedTags->Time;
        $remark=$decodedTags->Remark;
        
         $sqlExecute ="insert into OrderSheet values('$OrderId','$Pro_Name','$Pro_Q','$Pro_Gui','$Buyer',
            '$Contact','$DeliverAdr','$DeadLine','$ProviderName','$state','$Time','$remark');";
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
    public function updateOrder()
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=json_decode($jsonInput);

        $OrderId=$decodedTags->OrderId;
        $Pro_Name=$decodedTags->Pro_Name;
        $Pro_Q=$decodedTags->Pro_Q;
        $Pro_Gui=$decodedTags->Pro_Gui;
        $Buyer=$decodedTags->Buyer;
        $Contact=$decodedTags->Contact;
        $DeliverAdr=$decodedTags->DeliverAdr;
        $DeadLine=$decodedTags->DeadLine;
        $ProviderName=$decodedTags->ProviderName;
        $state=$decodedTags->state;
        $Time=$decodedTags->Time;
        $remark=$decodedTags->Remark;
        
         $sqlExecute ="update OrderSheet set Pro_Name='$Pro_Name',Pro_Q='$Pro_Q',Pro_Gui='$Pro_Gui',Buyer='$Buyer',
            Contact='$Contact',DeliverAdr='$DeliverAdr',DeadLine='$DeadLine',ProviderName='$ProviderName',state='$state',Time='$Time',Remark='$remark' where OrderId='$OrderId');";
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
    public function all_Ding_OrderInfo()//所有订单信息
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from OrderSheet where Buyer='超市';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from OrderSheet where Buyer='超市';";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.Order.php');
            for($i = 0;$i < count($list);$i++)
            {               
               $order = new Order(
                    $list[$i]['OrderId'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Q'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Buyer'],
                    $list[$i]['Contact'],
                    $list[$i]['DeliverAdr'],
                    $list[$i]['DeadLine'],
                    $list[$i]['ProviderName'],
                    $list[$i]['state'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    
                    );
                //var_dump($product);
                //return;
                array_push($result,$order);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             

    }
    public function chaxunquehuo()
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedTags=json_decode($jsonInput);
        $in=$decodedTags;
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from Quehuoshuliang where Pro_Name='$in';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from Quehuoshuliang where Pro_Name='$in' ;";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.Quehuo.php');
            for($i = 0;$i < count($list);$i++)
            {               
               $order = new Quehuo(
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Que_Q'],
                    $list[$i]['time']
                    
                    
                    );
                //var_dump($product);
                //return;
                //array_push($result,$order);
            }               
        }
       echo $order->Pro_Que_Q;
        //$foo_json = json_encode($result);
        
        //echo $foo_json;
        return;             
    }
	  public function selectorderinfobystate()//按条件查询订单信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
       
        $state=$decodedList;    
       
           
               $sql="select * from OrderSheet where state like'%$state%' and Buyer='超市'";
   
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.Order.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $product = new Order(
                    $list[$i]['OrderId'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Q'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Buyer'],
                    $list[$i]['Contact'],
                    $list[$i]['DeliverAdr'],
                    $list[$i]['DeadLine'],
                    $list[$i]['ProviderName'],
                    $list[$i]['state'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    
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
	 public function selectorderinfobystateP()//按条件查询订单信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
       
        $state=$decodedList;    
       
           
               $sql="select * from OrderSheet where state like'%$state%' and Buyer='配送中心'";
   
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.Order.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $product = new Order(
                    $list[$i]['OrderId'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Q'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Buyer'],
                    $list[$i]['Contact'],
                    $list[$i]['DeliverAdr'],
                    $list[$i]['DeadLine'],
                    $list[$i]['ProviderName'],
                    $list[$i]['state'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    
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
	 public function updateOrderstate3()
    {
         $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        //$decodedTags=json_decode($jsonInput);
        $orderid=$jsonInput;
        
        $sql="update OrderSheet set state='已签收' where OrderId='$orderid'";
        $M_update=new Model();
        $r=$M_update->execute($sql);
        if($r)
        {
             echo "ok";
        }
        else
        {
             echo "fail";
        }
    }
	  public function updateOrderstate2()
    {
         $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        //$decodedTags=json_decode($jsonInput);
        $orderid=$jsonInput;
        
        $sql="update OrderSheet set state='已发货' where OrderId='$orderid'";
        $M_update=new Model();
        $r=$M_update->execute($sql);
        if($r)
        {
             echo "ok";
        }
        else
        {
             echo "fail";
        }
    }
}
?>