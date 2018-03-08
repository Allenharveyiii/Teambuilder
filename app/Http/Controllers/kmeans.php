<?php
/**
 * kmeans.php
 * Nathan Greene
 * Spring 2018
 *
 * This file contains the kmeans class, which accepts an integer k as the number
 * of clusters and a list of data points.
 */

 /**
  * kmeans
  * Clusters similar data types into the nearest cluster of k available clusters.
  */
class kmeans
{
	private $data;		    // Array of multidimensional points to assign to clusters; data = [ [x0, x1, ...], [x0, x1, ...], ... ]
    private $data_length;   // Number of data points in data
    private $dims;          // Number of dimensions in each data point
    private $k;			    // Number of clusters to assign data items to
	private $means;	    	// Array of k points representing the mean of data points assigned to each indexed mean; means = [ [x0, x1, ...], [x0, x1, ...], ... ]
    private $clusters;      // Array of integers indicating which cluster each point is assigned to; data[i] is assigned to cluster indexed by clusters[i]
	private $cluster_sizes; // Array of integers indicating how many data points are assigned to each cluster

	/**
	 * kmeans(int,[double[]])
	 * Constructs the kmeans object given k clusters and an array of
	 * double-valued points as the data to cluster. Means are initialized as
	 * random data points on the range [0, 1]. For example, cluster0 might be
	 * defined as
	 * 		means[0] = [ [0.1, 0.2, 0.0], ..., [0.7, 0.3, 0.5] ]
	 * for three-dimensional data points.
	 */
	public function __construct(int $k, array $data)
	{
		/// k must be positive, all data dimensions must be equal
		if (0 < $k && $this->check_dims($data))
		{
			$this->initialize($k, $data);
			//$this->update_clusters();
		}
		else
		    $this->die("kmeans.php error: Invalid choice of k or data is inconsistently defined.");
	}

	/**
	 * check_dims([double[]]):bool
	 * Determine if all sublists are of the same length. This function is a
	 * stand-alone function that is independent of the properties that define
	 * this kmeans class.
	 */
	private function check_dims(array $data)
	{
		$data_length = sizeof($data);
		$sublength   = sizeof($data[0]);	// Number of dimensions in each data point
		$result	     = true;				// Result of each comparison to return
		for ($i = 1; $i < $data_length && $result; $i++)
			if (sizeof($data[$i]) != $sublength)
                $result = false;
		return $result;
	}

	/**
	 * initialize_means(int, [double[]]):void
	 */
    private function initialize(int $k, array $data)
    {
    	$this->k             = $k;
		$this->data          = $data;
        $this->data_length   = sizeof($data);
		$this->dims          = sizeof($data[0]);
        $this->means         = array();
		$this->clusters      = array();
        $this->cluster_sizes = array();

		/// Define the mean for each cluster i as a random value on the range [0, 1]
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
    }

	/**
	 * get_means():[double[]]
	 * Retrieve the means attribute.
	 */
	public function get_means()
    {
        return $this->means;
    }

	/**
	 * variance(int, int):double
	 * Determine the variance of a point to a cluster (mean).
	 */
    public function variance(int $cluster_index, int $point_index)
    {
		if (0 <= $cluster_index && $cluster_index < $this->k && 0 <= $point_index && $point_index < $this->data_length)
        {
			$value = 0;
        	for ($i = 0; $i < $this->dims; $i++)
            	$value += pow($this->data[$point_index][$i] - $this->means[$cluster_index][$i], 2);
		}
		else
			throw new ArgumentOutOfRangeException("kmeans.php error: cluster index must be on range [0, k - 1] and point index must be on range [0, data length - 1]");
        return $value;
    }

	/**
	 * distance(int, int):double
	 * Determine the Euclidean distance from a data point to a given cluster
	 * (mean).
	 */
    public function distance(int $cluster_index, int $point_index)
    {
        return sqrt($this->variance($cluster_index, $point_index));
    }

	/**
	 * TODO
	 */
    private function update_means()
    {
        /// Save means for comparison
        $old_means = $this->means;

        /// Reset means to zero
        for ($i = 0; $i < $this->k; $i++)
            for ($j = 0; $j < $this->dims; $j++)
                $this->means[$i][$j] = 0;

        for ($i = 0; $i < $this->data_length; $i++)
            for ($j = 0; $j < $this->dims; $j++)
                $this->means[$this->clusters[$i][0][0]][$j] += $this->data[$i][$j];  // Add each data point to mean that it is assigned to

        /// Iterate through each mean dividing by size. If size is zero, redefine mean as random point.
        for ($i = 0; $i < $this->k; $i++)
            if ($this->cluster_sizes[$i] == 0)
                for ($j = 0; $j < $this->dims; $j++)
                    $this->means[$i][$j] = rand(0, getrandmax()) / getrandmax();
            else
                for ($j = 0; $j < $this->dims; $j++)
                    $this->means[$i][$j] /= $this->cluster_sizes[$i];
        return $old_means == $this->means ? true : false;   // Return true if no change occurs
    }

