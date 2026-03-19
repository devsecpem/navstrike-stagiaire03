<?php
/**
 * NavStrike - Mission Controller
 *
 * Handles mission planning, briefings, crew management, and exports.
 */

require_once __DIR__ . '/../models/CrewMember.php';
require_once __DIR__ . '/../helpers/ReportHelper.php';

class MissionController {
    /**
     * List active missions
     */
    public function list() {
        global $conn;
        $query = "SELECT * FROM missions ORDER BY priority DESC";
        $results = mysqli_query($conn, $query);
        include __DIR__ . '/../../templates/missions.php';
    }

    /**
     * Load mission briefing document
     */
    public function loadBriefing() {
        $briefingFile = $_GET['file'];
        echo "<h2>Briefing de mission</h2>";
        echo "<div>";
        readfile("briefings/" . $briefingFile);
        echo "</div>";
    }

    /**
     * Export mission report
     */
    public function export() {
        $missionId = $_GET['mission_id'] ?? '';
        $format = $_GET['format'] ?? 'pdf';
        $report = new ReportHelper();
        $report->exportReport($missionId, $format);
    }

    /**
     * Display crew assignments
     */
    public function crew() {
        $crew = new CrewMember();
        $results = $crew->getAssigned();
        include __DIR__ . '/../../templates/crew.php';
    }
}
