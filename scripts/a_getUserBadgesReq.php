<?php
/*==============================================================================
  Troposphir - Part of the Troposphir Project
  Copyright (C) 2013  Kevin Sonoda, Leonardo Giovanni Scur

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License as
  published by the Free Software Foundation, either version 3 of the
  License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License 
  along with this program.  If not, see <http://www.gnu.org/licenses/>.    
==============================================================================*/
if (!defined("INCLUDE_SCRIPT")) return;
class a_getUserBadgesReq extends RequestResponse {
	public function work($json) {
		if(!isset($json['body']['uid'])) return;
		$fields = array("wins", "losses", "abandons");
		
		$db = new Database($this->config['driver'], $this->config['host'], $this->config['dbname'], $this->config['user'], $this->config['password']);
		$statement = $db->query("SELECT @fields FROM `@table` WHERE `userId`='@userId'", array(
			"fields" 	=> $db->arrayToSQLGroup($fields, array("", "", "`")),
			"table" 	=> $this->config["table_user"],
			"userId"    => $json['body']['uid']
		));
		
		$db = new Database($this->config['driver'], $this->config['host'], $this->config['dbname'], $this->config['user'], $this->config['password']);
		$statement = $db->prepare("SELECT " . $db->arrayToSQLGroup($fields, array("", "", "`")) .  
		" FROM " . $this->config["table_map"] .
		" WHERE `userId`=:userId");
		$statement->bindValue(':userId', $json['body']['uid'], PDO::PARAM_INT);
		$statement->execute();		
		
		$row = $statement->fetch();
		if ($row == false || count($row) <= 0) {
			$this->error("NOT_FOUND");
		} else {
			$this->addBody("won", (integer)$row['wins']);
			$this->addBody("lost", (integer)$row['losses']);
			$this->addBody("abandoned", (integer)$row['abandons']);
		}
	}
}
?>