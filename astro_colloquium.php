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

$details_line_arr = file('astro_colloquium.txt');
$all_speaker_arr = file('html.txt');

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
		$details_arr["date"][] = date('d M-y', strtotime($curryyyymmdd))  . '<br>' . $currtimeval;
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

	#echo sizeof($details_arr["curryearmonval"]), $details_line_split[3], $curryearmonval, $curryyyymmdd, '<br>';
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
		<table>
		<tr>
                <!--<td colspan = 3><font size=4 color =black>&nbsp;&nbsp;&nbsp;</font>&nbsp;&nbsp;&nbsp;-->
		<td>
		<font size=2px color='black'>Welcome to the Astro colloquium page. The seminars are normally held on <strong>Wednesdays at noon in the Level 2 <a href="https://maps.unimelb.edu.au/parkville/building/192/l105" target="_blank">Hercus Theatre </a></strong> <a href="https://www.google.com/maps/place/School+of+Physics/@-37.7967183,144.9638101,15z/data=!4m2!3m1!1s0x0:0x95244083bd9a841?sa=X&ved=2ahUKEwiPtbng8_rvAhU4zzgGHbEfAi8Q_BIwG3oECCoQBQ" target="_blank">David Caro building, School of Physics</a></strong>. Please contact the current seminar organiser <a href="mailto:yuxiang.qin@unimelb.edu.au">Yuxiang Qin</a> for further details. We might support Zoom for some talks using the following link.
		</font>
<br>
<br>
---------------------------------------------------------------
<br>
<font size=2px color='black'>
Topic: UniMelb Astro Colloquiumi<br>
Time: This is a recurring meeting Meet anytime<br>
<br>
Join from PC, Mac, iOS or Android: <a href=https://unimelb.zoom.us/j/88123723593?pwd=cXBaRGp5V3kwd1kzekFTeGRPQzlCQT09>https://unimelb.zoom.us/j/88123723593?pwd=cXBaRGp5V3kwd1kzekFTeGRPQzlCQT09</a><br> 
Password: 192<br>
<br>
Or join by phone:<br>
Dial (Australia): +61 3 7018 2005 or +61 2 8015 6011<br>
Dial (US): +1 669 900 6833 or +1 646 876 9923<br>
Dial (Hong Kong, China): +852 5808 6088 or +852 5803 3730<br>
Dial (UK): +44 203 481 5240 or +44 131 460 1196<br>
Meeting ID: 881 2372 3593<br>
International numbers available: <a href=https://unimelb.zoom.us/u/kcneQZPPcm>https://unimelb.zoom.us/u/kcneQZPPcm</a><br>
<br>
Or join from a H.323/SIP room system:<br>
<br>
Dial:88123723593@zoom.aarnet.edu.au<br>
or SIP:88123723593@zmau.us<br>
or 103.122.166.55<br>
Meeting ID: 88123723593<br>
Password: 192 <br>
		</font>
		</td>
		</tr>
		<tr><td>&nbsp;</td>
		</tr>
		<tr>
		<td>
                <select name = "query_mon_year" id="query_mon_year" style="width: 230px; height: 30px; font-size: 16px" onchange = "this.form.submit()">
		<?php
		if ($_POST[query_mon_year] == "" or $_POST[query_mon_year] == "None")
		{		
		?>
		<option value="None">--All--</option>
		<?php
		}
		else
		{
		?>		
		<!--<option value="<?php echo($_POST[query_mon_year]); ?>"><?php echo (substr($_POST[query_mon_year],0,-2) . "-" . substr($_POST[query_mon_year],-2)) . "-xx"; ?></option>-->	
		<option value="<?php echo($_POST[query_mon_year]); ?>"><?php echo $_POST[query_mon_year]; ?></option>	
	
		<?php
		}
		?>
		<?php
		$i=0;
		while ($i<count($yearmonarr))
		{
			if ($_POST[query_mon_year] == $yearmonarr[$i])
			{			
		?>
			<option value="None">--All--</option>
		<?php
			}
			else
			{

			?>
			<!--<option value="<?php echo($yearmonarr[$i]) ?>"><?php echo (substr($yearmonarr[$i],0,-2) . "-" . substr($yearmonarr[$i],-2)) . "-xx"; ?></option>-->
			<option value="<?php echo($yearmonarr[$i]) ?>"><?php echo $yearmonarr[$i]; ?></option>
			<?php
			}
			$i = $i + 1;
		}
		?>
		</select>
                </td>
		</tr>

		</table>

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
		                        <td>
		                        <strong><font size="3" color="black"><?php echo ($details_arr["slide_link"][$i]); ?></font></strong>
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
							<td width = 65>
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
							<td width = 40 align = 'center'>
							<?php 
							if ($details_arr['slide_link'][$i] != '-')
							{
							?>
								<font size="2" color="black"><a href="<?php echo ($details_arr['slide_link'][$i]); ?>" download><img src='images/download_logo.png' height = 40 width = 40></a></font>
							<?php
							}else{?>
								<font size="2" color="black"><?php echo ($details_arr["slide_link"][$i]); ?></a></font>
							<?php
							}?>

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

