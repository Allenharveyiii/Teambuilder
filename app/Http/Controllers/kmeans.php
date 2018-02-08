<?php

class kmeans
{
	private $data;		// Array of multidimensional items to assign to clusters
    private $dims;
	private $k;			// Number of clusters to assign data items to
	private $clusters;	// Array of items representing the mean of data items assigned to each indexed item

	public function __construct(int $k, array $data)
	{
		/// Determine if data is consistently sized
		$sameLength = true;
		$dataLength = sizeof($data);
		$this->dims = sizeof($data[0]);
		$i = 1;
		while ($i < $dataLength && $sameLength)
        {
            if (sizeof($data[$i]) != $this->dims)
                $sameLength = false;
            $i++;
        }

        /// Initialize clusters with random values on range [0, 1]
		if (0 <= $k && $sameLength)
		{
			$this->data = $data;
			$this->initialize_clusters($k, $this->dims);
		}
}

    public function initialize_clusters(int $k, int $dims)
    {
        if (0 < $k && 0 < $dims)
        {
            $this->k = $k;
            $this->clusters = array($this->k);
            for ($i = 0; $i < $this->k; $i++)
            {
                $this->clusters[$i] = array($dims);
                for ($j = 0; $j < $dims; $j++)
                    $this->clusters[$i][$j] = rand(0, 100) / 100;
            }
        }
    }

	public function get_clusters()
    {
        return $this->clusters;
    }

    public function variance(int $cluster_index, int $point_index)
    {
        $value = 0;
        for ($i = 0; $i < $this->dims; $i++)
            $value += pow($this->data[$point_index][$i] - $this->clusters[$cluster_index][$i], 2);
        return value;
    }

    public function distance(int $cluster_index, int $point_index)
    {
        return sqrt($this->variance($cluster_index, $point_index));
    }
}
