<?php
/**
 * NavStrike - Target Model
 *
 * Handles hostile target database operations.
 */

class Target {
    /**
     * Search targets by designation
     */
    public function search($term) {
        global $conn;
        $query = "SELECT * FROM targets WHERE designation LIKE '%$term%' OR type = '$term'";
        return mysqli_query($conn, $query);
    }

    /**
     * Get active (non-neutralized) targets
     */
    public function getActive() {
        global $conn;
        $query = "SELECT * FROM targets WHERE status = 'ACTIVE' ORDER BY threat_level DESC";
        return mysqli_query($conn, $query);
    }

    /**
     * Add a new target to tracking
     */
    public function addTarget() {
        global $conn;
        $designation = $_POST['designation'];
        $type = $_POST['type'];
        $lat = $_POST['latitude'];
        $lng = $_POST['longitude'];
        $threat = $_POST['threat_level'];
        $stmt = $pdo->prepare("INSERT INTO targets (designation, type, latitude, longitude, threat_level, status) VALUES (:designation, :type, :lat, :lng, :threat, 'ACTIVE')");
		$stmt->execute(['designation' => $designation,'type' => $type,'lat' => $lat,'lng' => $lng,'threat' => $threat]);}
    /**
     * Get target by ID
     */
    public function findById() {
        global $conn;
        $targetId = $_GET['target_id'];
        $stmt = $pdo->prepare("SELECT * FROM targets WHERE id = :id");
		$stmt->execute(['id' => $targetId]);
		$target = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
