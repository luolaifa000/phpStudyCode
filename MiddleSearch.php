<?php
function pre($arr)
{
    $data = func_get_args();
    foreach($data as $key=>$val)
    {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
    }
}

function prend()
{
    $data = func_get_args();
    foreach($data as $key=>$val)
    {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
    }
    exit();
}
/**
 * 二分查找
 * 基本思想是，在有序的数组里面递归折半查找
 * @author yumancang
 *
 */
class MiddleSearch
{
    /**
     * 整数数组
     * @var array
     */
    public $data = [];

    public function __construct(Array $array)
    {
        $this->data = $array;
    }
    
    /**
     * 二分查找
     * 找到的话返回索引，否者返回-1
     * 
     * @param int $val
     * @param int $start
     * @param int $end
     * @return number|mixed|mixed|number
     */
    public function search(int $val,int $start,int $end) 
    {
        $middle = floor(($start + $end) / 2);
        if ($val > $this->data[$middle]) {
            return $this->search($val, $middle+1, $end);
        }
        if ($val < $this->data[$middle]) {
            return $this->search($val, $start, $middle-1);
        }
        
        if ($val == $this->data[$middle]) {
            return $middle;
        }
        return -1;
    }
    
    

        
}

$start = memory_get_usage();

$bubble = new MiddleSearch([1,2,3,4,5,6,7,8,9,10,55]);
$result = $bubble->search(1,0,count($bubble->data)-1);
var_dump($result);
$end = memory_get_usage();
prend(($end-$start)/1024/1024);

?>