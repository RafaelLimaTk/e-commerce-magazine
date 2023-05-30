<?php

namespace App;

class Connection {

	public static function getDb() {
		try {

			$conn = new \PDO(
				"mysql:host=185.213.81.205;dbname=u182528050_p3g1",
				"u182528050_p3g1",
				"gF2WsJ!9e"
			);

			return $conn;

		} catch (\PDOException $e) {
			//.. tratar de alguma forma ..//
		}
	}
}

?>