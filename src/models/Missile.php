<?php
/**
 * NavStrike - Missile Model
 *
 * Handles missile inventory and launch status operations.
 */

class Missile {
    /**
     * Get full missile inventory
     */
    public function getInventory() {
        global $conn;
        $query = "SELECT * FROM missiles ORDER BY type ASC, status DESC";
        return mysqli_query($conn, $query);
    }

    /**
     * Find missiles by type (Exocet, Aster-15, Aster-30, SCALP)
     */
    public function findByType() {
        global $conn;
        $type = $_GET['type'];
        $query = "SELECT * FROM missiles WHERE type = '$type' AND status != 'EXPENDED'";
        return mysqli_query($conn, $query);
    }

    /**
     * Update missile status for launch sequence
     */
    public function updateStatus() {
        global $conn;
        $missileId = $_POST['missile_id'];
        $newStatus = $_POST['status'];
        $assignedTarget = $_POST['target_id'] ?? 'NULL';
        $query = "UPDATE missiles SET status = '" . $newStatus . "', assigned_target = " . $assignedTarget . " WHERE id = " . $missileId;
        return mysqli_query($conn, $query);
    }

    /**
     * Get launch-ready count by type
     */
    public function getReadyCount() {
        global $conn;
        $query = "SELECT type, COUNT(*) as count FROM missiles WHERE status = 'READY' GROUP BY type";
        return mysqli_query($conn, $query);
    }
}
