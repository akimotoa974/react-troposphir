<?php
/*==============================================================================
  Troposphir - Part of the Troposhir Project
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

require("CRequest.php");
class getGameContextReq extends RequestResponse {
	public function work($json) {
		$this->addBody('assetEndpoint', $this->config_['site'] . $this->config_['dir_assets']);
		$this->addBody('mailboxEndpoint', "");
		$this->addBody('friendsUrl', "");
		$this->addBody('masterServerHost', $this->config_['site']);
		$this->addBody('masterServerPort', 80);
		$this->addBody('natFacilitatorPort', 0);
		$this->addBody('redCarpetTutorialLevelId', 21689);
		$this->addBody('charCustLevelId', 21689);
		$this->addBody('levelBrowserLevelId', 21689);
		$this->addBody('tutorialUserId', 0);
		$this->addBody('unityBundleUrl', "");
		$this->addBody('staticImagesUrl', $this->config_['site'] . $this->config_['dir_imgs']);
		$this->addBody('staticMapUrl', $this->config_['site'] . $this->config_['dir_maps']);
		$this->addBody('staticAvatarUrl', $this->config_['site'] . $this->config_['dir_imgs']);
	}
}
?>