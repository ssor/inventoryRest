<?php
// 本文档自动生成，仅供测试运行
class CustomerInfoAction extends Action
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

    //查询所有客户信息
    public function FindAllCustomerInfo()
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from Customerinfo where 
                    falg = '1';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from Customerinfo where 
                        falg = '1';";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.Customer.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $customer = new Customer(
                    $list[$i]['Cus_Code'],
                    $list[$i]['Cus_Name'],
                    $list[$i]['Cus_Sex'],
                    $list[$i]['Cus_Birth'],
                    $list[$i]['Family_Num'],
                    $list[$i]['Cus_phone'],                 
                    $list[$i]['Home_Adress'],
                    $list[$i]['Cus_Level'],
                    $list[$i]['falg'],
                    $list[$i]['Remark']
                   
                    );
                //var_dump($product);
                //return;
                array_push($result,$customer);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             
    }
    public function AddCustomerInfo()
    {
         $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=json_decode($jsonInput);
        $Cus_Code=$decodedTags->Cus_Code;
        $Cus_Name=$decodedTags->Cus_Name;
        $Cus_Sex=$decodedTags->Cus_Sex;
        $Cus_Birth=$decodedTags->Cus_Birth;
        $Family_Num=$decodedTags->Family_Num;
        $Cus_phone=$decodedTags->Cus_phone;
        $Cus_Level=$decodedTags->Cus_Level;
        $Home_Adress=$decodedTags->Home_Adress;
        $Remark=$decodedTags->Remark;
        $falg=$decodedTags->falg;
        
        $sqlExecute ="insert into Customerinfo values('$Cus_Code','$Cus_Name','$Cus_Sex','$Cus_Birth','$Family_Num',
            '$Cus_phone','$Home_Adress','$Cus_Level','$falg','$Remark')";
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

    public function UpdateCustomerInfo()
    {
         $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        $decodedTags=json_decode($jsonInput);
        $Cus_Code=$decodedTags->Cus_Code;
        $Cus_Name=$decodedTags->Cus_Name;
        $Cus_Sex=$decodedTags->Cus_Sex;
        $Cus_Birth=$decodedTags->Cus_Birth;
        $Family_Num=$decodedTags->Family_Num;
        $Cus_phone=$decodedTags->Cus_phone;
        $Cus_Level=$decodedTags->Cus_Level;
        $Home_Adress=$decodedTags->Home_Adress;
        $Remark=$decodedTags->Remark;
        $falg=$decodedTags->falg;
        $state=$decodedTags->state;
        if($state=="1")
        {
           $sqlExecute ="update Customerinfo set Cus_Name='$Cus_Name',Cus_Sex='$Cus_Sex',Cus_Birth='$Cus_Birth',Family_Num='$Family_Num',
            Cus_phone='$Cus_phone',Home_Adress='$Home_Adress',Cus_Level='$Cus_Level',falg='$falg',Remark='$Remark' where Cus_Code='$Cus_Code'"; 
        }
        else if($state=="2")
        {
            $sqlExecute ="update Customerinfo set falg='2' where Cus_Code='$Cus_Code'"; 
        }
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

    public function indexCustomerInfo()
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $identify=$decodedList->num;
        $Condition=$decodedList->conditon;        
        switch ($identify) {
            case 1:
               $sql="select * from Customerinfo where Cus_Code like'%$Condition%' and falg='1'";
                break;
            case 2:
               $sql="select * from Customerinfo where Cus_Name like '%$Condition%' and falg='1'";
               break;
            case 3:
               $sql="select * from Customerinfo where Cus_Sex like '%$Condition%' and falg='1'";
               break;
            case 4:
               $sql="select * from Customerinfo where Cus_phone like '%$Condition%' and falg='1'";
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
            require_once('class.Customer.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $customer = new Customer(
                    $list[$i]['Cus_Code'],
                    $list[$i]['Cus_Name'],
                    $list[$i]['Cus_Sex'],
                    $list[$i]['Cus_Birth'],
                    $list[$i]['Family_Num'],
                    $list[$i]['Cus_phone'],                 
                    $list[$i]['Home_Adress'],
                    $list[$i]['Cus_Level'],
                    $list[$i]['falg'],
                    $list[$i]['Remark']
                   
                    );
                //var_dump($product);
                //return;
                array_push($result,$customer);
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