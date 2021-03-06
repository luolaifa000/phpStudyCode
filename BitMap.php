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
 * 位图存储数据
 * @author yumancang
 *
 */
class BitMap
{
    /**
     * 整数数组
     * @var array
     */
    public $data = [];
    /**
     * 位图数组
     * @var array
     */
    public $bitmap = [];
    
    public function __construct($array)
    {
        $this->data = $array;
        sort($this->data);
        $max = $this->data[count($this->data) - 1];
        $this->bitmap = array_fill(0, ceil($max/64), 0);
    }
    
    /**
     * 在位图中找出10个最大的数
     * 
     */
    public function findMaxTen()
    {
        $k = 0;
        $array = [];
        $length = count($this->bitmap) - 1;
  
        for ($i = $length;$i>=0;$i--) {
            if ($k > 9) break;
            for ($j = 63; $j>=0;$j--) {
                if ($k > 9) break;
                $temp = 1 << $j;
                
                $flag = $this->bitmap[$i] & $temp;
                if ($flag) {
                    $array[$k] = 64*$i + $j;
                    $k++;
                }
                
            }
        }
        prend($array);
    }
    
    /**
     * 将常规数组转成位图数组
     * 
     */
    public function saveArrayToBitmap()
    {
        pre($this->data);
        foreach ($this->data as $key => $val) {
            $arrayindex = floor($val / 64);
            $bitindex = $val % 64;
            $temp = 1 << $bitindex;
            
            $this->bitmap[$arrayindex] = $this->bitmap[$arrayindex] | $temp;
            
        }
        
        /* foreach ($this->bitmap as $key => $val) {
            pre(decbin($val));
        } */
    }
    
    /**
     * 将位图数组转成常规数组
     *
     */
    public function saveBitmapToArray()
    {
        $k = 0;
        $array = [];
        foreach ($this->bitmap as $key => $val) {
            for ($i = 0; $i<64;$i++) {
                $temp = 1 << $i;
                $flag = $this->bitmap[$key] & $temp;
                if ($flag) {
                    $array[$k] = 64*$key + $i;
                }
                $k++;
            }
        }
        
        pre($array);
    }
}

$start = memory_get_usage();
$k = 0;
$max = 1000;
for ($i = 1;$i<$max;$i++) {
    
    $ass[$k] = rand(0,$max);
    $k++;
}

$bitmap = new BitMap($ass);
$bitmap->saveArrayToBitmap();
//$bitmap->saveBitmapToArray();
$bitmap->findMaxTen();


$end = memory_get_usage();
prend(($end-$start)/1024/1024);

?>