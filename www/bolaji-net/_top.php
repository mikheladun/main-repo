<?php

	require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");
	require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Utils.php");
	$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MEDIA"]);

	$DataA = array(
				"dbanj|suddenly",
				"dagrin|pon pon pon",
				"mi|anoti feat. gabriel",
				"lanreobiskenti|owo feat. sound sultan",
				"sway|my kind of girl feat. tuface idibia",
				"9ice|gongo aso",
				"naetoc|kini big deal",
				"yq|e fi mi le feat. da grin",
				"jmartins|good or bad (Owey) feat. timaya & p square",
				"faze|originality"
			);

	$DataB = array(
				"9ice|street credibility feat. tuface idibia",
				"dbanj|fall in love",
				"eldee|big boy feat. olu maintain & oladele & banky w",
				"alaye|excuse me feat. 9ice",
				"shank|julie",
				"dbanj|gbona fele feli",
				"ruggedman|bangin",
				"dannyyoung|rock dis dance",
				"mohitsallstars|pere feat. d'banj & wande coal & sid & d'prince",
				"bankyw|independence feat. ID Cabasa"
			);

	$DataC = array(
				"ruggedman|bangin",
				"mohitsallstars|ten ten",
				"faze|originality",
				"dbanj|suddenly",
				"freewindz|thats the way",
				"lordofajasa|le fenu so feat. 9ice",
				"lanreobiskenti|owo feat. sound sultan & Xcel",
				"danfodrivers|meshango",
				"soundsultan|oko wan lo de",
				"tufaceidibia|enter the place feat. sound sultan",
				"jahborne|egba mi i like am feat. W4",
				"reminisce|one chance feat. alash & jahbless",
				"slam|e don tey",
				"obiwon|joli",
				"omawumi|in the music",
				"yemisax|bere mole"
			);

	$DataD = array(
				"dj45|venez danser",
				"veeda|bribi yaaye me feat. disastrous & nixon",
				"drsakis|serres moi show",
				"leschicsmen|kolela lela",
				"akatakyie|esi",
				"rexomar|dada dida",
				"5five|afrikan gurlz feat. diojo",
				"madfish|yahooya (wone me baby)",
				"mzbel|e dey be feat. castro destroyer",
				"bradez|one gallon",
				"andyodarki|sweetie feat. batman samini",
				"bukbak|gonja barracks",
				"4x4|hot girls com",
				"fbs|akoko perming"
			);

echo "delete from topsongs;<br/>";
top($DataA, 1, 's');
top($DataB, 2, 's');
echo "delete from topartistvideos;<br/>";
top($DataC, 1, 'v');
top($DataD, 2, 'v');

function top($Data, $Rank, $Type)
{
	global $AppContext;
	global $Service;
	$Counter = 0;
	foreach($Data as $D)
	{
		list($Key,$Value) = split('\|',$D);
		$Params->Nameid = $Key;
		$Params->Title = $Value;
		$Params->Rank = $Rank;
		$Counter++;
		$Response = $Service->Execute(&$AppContext, "GetArtistByName", $Params);
		if($Response->Success)
		{
			$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
			//echo "ArtistInfo: ", $ObjectID->ID;
			$Params->Artistid = $ObjectID->ID;

			$Response = $Service->Execute(&$AppContext, $Type === 's'? "GetSongByName" : "GetArtistVideoByName", $Params);
			if($Response->Success)
			{
				$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
				//echo "SongInfo: ", $ObjectID->ID;
				if($Type === 's')
				{
					$Params->Songid = $ObjectID->ID;
					echo "insert into topsongs (songid,artistid,id,rank) values ($Params->Songid,$Params->Artistid,$Counter,$Params->Rank);<br/>";
				}
				else
				{
					$Params->Videoid = $ObjectID->ID;
					echo "insert into topartistvideos (videoid,artistid,id,rank) values ($Params->Videoid,$Params->Artistid,$Counter,$Params->Rank);<br/>";
				}
			}
		}
	}
}

?>