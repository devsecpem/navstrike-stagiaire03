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
        $stmt = $pdo->prepare("SELECT * FROM missiles WHERE type = :type AND status != 'EXPENDED'");
		$stmt->execute(['type' => $type]);
		$missiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //return mysqli_query($conn, $query);
    }

    /**
     * Update missile status for launch sequence
     */
    public function updateStatus() {
        global $conn;
        $missileId = $_POST['missile_id'];
        $newStatus = $_POST['status'];
        $assignedTarget = $_POST['target_id'] ?? 'NULL';
        $stmt = $mysqli->prepare("UPDATE missiles SET status = ?, assigned_target = ? WHERE id = ?");
		$stmt->bind_param("sii", $newStatus, $assignedTarget, $missileId);
		$stmt->execute();
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
