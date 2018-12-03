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
 * 冒泡排序
 * @author yumancang
 *
 */
class BubbleSort
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
     * 升序冒泡 
     * 时间复杂度  n n-1 n-2 n-3 .... 1   (1+n)*n/2 = O(n2)
     */
    public function ascBubbleSort()
    {
        pre($this->data);
        $length = count($this->data);
        for ($i = 0; $i< $length-1; $i++) {
            for ($j = 0; $j < $length-$i-1; $j++) {
                if ($this->data[$j] > $this->data[$j+1]) {
                    $temp = $this->data[$j+1];
                    $this->data[$j+1] = $this->data[$j];
                    $this->data[$j] = $temp;
                }  
            }
        }
        pre($this->data);
    }
    
    /**
     * 降序冒泡
     * 时间复杂度  n n-1 n-2 n-3 .... 1   (1+n)*n/2 = O(n2)
     */
    public function descBubbleSort()
    {
        pre($this->data);
        $length = count($this->data);
        for ($i = 0; $i< $length-1; $i++) {
            for ($j = 0; $j < $length-$i-1; $j++) {
                if ($this->data[$j] < $this->data[$j+1]) {
                    $temp = $this->data[$j+1];
                    $this->data[$j+1] = $this->data[$j];
                    $this->data[$j] = $temp;
                }
            }
        }
        pre($this->data);
    }
    

        
}

$start = memory_get_usage();

$bubble = new BubbleSort([7,3,2,4,6,9,5,55,77,33,23,234,66,88,44,234,566]);
$bubble->ascBubbleSort();
$bubble->descBubbleSort();
$end = memory_get_usage();
prend(($end-$start)/1024/1024);

?>