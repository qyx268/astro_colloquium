<html>
<head>
<title>Astro Colloquium @ UniMelb</title>
</head>
<style type="text/css">
a:link {color: blue; text-decoration: underline; }
a:active {color: blue; text-decoration: underline; }
a:visited {color: blue; text-decoration: underline; }
.profile-pic{
    width: 60;
    height: 60;
    position: left;
    border-radius: 60%;
    overflow: hidden;
    border-top: 0.1px solid #111;
    border-right: 0.1px solid #111;
    background: #fff;
}
body{
margin:0.5em;
background-color: #FFFFFE;
font-family: Optima;
}

</style>

<?php

$details_line_arr = file('astro_colloquium_upcoming.txt');
$all_speaker_arr = file('html_upcoming.txt');

$yearmonarr = array();
$i = 0;
$j = 0;
while ($i <= count($details_line_arr)) 
{
	if (strlen(trim($details_line_arr[$i])) <= 1){$i = $i + 1;continue;}
	/*if (strpos($details_line_arr[$i],'#') !== FALSE)
	{
		$i = $i + 1; continue;
	}*/
	$details_line_split = preg_split('/%%%/', $details_line_arr[$i], -1, PREG_SPLIT_NO_EMPTY);
	$slide_link = trim($details_line_split[sizeof($details_line_split)-1]);

	if ($details_line_split[0] != '#Date')
	{
		#$curryearmonval = substr($details_line_split[0],0,-2);
		$curryearval = substr($details_line_split[0],0,-4);
		$currmonval = substr($details_line_split[0],-4,-2);
		$currdateval = substr($details_line_split[0],-2);
		$currtimeval = $details_line_split[1];

		$curryyyymmdd = $curryearval . '-' . $currmonval  . '-' . $currdateval;
		$curryearmonval = 'seminars: ' . date('M-Y', strtotime($curryyyymmdd));
		$details_arr["curryearmonval"][] = $curryearmonval;

		if (in_array($curryearmonval,$yearmonarr) === FALSE)
			{
			$yearmonarr[] = $curryearmonval;
			}
		$details_arr["date"][] = nl2br(date('d M-y', strtotime($curryyyymmdd))  . " \n " . $currtimeval);
		$op_page_name = "talks/" . $all_speaker_arr[$j] . ".html";
		$details_arr["link"][] = $op_page_name;
		if ($slide_link != '-')
		{
			$slide_link = 'talks/slides/' . $slide_link;
		}
	    $j = $j + 1;

	}
	else
	{
		$details_arr["date"][] = str_replace("#", "", $details_line_split[0]);
		$details_arr["curryearmonval"][] = 0;
		$details_arr["link"][] = 'N.A.';

	}

	#echo sizeof($details_arr["curryearmonval"]), $details_line_split[3], $curryearmonval, $curryyyymmdd, nl2br('\n');
	#$details_arr["link"][] = $details_line_split[1];
	#$details_arr["desc"][] = $details_line_split[2];
	$details_arr["person"][] = $details_line_split[3];
	$details_arr["affiliation"][] = $details_line_split[4];
	$details_arr["title"][] = trim($details_line_split[5]);
	$details_arr["profilephoto"][] = 'images/' . trim($details_line_split[9]);
	$details_arr["slide_link"][] = $slide_link;
	$i = $i + 1;
}
$yearmonarr = array_unique($yearmonarr);
?>

<body>

<table>
<tr>
        <td>

	<form name="astro_colloquium" action="" id="astro_colloquium" method="post">

<!-- Main content -->
	    <!--
	    <tr>     
	       <td width="10px"></td>
               <td width="800px">
		<font size="5" color="black">The University of Melbourne -    
		<font size="3" color="black" face="Sans">School of Physics, and Astronomy</u></font>
               </td>
            </tr>

		<tr>
			<td>&nbsp;</td>
                <td></td>
		</tr>

	    <tr>     
	       <td></td>
               <td>
		<font size="3" color="#cb4154"><b>When:</b></font><font size="3" color ="#333333">&nbsp;&nbsp;&nbsp;Tuesdays (Fortnightly) @ 1600 hrs
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<font size="3" color="#cb4154"><b>Where:</b></font><font size="3" color="#333333">&nbsp;&nbsp;&nbsp;CAASTRO video conf. room
                </td>
            </tr>
        

		<tr>
			<td>&nbsp;</td>
		</tr>

		-->
		<font size=2px color='black'> <strong>Current and past schedule is <a href="index.html" target="_self">here</a></strong> </font>
		<div style="border: 1px solid black">

                <tr>
                        <td>
                        <table width = 680 border = 0>
		<?php

			$i=0;
			while ($i<count($details_arr["date"]))
			{
			?>

		                <tr>
		                        
		                        <?php
		                        if ($i==0)
		                        {
		                        ?>
		                        <td>
		                        <strong><font size="3" color="black"><?php echo ($details_arr["date"][$i]); ?></font></strong>
		                        </td>
		                        <td colspan=2>
		                        <strong><font size="3" color="black"><?php echo ($details_arr["person"][$i] . '/' . $details_arr["affiliation"][$i]); ?></font></strong>
		                        </td>
		                        <td>
		                        <strong><font size="3" color="black"><?php echo ($details_arr["title"][$i]); ?></font></strong>
		                        </td>
					<tr>
						<td colspan = 5><hr color='black'></td>
					</tr>

		                        <?php
		                        }
		                        else
		                        {
						#$curryearmonval = substr($details_arr["date"][$i],0,-2);
						$curryearmonval = $details_arr["curryearmonval"][$i];
						if ($curryearmonval == $_POST[query_mon_year] or $_POST[query_mon_year] == "" or $_POST[query_mon_year] == "None")
						{
				                ?>
							<td width = 75>
							<font size="2" color="black"><?php echo ($details_arr["date"][$i]); ?></font>
						        </td>
							<td>
							      <div class="profile-pic">
								<a href="<?php echo ($details_arr['link'][$i]); ?>" target="_blank"><img alt="<?php echo ($details_arr['profilephoto'][$i]); ?>" src="<?php echo ($details_arr['profilephoto'][$i]); ?>" itemprop="image" width=60 height=60></a>&nbsp;&nbsp;&nbsp;
							      </div>
						        </td>
						        <td width = 170>
							<!--<font size="2" color="black"><em><strong><?php echo ($details_arr["person"][$i]); ?></strong></em></font>-->
							<font size="2" color="black" align='left'><em><strong><?php echo ($details_arr["person"][$i]); ?></strong></em><br><?php echo ($details_arr["affiliation"][$i]); ?></font>
						        </td>
							<td width = 300>
							<font size="2" color="black"><a href="<?php echo ($details_arr['link'][$i]); ?>" target="_blank"><?php echo ($details_arr["title"][$i]); ?></a></font>
						        </td>
							<tr>
								<td colspan = 5><hr color = 'gray' size=1></td>
							</tr>

				                <?php
						}
		                        }
		                        ?>
		                </tr>


			<?php
		                $i=$i+1;		
			}
		?>

                        </table>

                        </td>
                </tr>

			</div>
		</td>

	</tr>
	</form>
</td></tr>
</table>
</body>
</html>