	/**
	 * update_clusters():void
	 * Update cluster assignments by searching through variances property. The
	 * column index (cluster mean) having the smallest variance is set for each
	 * data point index in the cluster assignment property. That is, the cluster
	 * assignment for the ith data point is the index j that has the smallest
	 * value in variances[i][j].
	 */
	private function update_clusters()
	{
        print ("\n\nClusters BEFORE sorting");
        for ($i = 0; $i < $this->k; $i++)
            $this->display_cluster($i);

        /// Reset cluster sizes to zero
        for ($i = 0; $i < $this->k; $i++)
            $this->cluster_sizes[$i] = 0;

		for ($i = 0; $i < $this->data_length; $i++)
        {
            for ($j = 0; $j < $this->k; $j++)
                $this->clusters[$i][$j] = [$j, $this->variance($j, $i)];    // Set variance for each cluster j to data point i
            $this->sort_cluster($i, false);							// True sorts on cluster id; False sorts on variance
            $this->cluster_sizes[$this->clusters[$i][0][0]]++;              // Increment the size of cluster in which data point i is now assigned to
        }

//        print ("\n\nClusters AFTER sorting");
//        for ($i = 0; $i < $this->k; $i++)
//            $this->display_cluster($i);
	}

    /**
     * @param array $cluster_pq
     * @param bool $cluster_id
     *
     * Just cocktailsort for now. TODO: Quicksort.
     */
	private function sort_cluster(int $point_index, bool $cluster_id)
    {
        if ($cluster_id)
            $col = 0;   // sort on cluster id
        else
            $col = 1;   // sort on variance
        $changed = true;
        $start   = 0;
        $end     = $this->k - 1;
        while ($changed)
        {
            $changed = false;
            for ($i = $start; $i < $end; $i++)
            {
                if ($this->clusters[$point_index][$i + 1][$col] < $this->clusters[$point_index][$i][$col])
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
                if ($this->clusters[$point_index][$i][$col] < $this->clusters[$point_index][$i - 1][$col])
                {
                    $temp = $this->clusters[$point_index][$i];
                    $this->clusters[$point_index][$i]     = $this->clusters[$point_index][$i - 1];
                    $this->clusters[$point_index][$i - 1] = $temp;
                    $changed = true;
                }
            }
            $start++;
        }
		/*for ($i = 1; $i < $this->k; $i++)
		{
			if ($this->clusters[$point_index][$i][$col] < $this->clusters[$point_index][0][$col])
			{
				$temp = $this->clusters[$point_index][0];
				$this->clusters[$point_index][0]  = $this->clusters[$point_index][$i];
				$this->clusters[$point_index][$i] = $temp;
			}
		}*/
    }

    public function run()
    {
        $notchanged = false;
        for ($i = 0; $i < 25 && !$notchanged; $i++)
        {
            print("\nStep ".$i);
            $notchanged = $this->update_means();
            $this->update_clusters();
            if ($notchanged)
                print ("\nIt converged.");
        }
    }

    public function display_cluster(int $cluster_index)
    {
        print ("\n\ncluster ".$cluster_index." = ".$this->display_mean($cluster_index)." of size ".$this->cluster_sizes[$cluster_index]);
        for ($i = 0; $i < $this->data_length; $i++)
            if ($this->clusters[$i][0][0] == $cluster_index)
                print ("\npoint ".$i." = ".$this->display_point($i)." has var = ".number_format($this->variance($cluster_index, $i),2)." and belongs to cluster ".$this->clusters[$i][0][0]);    //$this->clusters[$i][0][1]
    }

    public function display_mean(int $mean_index)
    {
        $value = "[";
        for ($i = 0; $i < $this->dims; $i++)
            $value .= " ".number_format($this->means[$mean_index][$i], 2);
        $value .= "]";
        return $value;
    }

    public function display_point(int $point_index)
    {
        $value = "[";
        for ($i = 0; $i < $this->dims; $i++)
            $value .= " ".number_format($this->data[$point_index][$i],2);
        $value .= "]";
        return $value;
    }
}

/// Driver
$kmeans = new kmeans(2, array([0.1, 0.2], [0.3, 0.4], [0.5, 0.6], [0.7, 0.8]));
$means  = $kmeans->get_means();
$means  = $kmeans->run();
$i = 0;
print("\t\t   x       y\n");
foreach ($means as $cluster)
{
	print("Cluster " . $i . ":\t");
	foreach ($cluster as $value)
		print(number_format($value, 2) . "\t"); // or round(,)
	print("\n");
	$i++;
}
