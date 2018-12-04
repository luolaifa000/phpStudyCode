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
 * 分治归并排序
 * 基本思想是 先将数组分成一个个不能在分的集合，然后在按顺序合并各个集合
 * 时间复杂度 = O（nlogn）
 * @author yumancang
 *
 */
class DivideConquerSort
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
     * 升序分开
     *
     * @param int $start
     * @param int $end
     */
    public function ascSort(int $start,int $end)
    {
        if ($start < $end) {
            $mid = floor(($start+$end)/2);
            $this->ascSort($start, $mid);
            $this->ascSort($mid+1, $end);
            $this->ascMerge($start,$mid,$end);
        }
        
    }
    /**
     * 升序合并
     *
     * @param int $start
     * @param int $end
     */
    public function ascMerge(int $start, int $mid, int $end)
    {
        
        $i = $start;
        $j = $mid+1;
        $temp = [];
        while (true) {
            if ($i > $mid) break;
            if ($j > $end) break;
            if ($this->data[$i] < $this->data[$j]) {
                $temp[] = $this->data[$i];
                $i++;
            }
            if ($this->data[$i] > $this->data[$j]) {
                $temp[] = $this->data[$j];
                $j++;
            }
        }
        if ($i < $mid+1) {
            while ($i < $mid+1) {
                $temp[] = $this->data[$i];
                $i++;
            }
        }
        if ($j < $end+1) {
            while ($j < $end+1) {
                $temp[] = $this->data[$j];
                $j++;
            }
        }
        $m = 0;
        for ($k = $start; $k <=$end; $k++) {
            $this->data[$k] = $temp[$m++];
        }
    }
    
    /**
     * 升序分治
     * 
     */
    public function ascDivideConquerSort()
    {
        pre($this->data);
        
        $this->ascSort(0,count($this->data) - 1);
        pre($this->data);
    }
    
    /**
     * 降序分治
     * 
     */
    public function descDivideConquerSort()
    {
        pre($this->data);
        
        $this->descSort(0,count($this->data) - 1);
        pre($this->data);
    }
    
    /**
     * 降序分开
     * 
     * @param int $start
     * @param int $end
     */
    public function descSort(int $start,int $end)
    {
        if ($start < $end) {
            $mid = floor(($start+$end)/2);
            $this->descSort($start, $mid);
            $this->descSort($mid+1, $end);
            $this->descMerge($start,$mid,$end);
        }
        
    }
    
    /**
     * 降序合并
     * 
     * @param int $start
     * @param int $mid
     * @param int $end
     */
    public function descMerge(int $start, int $mid, int $end)
    {
        
        $i = $start;
        $j = $mid+1;
        $temp = [];
        while (true) {
            if ($i > $mid) break;
            if ($j > $end) break;
            if ($this->data[$i] < $this->data[$j]) {
                $temp[] = $this->data[$j];
                $j++;
            }
            if ($this->data[$i] > $this->data[$j]) {
                $temp[] = $this->data[$i];
                $i++;
            }
        }
       
        if ($i < $mid+1) {
            while ($i < $mid+1) {
                $temp[] = $this->data[$i];
                $i++;
            }
        }
        if ($j < $end+1) {
            while ($j < $end+1) {
                $temp[] = $this->data[$j];
                $j++;
            }
        }
        $m = 0;
        for ($k = $start; $k <=$end; $k++) {
            $this->data[$k] = $temp[$m++];
        }
    }
}

$start = memory_get_usage();

$bubble = new DivideConquerSort([7,3,2,4,6,9,5,8]);
//$bubble->ascInsertSort();
//$bubble->ascDivideConquerSort();
$bubble->descDivideConquerSort();
$end = memory_get_usage();
prend(($end-$start)/1024/1024);

?>