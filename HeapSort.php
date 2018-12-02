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
 * @author yumancang
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
    public function buildMaxHeap()
    {
        
        $noLeafNodeIndex = floor(count($this->data)/2) - 1;
        for ($i = $noLeafNodeIndex; $i>=0; $i--) {
            $this->adjustMaxHeap($i,count($this->data));
           
        }
        pre("构建后",$this->data);
        //prend($noLeafNodeIndex);
    }
    
    /**
     * 交换头尾，在构建堆
     * 
     */
    public function sortMaxHeap()
    {
        $k = 1;
        for ($i = count($this->data) - 1; $i > 0 ; $i--) {
            //每次构建好堆后，交换头尾
            $temp = $this->data[$i];
            $this->data[$i] = $this->data[0];
            $this->data[0] = $temp;
            pre("第".$k."趟,交换头尾后",$this->data);
            if ($k == 3) {
                
                $this->adjustMaxHeap(0,$i);
            }
            //交换头尾后，按照堆规则，重新构建堆
            $this->adjustMaxHeap(0,$i);
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
    public function adjustMaxHeap(int $parentIndex,int $length)
    {
        $childIndex = 2*$parentIndex + 1;
        while ($childIndex < $length) {
            if ($childIndex+1 < $length && isset($this->data[$childIndex+1]) && $this->data[$childIndex+1] > $this->data[$childIndex]) {
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
     * 将数组初始化构建堆
     * 从最后一个非叶子节点开始，递归到第0个, index = n/2 -1
     *
     */
    public function buildMinHeap()
    {
        
        $noLeafNodeIndex = floor(count($this->data)/2) - 1;
        for ($i = $noLeafNodeIndex; $i>=0; $i--) {
            $this->adjustMinHeap($i,count($this->data));
            
        }
        pre("构建后",$this->data);
        //prend($noLeafNodeIndex);
    }
    
    /**
     * 交换头尾，在构建堆
     *
     */
    public function sortMinHeap()
    {
        $k = 1;
        for ($i = count($this->data) - 1; $i > 0 ; $i--) {
            //每次构建好堆后，交换头尾
            $temp = $this->data[$i];
            $this->data[$i] = $this->data[0];
            $this->data[0] = $temp;
            pre("第".$k."趟,交换头尾后",$this->data);
            if ($k == 3) {
                
                $this->adjustMinHeap(0,$i);
            }
            //交换头尾后，按照堆规则，重新构建堆
            $this->adjustMinHeap(0,$i);
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
    public function adjustMinHeap(int $parentIndex,int $length)
    {
        $childIndex = 2*$parentIndex + 1;
        while ($childIndex < $length) {
            if ($childIndex+1 < $length && isset($this->data[$childIndex+1]) && $this->data[$childIndex+1] < $this->data[$childIndex]) {
                $childIndex++;
            }
            
            if ($this->data[$parentIndex] <= $this->data[$childIndex]) {
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
     * 大堆
     * 
     */
    public function maxHeap()
    {
         //pre("初始数组",$heapSort->data);
        $this->buildMaxHeap();
        $this->sortMaxHeap();
         //pre("已排序数组",$heapSort->data);
    }
    
    /**
     * 小堆
     * 
     */
    public function minHeap()
    {
        //pre("初始数组",$heapSort->data);
        $this->buildMinHeap();
        $this->sortMinHeap();
        //pre("已排序数组",$heapSort->data);
    }
    
    
}

//$data = [20,50,10,30,70,20,80,33,44,55,66];
//[20,50,10,30,70,20,80]

/**
 * 100个数字里面求最大的10个数字，采用小堆，小值往上移 (n-m) * logn
 * 
 */ 
/* $data = [];
 for ($i = 0; $i<100;$i++) {
    $data[$i] = rand(1,1000);
} 
pre($data);
$initData = array_slice($data, 0,10);

$heapSort = new HeapSort($initData);
$heapSort->buildMinHeap();
for ($i = 10;$i<count($data); $i++) {
    if ($data[$i] > $heapSort->data[0]) {
        $heapSort->data[0] = $data[$i];
        $heapSort->adjustMinHeap(0, 10);
    }
}

 prend(sort($heapSort->data),$heapSort->data);
 */


/**
 * 
 * 100个数字里面求最小的10个数字,采用大堆，大值往上移    (n-m) * logn
 * 
 */ 
 $data = [];
 for ($i = 0; $i<100;$i++) {
    $data[$i] = rand(1,1000);
 }
 pre($data);
 $initData = array_slice($data, 0,10);
 
 $heapSort = new HeapSort($initData);
 $heapSort->buildMaxHeap();
 for ($i = 10;$i<count($data); $i++) {
     if ($data[$i] < $heapSort->data[0]) {
         $heapSort->data[0] = $data[$i];
         $heapSort->adjustMaxHeap(0, 10);
     }
 }

 prend(sort($heapSort->data),$heapSort->data);
 


?>