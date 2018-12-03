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
 * 插入排序
 * 基本思想是每一步将一个待排序的记录，插入到前面已经排好序的有序序列中去，直到插完所有元素为止
 * @author yumancang
 *
 */
class InsertSort
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
     * 升序插入
     * 时间复杂度  n n-1 n-2 n-3 .... 1   (1+n)*n/2 = O(n2)
     */
    public function ascInsertSort()
    {
        pre($this->data);
        $length = count($this->data);
        for ($i = 1; $i< $length; $i++) {
            $temp = $this->data[$i];
            for ($j = 0; $j < $i; $j++) {
                if ($this->data[$i] < $this->data[$j]) {
                    for ($n = $i; $n>$j; $n--) {
                        $this->data[$n] = $this->data[$n-1];
                    }
                    break;
                }  
            }
            $this->data[$j] = $temp;
        }
        pre($this->data);
    }
    
    /**
     * 降序插入
     * 时间复杂度  n n-1 n-2 n-3 .... 1   (1+n)*n/2 = O(n2)
     */
    public function descInsertSort()
    {
        pre($this->data);
        $length = count($this->data);
        for ($i = 1; $i< $length; $i++) {
            $temp = $this->data[$i];
            for ($j = 0; $j < $i; $j++) {
                if ($this->data[$i] > $this->data[$j]) {
                    for ($n = $i; $n>$j; $n--) {
                        $this->data[$n] = $this->data[$n-1];
                    }
                    break;
                }
            }
            $this->data[$j] = $temp;
        }
        pre($this->data);
    }
    

        
}

$start = memory_get_usage();

$bubble = new InsertSort([7,3,2,4,6,9,5,55,77,88,3,55,77,4545,33]);
//$bubble->ascInsertSort();
$bubble->descInsertSort();
$end = memory_get_usage();
prend(($end-$start)/1024/1024);

?>