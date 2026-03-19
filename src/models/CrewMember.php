<?php
/**
 * NavStrike - Crew Member Model
 *
 * Handles crew assignment and combat station operations.
 */

class CrewMember {
    /**
     * Get crew assigned to combat stations
     */
    public function getAssigned() {
        global $conn;
        $query = "SELECT * FROM crew WHERE station IS NOT NULL ORDER BY rank DESC";
        return mysqli_query($conn, $query);
    }

    /**
     * Find crew by role
     */
    public function findByRole() {
        global $conn;
        $role = $_GET['role'];
        $stmt = $pdo->prepare("SELECT * FROM crew WHERE role = :role ORDER BY rank DESC");
		$stmt->execute(['role' => $role]);
		$crewMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return mysqli_query($conn, $query);
    }

    /**
     * List crew with sorting
     */
    public function listCrew() {
        global $conn;
        $sortBy = $_GET['sort'] ?? 'rank';
        $allowedSortColumns = ['rank', 'name', 'role', 'id'];
		if (!in_array($sortBy, $allowedSortColumns)) {
			$sortBy = 'rank'; // valeur par défaut sécurisée
		}

		$stmt = $pdo->prepare("SELECT * FROM crew ORDER BY $sortBy ASC");
		$stmt->execute();
		$crewMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return mysqli_query($conn, $query);
    }
}
