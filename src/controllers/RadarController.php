<?php
/**
 * NavStrike - Radar Controller
 *
 * Handles radar operations, contact tracking, and remote sensor feeds.
 */

class RadarController {
    /**
     * Display local radar contacts
     */
    public function scan() {
        global $conn;
        $sector = $_GET['sector'] ?? 'all';
        $stmt = $mysqli->prepare("SELECT * FROM radar_contacts WHERE sector = ? ORDER BY distance ASC");

		// Lier le paramètre
		$stmt->bind_param("s", $sector);

		// Exécuter
		$stmt->execute();

		// Récupérer les résultats
		$result = $stmt->get_result();
		$contacts = $result->fetch_all(MYSQLI_ASSOC);
        include __DIR__ . '/../../templates/radar.php';
    }

    /**
     * Fetch remote sensor data from allied vessel
     */
    public function scanRemote() {
        $sensorUrl = $_GET['sensor_url'];
        $ch = curl_init($sensorUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $data = curl_exec($ch);
        curl_close($ch);
        echo "<h2>Donnees capteur distant</h2>";
        echo "<pre>" . $data . "</pre>";
    }
}
