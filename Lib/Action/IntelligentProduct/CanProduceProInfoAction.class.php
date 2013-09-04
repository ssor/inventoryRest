<?php
// 本文档自动生成，仅供测试运行
class CanProduceProInfoAction extends Action
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
    public function allProductsInfo()//所有产品信息
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from CanProduceInfo;";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from CanProduceInfo;";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.ProductInfo.php');
            for($i = 0;$i < count($list);$i++)
            {               
               $Product = new ProductInfo(
                    $list[$i]['Pro_Code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_Xinghao'],
                    $list[$i]['Pro_Gongyi'],
                    $list[$i]['Pro_Use'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    );
                //var_dump($product);
                //return;
                array_push($result,$Product);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             

    }
    public function addProductInfo()//添加新产品
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $Pro_Code=$decodedList->Pro_Code;
        $Pro_Name=$decodedList->Pro_Name;
        $Pro_Leibie=$decodedList->Pro_Leibie;
        $Pro_Gui=$decodedList->Pro_Gui;
        $Pro_Xinghao=$decodedList->Pro_Xinghao;
        $Pro_Gongyi=$decodedList->Pro_Gongyi;
        $Pro_Use=$decodedList->Pro_Use;
        $Time=$decodedList->Time;
        $Remark=$decodedList->Remark;


        $sql="insert into CanProduceInfo values ('$Pro_Code','$Pro_Name','$Pro_Leibie','$Pro_Gui',
            '$Pro_Xinghao','$Pro_Gongyi','$Pro_Use','$Time','$Remark')";

            $M=new Model();
            $r=$M->execute($sql);
            if ($r) {
                echo "ok";
            }
            else
            {
                echo "fail";
            }

    }


    public function selectProductsinfo()//按条件查询产品信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $identify=$decodedList->num;
        $Condition=$decodedList->conditon;  
            
           switch ($identify) {
            case 1:
               $sql="select * from CanProduceInfo where Pro_Code like'%$Condition%'  ";
                break;
            case 2:
               $sql="select * from CanProduceInfo where Pro_Name like '%$Condition%' ";
               break;
            case 3:
               $sql="select * from CanProduceInfo where Pro_Leibie like '%$Condition%'  ";
               break;
            case 4:
               $sql="select * from CanProduceInfo where Time like '%$Condition%' ";
               break;
           
            default:
                # code...
                break;
        
        }
        
        
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.ProductInfo.php');
           for($i = 0;$i < count($list);$i++)
            {               
               $Product = new ProductInfo(
                    $list[$i]['Pro_Code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_Xinghao'],
                    $list[$i]['Pro_Gongyi'],
                    $list[$i]['Pro_Use'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    );
                //var_dump($product);
                //return;
                array_push($result,$Product);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;           
        
    }

    public function updateProductsInfo()//更新产品信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $Pro_Code=$decodedList->Pro_Code;
        $Pro_Name=$decodedList->Pro_Name;
        $Pro_Leibie=$decodedList->Pro_Leibie;
        $Pro_Gui=$decodedList->Pro_Gui;
        $Pro_Xinghao=$decodedList->Pro_Xinghao;
        $Pro_Gongyi=$decodedList->Pro_Gongyi;
        $Pro_Use=$decodedList->Pro_Use;
       // $Time=$decodedList->Time;
        $Remark=$decodedList->Remark;


        $sql="update  CanProduceInfo set Pro_Name='$Pro_Name',Pro_Leibie='$Pro_Leibie',Pro_Gui='$Pro_Gui',
            Pro_Xinghao='$Pro_Xinghao',Pro_Gongyi='$Pro_Gongyi',Pro_Use='$Pro_Use',Remark='$Remark' where Pro_Code='$Pro_Code'";

            $M=new Model();
            $r=$M->execute($sql);
            if ($r) {
                echo "ok";
            }
            else
            {
                echo "fail";
            }
    }

    public function deleteProductsInfo()//删除产品信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $Pro_Code=$jsonInput;
        $sql="delete from CanProduceInfo where Pro_Code='$Pro_Code' ";

            $M=new Model();
            $r=$M->execute($sql);
            if ($r) {
                echo "ok";
            }
            else
            {
                echo "fail";
            }
  
    }
   
   public function find_Pro_name_info()//返回可生产的产品信息
    {
        
        $sql="select Pro_Name, Pro_Leibie from CanProduceInfo ";
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.ProductInfo.php');
           for($i = 0;$i < count($list);$i++)
            {               
               $Product = new ProductInfo(
                    
                    $list[$i]['Pro_Code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_Xinghao'],
                    $list[$i]['Pro_Gongyi'],
                    $list[$i]['Pro_Use'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    
                    );
                //var_dump($product);
                //return;
                array_push($result,$Product);
            }   
        }
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;           

  
    }
}
?>