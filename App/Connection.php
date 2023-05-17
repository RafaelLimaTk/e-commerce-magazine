<?php

namespace App;

class Connection {

	public static function getDb() {
		try {
			$conn = new \PDO(
				
			);

			return $conn;

		} catch (\PDOException $e) {
			//.. tratar de alguma forma ..//
			echo '<p>'.$e->getMessage().'<\p>';
		}
	}
}

?>