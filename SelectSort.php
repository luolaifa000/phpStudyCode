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
 * 选择排序 
 * 基本思想为每一趟从待排序的数据元素中选择最小（或最大）的一个元素作为首元素，直到所有元素排完为止，简单选择排序是不稳定排序
 * @author yumancang
 *
 */
class SelectSort
{
    /**
     * 整数数组
     * @var array
     */
    public $data = [];

    public function __construct($array)
    {
        $this->data = $array;

    }
    
    /**
     * 升序选择 
     * 时间复杂度  n n-1 n-2 n-3 .... 1   (1+n)*n/2 = O(n2)
     */
    public function ascSelectSort()
    {
        pre($this->data);
        $length = count($this->data);
        
        for ($i = 0; $i< $length-1; $i++) {
            for ($j = $i; $j < $length-1; $j++) {
                if ($this->data[$j] < $this->data[$j+1]) {
                    $temp = $this->data[$j+1];
                    $this->data[$j+1] = $this->data[$j];
                    $this->data[$j] = $temp;
                }  
            }
            
            $temp = $this->data[$length-1];
            $this->data[$length-1] = $this->data[$i];
            $this->data[$i] = $temp;
            
        }
        pre($this->data);
    }
    
    /**
     * 降序选择 
     * 时间复杂度  n n-1 n-2 n-3 .... 1   (1+n)*n/2 = O(n2)
     */
    public function descSelectSort()
    {
        pre($this->data);
        $length = count($this->data);
        
        for ($i = 0; $i< $length-1; $i++) {
            for ($j = $i; $j < $length-1; $j++) {
                if ($this->data[$j] > $this->data[$j+1]) {
                    $temp = $this->data[$j+1];
                    $this->data[$j+1] = $this->data[$j];
                    $this->data[$j] = $temp;
                }
            }
            
            $temp = $this->data[$length-1];
            $this->data[$length-1] = $this->data[$i];
            $this->data[$i] = $temp;
            
        }
        pre($this->data);
    }
    

        
}

$start = memory_get_usage();

$select = new SelectSort([7,3,2,4,6,9,5]);
//$select->ascSelectSort();
$select->descSelectSort();
$end = memory_get_usage();
prend(($end-$start)/1024/1024);

?>