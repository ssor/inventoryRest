<?php
// 本文档自动生成，仅供测试运行
class ChukudanAction extends Action
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
    public function addChukudan()
    {
        $jsonInput = file_get_contents("php://input");
        $decodedTags=json_decode($jsonInput);

        $Chukudan_code=$decodedTags->Chukudan_code;
        $Order_Code=$decodedTags->Order_Code;
        $Pro_Name=$decodedTags->Pro_Name;
        $Pro_Gui=$decodedTags->Pro_Gui;
        $Pro_Q=$decodedTags->Pro_Q;
        $Person=$decodedTags->Person;
        $PerContact=$decodedTags->PerContact;
        $adress=$decodedTags->adress;
        $time=$decodedTags->time;
        $remark=$decodedTags->Remark;
        $falg=$decodedTags->falg;

        $sqlExecute ="insert into Chukudan values('$Chukudan_code','$Order_Code','$Pro_Name','$Pro_Gui','$Pro_Q',
            '$Person','$PerContact','$adress','$time',' $remark','$falg');";
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
     public function Find_allChukudan()
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from Chukudan where falg='1' 
        ;";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from Chukudan where falg='1'
                        ;";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.Chukudan.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $product = new Chukudan(
                    $list[$i]['Chukudan_code'],
                    $list[$i]['Order_Code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_Q'],
                    $list[$i]['Person'],
                    $list[$i]['PerContact'],
                    $list[$i]['adress'],
                    $list[$i]['time'],
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
     public function selectChukudaninfo()//按条件查询出库单信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $identify=$decodedList->num;
        $Condition=$decodedList->conditon;  
            
           switch ($identify) {
            case 1:
               $sql="select * from Chukudan where Chukudan_code like'%$Condition%'  ";
                break;
            case 2:
               $sql="select * from Chukudan where Order_Code like '%$Condition%' ";
               break;
            case 3:
               $sql="select * from Chukudan where Person like '%$Condition%'  ";
               break;
            case 4:
               $sql="select * from Chukudan where time like '%$Condition%' ";
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
            require_once('class.Chukudan.php');
            for($i = 0;$i < count($list);$i++)
            {               
                $product = new Chukudan(
                    $list[$i]['Chukudan_code'],
                    $list[$i]['Order_Code'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_Q'],
                    $list[$i]['Person'],
                    $list[$i]['PerContact'],
                    $list[$i]['adress'],
                    $list[$i]['time'],
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
    public function updateChukudan()
    {
        $jsonInput = file_get_contents("php://input");
        $id=$jsonInput;
        $sqlExecute ="update Chukudan set falg='2' where Chukudan_code='$id' ";
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
}
?>