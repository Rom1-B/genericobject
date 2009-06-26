<?php


/*----------------------------------------------------------------------
   GLPI - Gestionnaire Libre de Parc Informatique
   Copyright (C) 2003-2008 by the INDEPNET Development Team.

   http://indepnet.net/   http://glpi-project.org/
   ----------------------------------------------------------------------
   LICENSE

   This file is part of GLPI.

   GLPI is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   GLPI is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with GLPI; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
   ----------------------------------------------------------------------*/
/*----------------------------------------------------------------------
    Original Author of file: 
    Purpose of file:
    ----------------------------------------------------------------------*/
$NEEDED_ITEMS=array("reservation","link","computer","printer","networking","monitor","software","peripheral","phone","tracking","document","user","enterprise","contract","infocom","group");

define('GLPI_ROOT', '../../..');
include (GLPI_ROOT . "/inc/includes.php");
header("Content-Type: text/html; charset=UTF-8");
header_nocache();


useplugin('genericobject',true);

if(!isset($_POST["ID"])) {
	exit();
}

$type = new PluginGenericObjectType;
$type->getFromDB($_POST["ID"]);

plugin_genericobject_registerOneType($type->fields);
plugin_genericobject_includeLocales($type->fields["name"]);

if(!isset($_POST["sort"])) $_POST["sort"] = "";
if(!isset($_POST["order"])) $_POST["order"] = "";
if(!isset($_POST["withtemplate"])) $_POST["withtemplate"] = "";

		switch($_POST['glpi_tab']){
			case -1:
					$type->showBehaviourForm($_POST['target'],$_POST["ID"]);
					plugin_genericobject_showObjectFieldsForm($_POST['target'],$_POST["ID"]);
					showHistory(PLUGIN_GENERICOBJECT_TYPE,$_POST["ID"]);
				break;
			case 2 :
					$type->showBehaviourForm($_POST['target'],$_POST["ID"]);
				break;		
			case 3 :
					plugin_genericobject_showObjectFieldsForm($_POST['target'],$_POST["ID"]);
				break;		
			case 4 :
				break;		
			case 5 :
				$type->getFromDB($_POST["ID"]);
				plugin_genericobject_showPrevisualisationForm($type->fields["device_type"]);
			break;
			case 12 :
				showHistory(PLUGIN_GENERICOBJECT_TYPE,$_POST["ID"]);
				break;
		}
?>