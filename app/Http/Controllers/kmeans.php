<?php
/*******************************************************************************
 * kmeans.php
 *******************************************************************************
 * Nathan Greene
 * Spring 2018
 *
 * This file contains the kmeans class, which accepts an integer k as
 * the number of clusters and a list of data points.
 */

 /******************************************************************************
  * kmeans class
  ******************************************************************************
  * Clusters similar data types into the nearest cluster of k available
  * clusters.
  */
class kmeans
{
	private $data;		    // Array of multidimensional points to assign to clusters; data = [[x0, x1, ...], [x0, x1, ...], ...]
    private $data_length;   // Number of data points in data
    private $dims;          // Number of dimensions in each data point
    private $k;			    // Number of clusters to assign data items to
	private $means;	    	// Array of k points representing the mean of data points assigned to each indexed mean; means = [[x0, x1, ...], [x0, x1, ...], ...]
    private $clusters;      // Array of integers indicating which cluster each point is assigned to; data[i] = [[c0, vi0], [c1, vi1], ...] is a priority queue of clusters with variances
	private $cluster_sizes; // Array of integers indicating how many data points are assigned to each cluster

    /***************************************************************************
     * kmeans (int, [float[]])
     ***************************************************************************
     * Constructs the kmeans object given k clusters and an array of numeric
	 * points as the data to cluster. Means are initialized as random data
	 * points on the range [0, 1].
     * @param int $k
     * @param array $data
     */
	public function __construct(int $k, array $data)
	{
		if (0 < $k && $this->check_dims($data))
			$this->initialize($k, $data);
		else
		    die ("kmeans.php error: Invalid choice of k or data is inconsistently defined.");
	}

	/***************************************************************************
	 * check_dims ([float[]]):bool
     ***************************************************************************
	 * Returns true if all data points are of the same length and false if
	 * otherwise.
     * @param array $data
     * @return bool $result
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

	/***************************************************************************
	 * initialize_means(int, [float[]]):void
	 ***************************************************************************
	 * Initializes all properties of the kmeans class. Assumes k > 0 and data
	 * dimensions are consistent. Further assumes data is all numeric.
	 * @param int $k
	 * @param array $data
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

	/***************************************************************************
	 * get_means ():[float[]]
	 ***************************************************************************
	 * Retrieve the means attribute.
	 * @return array $this->means
	 */
	public function get_means()
    {
        return $this->means;
    }

	/***************************************************************************
	 * variance (int, int):float
	 ***************************************************************************
	 * Determine the variance of a point to a cluster (mean).
	 * @param int $cluster_index
	 * @param int $point_index
	 * @return float $value
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
			throw new Exception("kmeans.php error: cluster index must be on range [0, k - 1] and point index must be on range [0, data length - 1]");
        return $value;
    }

	/***************************************************************************
	 * distance (int, int):float
     ***************************************************************************
	 * Determine the Euclidean distance from a data point to a given cluster
	 * (mean).
	 * @param int $cluster_index
	 * @param int $point_index
	 * @return float
	 */
    public function distance(int $cluster_index, int $point_index)
    {
        return sqrt($this->variance($cluster_index, $point_index));
    }

	/***************************************************************************
	 * update_means():bool
	 ***************************************************************************
     * Update all means as the average value of the data points assigned to each
	 * mean. If no change occurs in the means, returns true. Otherwise, returns
	 * false.
	 * @return bool
	 */
    private function update_means()
    {
        /// Save means for comparison
        $old_means = $this->means;

        /// Reset means to zero
        for ($i = 0; $i < $this->k; $i++)
            for ($j = 0; $j < $this->dims; $j++)
                $this->means[$i][$j] = 0;

		/// Update means as the sum of all assigned data points. Data points are
		/// assigned as the index of the first cluster in the cluster queue.
        for ($i = 0; $i < $this->data_length; $i++)
            for ($j = 0; $j < $this->dims; $j++)
                $this->means[$this->clusters[$i][0][0]][$j] += $this->data[$i][$j];  // Add each data point to mean that it is assigned to

        /// Iterate through each mean dividing by size. If size is zero,
		/// redefine mean i as a random point.
        for ($i = 0; $i < $this->k; $i++)
            if ($this->cluster_sizes[$i] == 0)
                for ($j = 0; $j < $this->dims; $j++)
                    $this->means[$i][$j] = rand(0, getrandmax()) / getrandmax();
            else
                for ($j = 0; $j < $this->dims; $j++)
                    $this->means[$i][$j] /= $this->cluster_sizes[$i];
        return $old_means == $this->means ? true : false;   // Return true if no change occurs
    }

