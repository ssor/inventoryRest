<?php
/**
* 
*/
class res
{
    public $resID;
    public $time_stamp;
    // public $new_over_old = '0';//覆盖旧版本
    function __construct($resID = "",$time_stamp = "")
    {
        $this->resID = $resID;
        $this->time_stamp = $time_stamp;
    }
}
// http://localhost:9002/index.php/ResSync/resourceSync/get_syc_list
class resourceSyncAction extends Action
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		echo "group1->index";
        //$this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
    }
    public function downFileFromServer()
    {
        $showFileName = 'abc.txt';
        $downFilePath = 'abc.txt';
        if(file_exists($downFilePath))
        {
            if(is_readable($downFilePath))
            {
                if(Trim($showFileName) == '')
                {
                    $showFileName = 'undefined';
                }
                ob_start();
                ob_clean();
                $file_size = filesize($downFilePath);
                header('Content-Encoding:none');
                header('Cache-Control:private');
                header('Content-Length:' . $file_size);
                header('Content-Disposition:attachment; filename=' . $showFileName);
                header('Content-Type:application/octet-stream');
                readfile($downFilePath);
                ob_flush();
            }
        }
    }  

    // 获取更新列表
    // 通过链接获取资源文件所在的组
    // POST参数：上次更新时间，如果为空，则说明第一次更新
    // 
    public function get_syc_list()
    {
        $group = $_GET['group'];
        if(empty($group))
        {
            $group = 'default';
        }
        $jsonInput = file_get_contents("php://input");
        if(empty($jsonInput))
        {
            $sql = "SELECT resID , time_stamp  FROM res_syc where res_group = '$group' order by time_stamp asc;";
        }
        else
        {
            $sql = "SELECT resID , time_stamp  FROM res_syc where res_group = '$group' and time_stamp > '$jsonInput' order by time_stamp asc;";
        }
        $M = new Model();
        $list = $M->query($sql);
        $result = array();
        date_default_timezone_set("Asia/Shanghai");
        $vTime = date("Y-m-d H:i:s");
        if (count($list)>0) {
            for($i = 0;$i < count($list);$i++)
            { 
               $res = new res(
                    $list[$i]['resID'],
                    $vTime
                    );  
                array_push($result,$res);
            }               
        }
        
        $foo_json = json_encode($result);
        
        echo $foo_json;
    }
    //上传资源文件
    //通过链接获取资源文件所在的组
    public function upload_file()
    {
        $group = $_GET['group'];
        if(empty($group))
        {
            $group = 'default';
        }
        {
            // var_dump($_FILES);
            // echo $vTime;
            // return;            
        }
        import("@.ORG.UploadFile");
        //导入上传类
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize = 3292200;
        $upload_path = './Res/'.$group.'/';
        $upload->savePath = $upload_path;
        $file_name = $_FILES['file']['name'];
        $file = $upload_path.$file_name;
        {
            // $file = $upload->getSaveName();
            // echo $file;return;            
        }

        if(file_exists($file))
        {
          unlink($file);
        }
        if (!$upload->upload()) {
            //捕获上传异常
            echo "error";
        } else 
        {
            //取得成功上传的文件信息
             // $uploadList = $upload->getUploadFileInfo();
             // var_dump($uploadList);
            date_default_timezone_set("Asia/Shanghai");
            $vTime = date("Y-m-d H:i:s");
            $M = new Model();
            $sql_select = "SELECT resID , time_stamp  FROM res_syc where resID = '$file_name';";
            $list = $M->query($sql_select);
            if(count($list) <= 0)
            {
                $sql = "insert into res_syc(resID , time_stamp, res_group)
                         values('$file_name','$vTime', '$group');";
            }
            else
            {
                $sql = "update res_syc set time_stamp = '$vTime', res_group = '$group'
                         where resID = '$file_name';";
            }
            $M = new Model();
            $r = $M->execute($sql);
            if ($r) {
                echo "ok";
            }
            else{
                echo "failed";
            }
        }
    }
    public function download_file()
    {
        $group = $_GET['group'];
        if(empty($group))
        {
            $group = 'default';
        }
        $showFileName = $_GET['name'];
        if(empty($showFileName))
        {
            $showFileName = 'undefined';
        }
        // $jsonInput = file_get_contents("php://input");
        // $showFileName = $jsonInput;
        $downFilePath = './Res/'.$group.'/'.$showFileName;
        if(file_exists($downFilePath))
        {
            if(is_readable($downFilePath))
            {
                if(Trim($showFileName) == '')
                {
                    $showFileName = 'undefined';
                }
                ob_start();
                ob_clean();
                $file_size = filesize($downFilePath);
                header('Content-Encoding:none');
                header('Cache-Control:private');
                header('Content-Length:' . $file_size);
                header('Content-Disposition:attachment; filename=' . $showFileName);
                header('Content-Type:application/octet-stream');
                readfile($downFilePath);
                ob_flush();
            }
        }
        return;
        $file_name = $_GET['resID'];
        
        $file_path = "./Res/".$file_name;
        //echo "fail";
        //return;
        if(!empty($file_path) and !is_null($file_path))
        {
            //$filename = basename($path);
            $file=@fopen($file_path,"r");
            if($file)
            {
                header("Content-type:application/octet-stream");
                header("Accept-ranges:bytes");
                header("Accept-length:".filesize($file_path));
                header("Content-Disposition:attachment;filename=".$fileNameSystemBased);
                echo fread($file,filesize($file_path));
                fclose($file);
                //echo "ok";
                exit;
            }
        }
        echo "fail";
    }
    public function delete_file()
    {
        $group = $_GET['group'];
        if(empty($group))
        {
            $group = 'default';
        }
        $showFileName = $_GET['name'];
        $downFilePath = './Res/'.$group.'/'.$showFileName;
        if(file_exists($downFilePath))
        {
          if(unlink($downFilePath))
          {
            echo 'ok';
          }
          else
          {
            echo 'failed';
          }
        }        
        else
        {
            echo 'ok';
        }
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