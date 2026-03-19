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
        $query = "SELECT * FROM radar_contacts WHERE sector = '" . $sector . "' ORDER BY distance ASC";
        $results = mysqli_query($conn, $query);
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
