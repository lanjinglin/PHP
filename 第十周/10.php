<?php
    class MyIterator implements Iterator
    {
        private $var = array();
    
        public function __construct($array)
        {
            if (is_array($array)) 
            {
                $this->var = $array;
            }
        }
    
        public function rewind()
        {
            //echo "回到第一个元素：</br>";
            reset($this->var);
        }
      
        public function current()
        {
            $var = current($this->var);
            //echo "当前元素: $var</br>";
            return $var;
        }
      
        public function key() 
        {
            $var = key($this->var);
            //echo "当前元素的key: $var</br>";
            return $var;
        }
      
        public function next() 
        {
            $var = next($this->var);
            //echo "下一个元素: $var</br>";
            return $var;
        }
      
        public function valid()
        {
            $key = key($this->var);
            $var = ($key !== NULL && $key !== FALSE);
            //echo "检测有效性: $var</br>";
            return $var;
        }
    }
    
    $lines = file("10.txt");

    $it = new MyIterator($lines);
    foreach($it as $k => $v)
    {
        print "此时键值对---  $k :  $v </br></br>";
        $arr1 =  explode(' ', $v);
    	
    }
    $min = $arr1[2];
    $minliu = $arr1[1];
	if(substr($minliu,-1) == 'K'){
		$minliu *= 1024;
	}
	else if(substr($minliu,-1) == 'M'){
		$minliu = $minliu * 1024 *1024;
	}
	else{
		$minliu = $minliu * 1;
	}

    $iter = new MyIterator($lines);
    $sumbao = 0;
    $sumliu = 0;
    $max = 0;
    $maxliu = 0;
    foreach ($iter as $key => $value) 
    {
    	$arr =  explode(' ', $value);
    	$sumbao = $arr[2] + $sumbao;
    	$arr[2] *= 1;
    	if($arr[2] > $max)
    	{
    		$max = $arr[2];
    	}
    	if($arr[2] < $min)
    	{
    		$min = $arr[2];
    	}
    	if(substr($arr[1],-1) == 'K'){
    		$arr[1] *= 1024;
    	}
    	else if(substr($arr[1],-1) == 'M'){
    		$arr[1] = $arr[1] * 1024 *1024;
    	}
    	else{
    		$arr[1] = $arr[1] * 1;
    	}
    	$sumliu = $arr[1] + $sumliu;
    	if($arr[1] > $maxliu)
    	{
    		$maxliu = $arr[1];
    	}
    	if($arr[1] < $minliu)
    	{
    		$minliu = $arr[1];
    	}
    }
    echo "数据包的平均值为:" .$sumbao/count($lines). "每分钟";
    echo "</br>";
    echo "数据包的最大值为:" .$max;
    echo "</br>";
    echo "数据包的最小值为:" .$min;
    echo "</br>";
    echo "流量的平均值为:" .$sumliu / count($lines)."byte 每分钟";
    echo "</br>";
    echo "流量的最大值为:" .$maxliu."byte";
    echo "</br>";
    echo "流量的最小值为:" .$minliu."byte";
    echo "</br>";
?>