	/***************************************************************************
	 * update_clusters():void
	 ***************************************************************************
	 * Update cluster assignments by searching through variances property. The
	 * column index (cluster mean) having the smallest variance is set for each
	 * data point index in the cluster assignment property. That is, the cluster
	 * assignment for the ith data point is the index j that has the smallest
	 * value in variances[i][j].
	 */
	private function update_clusters()
	{
        /// Reset cluster sizes to zero
        for ($i = 0; $i < $this->k; $i++)
            $this->cluster_sizes[$i] = 0;

        /// Compute the variance for each cluster j in the queue for each data point i
        /// Sort the cluster queue i based on variance
        /// Update the size of the cluster data point i is assigned to (having the smallest variance)
		for ($i = 0; $i < $this->data_length; $i++)
        {
            for ($j = 0; $j < $this->k; $j++)
                $this->clusters[$i][$j] = [$j, $this->variance($j, $i)];    // Set variance for each cluster j to data point i
            $this->sort_cluster($i, 1);										// 0 sorts on cluster id; 1 sorts on variance
            $this->cluster_sizes[$this->clusters[$i][0][0]]++;              // Increment the size of cluster in which data point i is now assigned to
        }
	}

    /***************************************************************************
	 * sort_cluster(int, int):void
	 ***************************************************************************
	 * Sorts the cluster queue of the specified data point on the specified
	 * column. If zero is passed, then the cluster queue is sorted on the
	 * cluster index. If one is passed, then the cluster queue is sorted on the
	 * variance of the specified point to the clusters. This sorting method is
	 * commonly called cocktail sorting and is analagous to bubble sorting in
	 * both directions.
     * @param array $point_index
     * @param int $column
     */
	private function sort_cluster(int $point_index, int $column)
    {
        if ($column == 0 || $column == 1)
        {
			$changed = true;			// Indicates if change occurs in sorting
	        $start   = 0;				// Left index to iterate from
	        $end     = $this->k - 1;	// Right index to iterate to
	        while ($changed)
	        {
	            $changed = false;

				/// Bubblesort forward pushing largest value right
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

				/// Bubblesort backward pushing smallest value left
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
    }

	/***************************************************************************
	 * run():[int]
	 ***************************************************************************
	 * Performs kmeans algorithm by repeatedly updating means until no change
	 * occurs (i.e. means converge). Returns the cluster assignments for the
	 * data points in their original positions. That is, cluster i = j means
	 * data point i is in the cluster identified as j.
	 * @return array $clusters
	 */
    public function run()
    {
        $iterations  = 0;		// Keeps kmeans from running indefinitely
        $not_changed = false;	// Indicates if change occurs (convergence)
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
    }
}

/// Driver
$k = 5;
$data_length = 1000;
$dims = 3;
//$data = array([3], [5], [9], [8], [2], [3], [7], [8], [4], [9]);
$data = array();
for ($i = 0; $i < $data_length; $i++)
{
	$data[$i] = array();
	for ($j = 0; $j < $dims; $j++)
		$data[$i][$j] = rand(0, getrandmax()) / getrandmax();
}
$kmeans   = new kmeans($k, $data);
$clusters = $kmeans->run();
for ($i = 0; $i < sizeof($data); $i++)
{
	print ("\nData point ".$i." = [".number_format($data[$i][0] ,1));
	for ($j = 1; $j < $dims; $j++)
		print(" ".number_format($data[$i][$j], 1));
	print("] is in cluster ".$clusters[$i]);
}
