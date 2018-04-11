<?php
class kmeans
{
	private $data;
    private $data_length;
    private $dims;
    private $k;
	private $means;
    private $clusters;
	private $cluster_sizes;// 18
	public function __construct(int $k, array $data)
	{
		if (0 < $k && $this->check_dims($data))
			$this->initialize($k, $data);
		else
		    die ("kmeans.php error: Invalid choice of k or data is inconsistently defined.");
	}// 23
	private function check_dims(array $data)
	{
		$data_length = sizeof($data);
		$sublength   = sizeof($data[0]);
		$result	     = true;
		for ($i = 1; $i < $data_length && $result; $i++)
			if (sizeof($data[$i]) != $sublength)
                $result = false;
		return $result;
	}// 35
    private function initialize(int $k, array $data)
    {
    	$this->k             = $k;
		$this->data          = $data;
        $this->data_length   = sizeof($data);
		$this->dims          = sizeof($data[0]);
        $this->means         = array();
		$this->clusters      = array();
        $this->cluster_sizes = array();
        for ($i = 0; $i < $this->k; $i++)
        {
            $this->means[$i] = array($this->dims);
            for ($j = 0; $j < $this->dims; $j++)
                $this->means[$i][$j] = rand(0, getrandmax()) / getrandmax();
        }
        for ($i = 0; $i < $this->data_length; $i++)
        {
            $this->clusters[$i] = array();
            for ($j = 0; $j < $this->k; $j++)
                $this->clusters[$i][$j] = [$j, 0];
        }
        $this->cluster_sizes[0] = $this->data_length;
        for ($i = 1; $i < $this->k; $i++)
            $this->cluster_sizes[$i] = 0;
    }// 123
	public function get_means()
    {
        return $this->means;
    }// 8
    public function variance(int $cluster_index, int $point_index)
    {
		if (0 <= $cluster_index && $cluster_index < $this->k && 0 <= $point_index && $point_index < $this->data_length)
        {
			$value = 0;
        	for ($i = 0; $i < $this->dims; $i++)
            	$value += pow($this->data[$point_index][$i] - $this->means[$cluster_index][$i], 2);
		}
		else
			throw new Exception("kmeans.php error: cluster index must be on range [0, k - 1] and point index must be on range [0, data length - 1]");
        return $value;
    }// 47
    public function distance(int $cluster_index, int $point_index)
    {
        return sqrt($this->variance($cluster_index, $point_index));
    }// 15
    private function update_means()
    {
        $old_means = $this->means;
        for ($i = 0; $i < $this->k; $i++)
            for ($j = 0; $j < $this->dims; $j++)
                $this->means[$i][$j] = 0;
        for ($i = 0; $i < $this->data_length; $i++)
            for ($j = 0; $j < $this->dims; $j++)
                $this->means[$this->clusters[$i][0][0]][$j] += $this->data[$i][$j];
        for ($i = 0; $i < $this->k; $i++)
            if ($this->cluster_sizes[$i] == 0)
                for ($j = 0; $j < $this->dims; $j++)
                    $this->means[$i][$j] = rand(0, getrandmax()) / getrandmax();
            else
                for ($j = 0; $j < $this->dims; $j++)
                    $this->means[$i][$j] /= $this->cluster_sizes[$i];
        return $old_means == $this->means ? true : false;
    }// 108
	private function update_clusters()
	{
        for ($i = 0; $i < $this->k; $i++)
            $this->cluster_sizes[$i] = 0;
		for ($i = 0; $i < $this->data_length; $i++)
        {
            for ($j = 0; $j < $this->k; $j++)
                $this->clusters[$i][$j] = [$j, $this->variance($j, $i)];
            $this->sort_cluster($i, 1);
            $this->cluster_sizes[$this->clusters[$i][0][0]]++;
        }
	}// 54
	private function sort_cluster(int $point_index, int $column)
    {
        if ($column == 0 || $column == 1)
        {
			$changed = true;
	        $start   = 0;
	        $end     = $this->k - 1;
	        while ($changed)
	        {
	            $changed = false;
	            for ($i = $start; $i < $end; $i++)
	            {
	                if ($this->clusters[$point_index][$i + 1][$column] < $this->clusters[$point_index][$i][$column])
	                {
	                    $temp = $this->clusters[$point_index][$i];
	                    $this->clusters[$point_index][$i]     = $this->clusters[$point_index][$i + 1];
	                    $this->clusters[$point_index][$i + 1] = $temp;
	                    $changed = true;
	                }
	            }
	            $end--;
	            for ($i = $end; $start < $i; $i--)
	            {
	                if ($this->clusters[$point_index][$i][$column] < $this->clusters[$point_index][$i - 1][$column])
	                {
	                    $temp = $this->clusters[$point_index][$i];
	                    $this->clusters[$point_index][$i]     = $this->clusters[$point_index][$i - 1];
	                    $this->clusters[$point_index][$i - 1] = $temp;
	                    $changed = true;
	                }
	            }
	            $start++;
	        }
		}
    }// 115
    public function run()
    {
        $iterations  = 0;
        $not_changed = false;
        while (!$not_changed && $iterations < 1000)
        {
            $not_changed = $this->update_means();
            $this->update_clusters();
            $iterations++;
        }
        $clusters = array();
        for ($i = 0; $i < $this->data_length; $i++)
            $clusters[$i] = $this->clusters[$i][0][0];
        return $clusters;
    }// 44
}// 590

/// Driver
$k = 5;
$data_length = 20;
$dims = 2;
$data = array();
for ($i = 0; $i < $data_length; $i++)
{
	$data[$i] = array();
	for ($j = 0; $j < $dims; $j++)
		$data[$i][$j] = rand(0, getrandmax()) / getrandmax();
}
$data = array([1], [3], [9], [0], [8], [2], [1], [8], [5], [2]);
$data_length = sizeof($data);
$dims = sizeof($data[0]);

$kmeans   = new kmeans($k, $data);
$clusters = $kmeans->run();
for ($i = 0; $i < sizeof($data); $i++)
{
	print ("\nData[".$i."] = [".number_format($data[$i][0], 1));
	for ($j = 1; $j < $dims; $j++)
		print(" ".number_format($data[$i][$j], 1));
	print("] is in cluster ".$clusters[$i]);
}
