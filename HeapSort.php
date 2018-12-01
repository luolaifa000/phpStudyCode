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
 * 
 * 构建大堆序
 * 
 * @author laifaluo
 *
 */
class HeapSort {
    
    public $data;
    
    public function __construct(Array $array)
    {
        $this->data = $array;
    }
    
    /**
     * 将数组初始化构建堆
     * 从最后一个非叶子节点开始，递归到第0个, index = n/2 -1
     * 
     */
    public function buildHeap()
    {
        
        $noLeafNodeIndex = floor(count($this->data)/2) - 1;
        for ($i = $noLeafNodeIndex; $i>=0; $i--) {
            $this->adjustHeap($i,count($this->data));
           
        }
        pre("构建后",$this->data);
        //prend($noLeafNodeIndex);
    }
    
    /**
     * 交换头尾，在构建堆
     * 
     */
    public function sortHeap()
    {
        $k = 1;
        for ($i = count($this->data) - 1; $i > 0 ; $i--) {
            //每次构建好堆后，交换头尾
            $temp = $this->data[$i];
            $this->data[$i] = $this->data[0];
            $this->data[0] = $temp;
            pre("第".$k."趟,交换头尾后",$this->data);
            if ($k == 3) {
                
                $this->adjustHeap1(0,$i);
            }
            //交换头尾后，按照堆规则，重新构建堆
            $this->adjustHeap(0,$i);
            pre("第".$k."趟,构建完堆后",$this->data);
            $k++;
        }
        
    }
    
    /**
     * 按照堆规则，重新构建堆
     * 
     * @param int $parentIndex
     * @param int $length
     */
    public function adjustHeap(int $parentIndex,int $length)
    {
        $childIndex = 2*$parentIndex + 1;
        while ($childIndex < $length) {
            if ($childIndex+1 < $length && isset($this->data[$childIndex+1]) && $this->data[$childIndex+1] >$this->data[$childIndex]) {
                $childIndex++;
            }
            
            if ($this->data[$parentIndex] >= $this->data[$childIndex]) {
                break;
            }
            $temp = $this->data[$parentIndex];
            $this->data[$parentIndex] = $this->data[$childIndex];
            $this->data[$childIndex] = $temp;
            
            $parentIndex = $childIndex;
            $childIndex = 2*$parentIndex + 1;
        }
        
    }
    
    /**
     * 
     * 用来做特殊调试的
     * @param int $parentIndex
     * @param int $length
     */
    public function adjustHeap1(int $parentIndex,int $length)
    {
        
        $childIndex = 2*$parentIndex + 1;
        while ($childIndex < $length) {
            if ($childIndex+1 < $length && isset($this->data[$childIndex+1]) && $this->data[$childIndex+1] >$this->data[$childIndex]) {
                $childIndex++;
            }
            
            if ($this->data[$parentIndex] >= $this->data[$childIndex]) {
                break;
            }
            $temp = $this->data[$parentIndex];
            $this->data[$parentIndex] = $this->data[$childIndex];
            $this->data[$childIndex] = $temp;
            
            $parentIndex = $childIndex;
            $childIndex = 2*$parentIndex + 1;
        }

        
    }
}


$heapSort = new HeapSort([20,50,10,30,70,20,80]);

pre("初始数组",$heapSort->data);
$heapSort->buildHeap();
$heapSort->sortHeap();
pre("已排序数组",$heapSort->data);



?>