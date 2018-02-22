<?php
/**
 * kmeans.php
 * Nathan Greene
 * Spring 2018
 *
 *
 */

 /**
  * kmeans
  * Clusters similar data types into the nearest cluster of k available clusters.
  */
class kmeans
{
	private $data;		    		// Array of multidimensional points to assign to clusters; data = [ [x0, x1, ...], [x0, x1, ...], ... ]
    private $data_length;   		// Number of data points in data
    private $dims;          		// Number of dimensions in each data point
    private $vars;          		// Array of variances of each data point to each cluster; vars[i][j] = distance of data[i] to clusters[j]
	private $k;			    		// Number of clusters to assign data items to
	private $means;	    			// Array of k points representing the mean of data points assigned to each indexed mean; means = [ [x0, x1, ...], [x0, x1, ...], ... ]
    private $cluster_assignments;   // Array of integers indicating which cluster each point is assigned to; data[i] is assigned to cluster indexed by cluster_assignments[i]
	private $cluster_sizes;			// Array of integers indicating how many data points are assigned to each cluster
	private $rel_variances;			// Experimental: TO DO

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
		if (0 < $k && $this->check_dims($data))
		{
			$this->initialize($k, $data);	// Sets k, data, dims, and cluster assignments
			$this->update_cluster_assignments();
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
			if (sizeof($data[$i] != $sublength))
				$result = false;
		return $result;
	}

	/**
	 * initialize_means(int, [double[]]):void
	 */
    private function initialize(int $k, array $data)
    {
    	$this->k     = $k;
		$this->data  = $data;
		$this->dims  = sizeof($data[0]);
        $this->means = array($this->k);
		$this->cluster_assignments = array($this->data_length);
		$this->cluster_sizes = array($this->k);

		/// Define the mean for each cluster k
        for ($i = 0; $i < $this->k; $i++)
        {
            $this->means[$i] = array($this->dims);
            for ($j = 0; $j < $this->dims; $j++)
                $this->means[$i][$j] = rand(0, 100) / 100;	// option: rand() / getrandmax();
        }
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
	 * update_variances():void
	 * Update the variances property for all points and all clusters (means).
	 */
    private function update_variances()
    {
        for ($i = 0; $i < $this->data_length; $i++)	// Iterate through each data point i
            for ($j = 0; $j < $this->k; $j++)		// Iterate through each cluster j
                $this->vars[$i][$j] = $this->variance($i, $j);
    }

	/**
	 * TO DO
	 */
    private function update_means()
    {
        $change = true;
        $old_means = $this->means;
        for ($i = 0; $i < $this->k; $i++)	// Iterate through each cluster i
        {
			$this->cluster_sizes[$i] = 0;
            for ($j = 0; $j < $this->data_length; $j++)	    // Iterate through each cluster assignment and data point j
			{
				if ($this->cluster_assignments[$j] == $i)   // Check if current cluster assignment i is current cluster i
				{
					for ($k = 0; $k < $this->dims; $k++)	// Iterate through each dimension k
                        $this->means[$i][$j] += $this->data[$j][$k];
					$this->cluster_sizes[$i]++;
				}
			}
        }
        return $change;
    }

	/**
	 * update_cluster_assignments():void
	 * Update cluster assignments by searching through variances property. The
	 * column index (cluster mean) having the smallest variance is set for each
	 * data point index in the cluster assignment property. That is, the cluster
	 * assignment for the ith data point is the index j that has the smallest
	 * value in variances[i][j].
	 */
	private function update_cluster_assignments()
	{
		for ($i = 0; $i < $this->data_length; $i++)
		{
			$assignment = $this->cluster_assignments[$i];
			for ($j = 0; $j < $this->k; $j++)
				if ($this->variances[$i][$j] < $this->variances[$i][$assignment])
				{
					$assignment = $j;
					$this->cluster_assignments[$i] = $assignment;
				}
		}
	}
}

/// Driver
$kmeans = new kmeans(3, array([0.1, 0.2], [0.3, 0.4], [0.5, 0.6], [0.7, 0.8]));
$means  = $kmeans->get_means();
$i = 0;
print("\t\t   x    y\n");
foreach ($means as $cluster)
{
	print("Cluster " . $i . ":\t");
	foreach ($cluster as $value)
		print($value . " ");
	print("\n");
	$i++;
}
