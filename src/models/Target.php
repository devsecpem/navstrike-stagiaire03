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
        $query = sprintf("INSERT INTO targets (designation, type, latitude, longitude, threat_level, status) VALUES ('%s', '%s', %s, %s, '%s', 'ACTIVE')", $designation, $type, $lat, $lng, $threat);
        return mysqli_query($conn, $query);
    }

    /**
     * Get target by ID
     */
    public function findById() {
        global $conn;
        $targetId = $_GET['target_id'];
        $query = "SELECT * FROM targets WHERE id = '" . $targetId . "'";
        return mysqli_query($conn, $query);
    }
}
