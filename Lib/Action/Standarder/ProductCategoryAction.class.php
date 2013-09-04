<?php
/**
* 
*/
class ProductCategory
{
    public $category_id;
    public $category_name;
    public $category_image;
    public $state;
    // public $new_over_old = '0';//覆盖旧版本
    function __construct($category_id = "",$category_name = "", $category_image = "")
    {
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->category_image = $category_image;
    }
}
// http://localhost:9002/index.php/Standarder/ProductCategory/get_category_list
class ProductCategoryAction extends Action
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		echo "ProductCategory";
        //$this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
    }
    public function add_category()
    {
        $jsonInput = file_get_contents("php://input"); 
        $jsonInput = $this->checkUTF8($jsonInput);
        $Category=json_decode($jsonInput);
        $category_id = $Category->category_id;
        $category_name = $Category->category_name;
        $category_image = $Category->category_image;
        if(!empty($category_id))
        {
            $sqlExecute = "insert into product_category(category_id,category_name, category_image)
                             values('$category_id','$category_name', '$category_image');";
            $M = new Model();
            $r = $M->execute($sqlExecute);
            $pc = new ProductCategory(
                $Category->category_id,
                $Category->category_name,
                $Category->category_image
                );
            if ($r) {
                $pc->state="ok";
            }
            else
            {
                $pc->state="failed";
            }
            $foo_json = json_encode($pc);
            echo $foo_json;
        }
        else
        {
            echo '';
        }
    }
    public function delete_category_by_id()
    {
        $cid = $_GET['id'];
        if(empty($cid))
        {
            echo '';
            return;
        }
        $sql_delete = "delete from product_category where category_id = '$cid'";
        $M = new Model();
        $r = $M->execute($sql_delete);
        if($r)
        {
            echo 'ok';
        }
        else
        {
            echo 'failed';
        }
    }
    public function get_category_by_id()
    {
        $cid = $_GET['id'];
        if(empty($cid))
        {
            echo '';
            return;
        }
        $sql_select = "select category_id, category_name, category_image from product_category
                         where category_id = '$cid'";
        $M = new Model();
        $list = $M->query($sql_select);
        if(count($list) > 0)
        {
            $pc = new ProductCategory(
                $list[0]['category_id'],
                $list[0]['category_name'],
                $list[0]['category_image']
            );
        }
        $foo_json = json_encode($pc);
        echo $foo_json;
    }
    // 
    public function get_category_list()
    {
        $sql_select = "select category_id, category_name, category_image from product_category
                        ";
        $M = new Model();
        $list = $M->query($sql_select);
        $result = array();
        if(count($list) > 0)
        {
            for($i = 0; $i < count($list); $i++)
            {
                $pc = new ProductCategory(
                    $list[$i]['category_id'],
                    $list[$i]['category_name'],
                    $list[$i]['category_image']
                );
                array_push($result,$pc);
            }
        }
        $foo_json = json_encode($result);
        echo $foo_json;
    }
    public function checkUTF8($str) {
        $cod = mb_check_encoding($str,"UTF-8");
        if("UTF-8" != $cod ||  empty($cod))
        {
            $str = mb_convert_encoding( $str,'utf-8','gb2312'); 
        }
        return $str;
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