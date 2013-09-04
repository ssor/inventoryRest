<?php
// 本文档自动生成，仅供测试运行
class PlanAction extends Action
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
    public function allPlanInfo()//所有订单信息
    {
        if (C('DB_TYPE')== 'Sqlsrv') {
            // sqlserver
            $sql = "select * from ProducePlan where state='未完成';";
            
        }
        else if (C('DB_TYPE')== 'pdo') {
                //sqlite
                $sql = "select * from ProducePlan where state='未完成';";
            }
        $M=new Model();
        $list = $M->query($sql);
        $result = array();
        if (count($list)>0) {
            //var_dump($list);
            //return;
            require_once('class.Plan.php');
            for($i = 0;$i < count($list);$i++)
            {               
               $plan = new Plan(
                    $list[$i]['PlanCode'],
                    $list[$i]['Pro_Pici'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_Q'],
                    $list[$i]['Pro_Chej'],
                    $list[$i]['Pro_Person'],
                    $list[$i]['Contact'],
                    $list[$i]['state'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    
                    );
                //var_dump($product);
                //return;
                array_push($result,$plan);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             

    }
    public function addProPlan()
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
      
        $decodedTags=json_decode($jsonInput);

        $PlanCode=$decodedTags->PlanCode;
        $Pro_Pici=$decodedTags->Pro_Pici;
        $Pro_Name=$decodedTags->Pro_Name;
        $Pro_Leibie=$decodedTags->Pro_Leibie;
        $Pro_Gui=$decodedTags->Pro_Gui;
        $Pro_Q=$decodedTags->Pro_Q;
        $Pro_Chej=$decodedTags->Pro_Chej;
        $Pro_Person=$decodedTags->Pro_Person;
        $Contact=$decodedTags->Contact;
        $state=$decodedTags->state;
        $Time=$decodedTags->Time;
        $Remark=$decodedTags->Remark;

       
        $sql="insert into ProducePlan (PlanCode,Pro_Pici,Pro_Name,Pro_Leibie,Pro_Gui,Pro_Q,Pro_Chej,Pro_Person,Contact,state,Time,Remark) values ('$PlanCode','$Pro_Pici','$Pro_Name','$Pro_Leibie','$Pro_Gui'
            ,'$Pro_Q','$Pro_Chej','$Pro_Person','$Contact','$state','$Time','$Remark')";
        $M_insert=new Model();
        $r=$M_insert->execute($sql);
        if($r)
        {
             echo "ok";
        }
        else
        {
             echo "fail";
        }
        
    }
    public function updateplaninfo()
    {
        $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
      
        $decodedTags=json_decode($jsonInput);

        $PlanCode=$decodedTags->PlanCode;
        $Pro_Pici=$decodedTags->Pro_Pici;
        $Pro_Name=$decodedTags->Pro_Name;
        $Pro_Leibie=$decodedTags->Pro_Leibie;
        $Pro_Gui=$decodedTags->Pro_Gui;
        $Pro_Q=$decodedTags->Pro_Q;
        $Pro_Chej=$decodedTags->Pro_Chej;
        $Pro_Person=$decodedTags->Pro_Person;
        $Contact=$decodedTags->Contact;
        $state=$decodedTags->state;
        $Time=$decodedTags->Time;
        $Remark=$decodedTags->Remark;

       
        $sql="update ProducePlan set Pro_Pici='$Pro_Pici',Pro_Name='$Pro_Name',Pro_Leibie='$Pro_Leibie',Pro_Gui='$Pro_Gui'
        ,Pro_Q='$Pro_Q',Pro_Chej='$Pro_Chej',Pro_Person='$Pro_Person',Contact='$Contact',state='$state',Time='$Time',Remark='$Remark' 
        where PlanCode='$PlanCode'";

        $M_insert=new Model();
        $r=$M_insert->execute($sql);
        if($r)
        {
             echo "ok";
        }
        else
        {
             echo "fail";
        }
    }
    public function deleteplaninfo()
    {
        $jsonInput = file_get_contents("php://input"); 
        $id = $jsonInput;
        $sql="delete from ProducePlan where PlanCode='$id'";
        $M_delete=new Model();
        $r=$M_delete->execute($sql);
        if($r)
        {
             echo "ok";
        }
        else
        {
             echo "fail";
        }

    }
    public function selectplansinfo()//按条件查询订单信息
    {
        $jsonInput = file_get_contents("php://input"); 
        $decodedList = json_decode($jsonInput);
        $identify=$decodedList->num;
        $Condition=$decodedList->conditon;  
        $state=$decodedList->state;    
        if($state=="全部计划")
        {
             switch ($identify) {
            case 1:
               $sql="select * from ProducePlan where PlanCode like'%$Condition%' ";
                break;
            case 2:
               $sql="select * from OrderSheet where Pro_Name like '%$Condition%' ";
               break;
            case 3:
               $sql="select * from OrderSheet where Buyer like '%$Condition%'  ";
               break;
            case 4:
               $sql="select * from OrderSheet where Time like '%$Condition%' ";
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
               $sql="select * from ProducePlan where PlanCode like'%$Condition%' and state='$state'";
                break;
            case 2:
               $sql="select * from ProducePlan where Pro_Pici like '%$Condition%' and state='$state'";
               break;
            case 3:
               $sql="select * from ProducePlan where Pro_Name like '%$Condition%' and state='$state' ";
               break;
            case 4:
               $sql="select * from ProducePlan where Pro_Chej like '%$Condition%' and state='$state' ";
               break;
            case 5:
               $sql="select * from ProducePlan where Time like '%$Condition%' and state='$state'";
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
             require_once('class.Plan.php');
            for($i = 0;$i < count($list);$i++)
            {               
               $plan = new Plan(
                    $list[$i]['PlanCode'],
                    $list[$i]['Pro_Pici'],
                    $list[$i]['Pro_Name'],
                    $list[$i]['Pro_Leibie'],
                    $list[$i]['Pro_Gui'],
                    $list[$i]['Pro_Q'],
                    $list[$i]['Pro_Chej'],
                    $list[$i]['Pro_Person'],
                    $list[$i]['Contact'],
                    $list[$i]['state'],
                    $list[$i]['Time'],
                    $list[$i]['Remark']
                    
                    );
                //var_dump($product);
                //return;
                array_push($result,$plan);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
        return;             
    }
    public function selectplan_Q()//返回一个值
    {
        $jsonInput = file_get_contents("php://input"); 
        $id=$jsonInput;
        $sql="select Pro_Name,Pro_Q from ProducePlan where PlanCode='$id';";
        $M=new Model();
        $list = $M->query($sql);
                 
        $num=$list[0]["Pro_Q"] ;
        //$foo_json = json_encode($result);
        
        
        return;             

    }
    public function updateOrderstate()
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
      public function updateplanstate()
    {
         $jsonInput = file_get_contents("php://input"); 
        //$jsonInput=$this->checkUTF8($jsonInput);
        //$decodedTags=json_decode($jsonInput);
        $planid=$jsonInput;
        
        $sql="update ProducePlan set state='已加入生产' where PlanCode='$planid'";
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