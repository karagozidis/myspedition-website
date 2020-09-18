<div class="box">
 <!-- <div class="box-heading"><?php echo $heading_title; ?></div>-->
 <div class="box-content" style="border-radius: 7px 7px 7px 7px;border-top: 1px solid #DBDEE1;">
     
      <table  border="0"  style="width: 145px;height: 40px;Margin-right: auto;margin-left: auto;" cellpadding="2" cellspacing="2">
                <tr align="center">
                    <td>
                         <div onclick="loadPreviousMonth()" style="cursor: pointer" > <img src="image/arrow_prev.png" width="20"> </div>
                    </td>
                    <td colspan="5">
                        <div id="calHeader"> 
                            <a href="?route=product/calendar&month=<?php echo $cMonth; ?>&year=<?php echo $cYear; ?>">
                            <?php echo $monthNames[$cMonth-1].' '.$cYear; ?> 
                            </a>
                        </div>
                    </td>
                    <td>
                         <div onclick="loadNextMonth()" style="cursor: pointer" > <img src="image/arrow_next.png" width="20"> </div>
                    </td>
                </tr>
      </table>
            
            
             <div id="calForm" >
                <table style='Margin-right: auto;margin-left: auto;' border="0" cellpadding="2" cellspacing="2" style="border-color: #666;">
                <tr>
                    <td align="center" bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;' ><strong>S</strong></td>
                    <td align="center" bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>M</strong></td>
                    <td align="center" bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>T</strong></td>
                    <td align="center" bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>W</strong></td>
                    <td align="center" bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>T</strong></td>
                    <td align="center" bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>F</strong></td>
                    <td align="center" bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>S</strong></td>
                </tr>
                
                <?php 
                $timestamp = mktime(0,0,0,$cMonth,1,$cYear);
                $maxday = date("t",$timestamp);
                

                $thismonth = getdate ($timestamp);
                $startday = $thismonth['wday'];
                $found = false; 
                for ($i=0; $i<($maxday+$startday); $i++) {
                    if(($i % 7) == 0 ) 
                        {
                        echo "<tr>";
                        }
                        
                    if($i < $startday)
                        {
                        echo "<td></td>";
                        }
                    else
                        {
                        
                        $foundNode = false;
                        foreach ($nodeDays as $day)
                            {
                             if ($day['DAYS'] == ($i - $startday + 1) ) $foundNode = true;
                            }
                        
                        $found = false;
                        foreach ($ftDays as $day)
                            {
                             if ($day['DAYS'] == ($i - $startday + 1) ) $found = true;
                            }
                            
                            
                        if($found)
                            {
                             echo "<td align='center' valign='middle' style='border: 1px #0C99E9 solid;' height='20px'>";
                             echo "<a href='?route=product/calendar/nodelist&year=".$cYear."&month=".$cMonth."&day=".$day['DAYS']."' > "; ;
                             echo ($i - $startday + 1) ;
                             echo "</a>";
                             echo "</td>";
                            }
                        else if ($foundNode)
                            {
                             echo "<td align='center' valign='middle' style='border: 1px #75DF2F solid;' height='20px'>";
                             echo "<a href='?route=product/calendar/nodelist&year=".$cYear."&month=".$cMonth."&day=".$day['DAYS']."' > "; ;
                             echo ($i - $startday + 1) ;
                             echo "</a>";
                             echo "</td>";
                            }
                        else
                            {
                             echo "<td align='center' valign='middle' height='20px'>". ($i - $startday + 1) . "</td>";
                            } 
                            
                            
                            
                            
                        }
                        
                    if(($i % 7) == 6 ) 
                        {
                        echo "</tr>";
                        }
                }
                ?>

                <tr>
                    <td>
                        <div style="background-color: #E0E0E0;border: 1px solid #BBDF8D;-webkit-border-radius: 5px 5px 5px 5px;">
                        <a href="?route=product/calendar&month=<?php echo $cMonth; ?>&year=<?php echo $cYear; ?>">
                            <img src='image/zoom.png' width="17">
                        </a>
                        </div>
                    </td>
                    <td><div id="loading_area"></div></td>
                </tr>
           </table>
         </div>
            
      
      
      
      
      
      
  </div>
</div>

<script type="text/javascript">
  
 var monthNames=new Array("January","February","March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December" );   
 var month = "<?php echo $cMonth; ?>";
 var year = "<?php echo $cYear; ?>";
 var loading_icon = false; 
 function loadPreviousMonth()
    {
        
        if (this.month == 1 )
            {
            this.month = 12
            this.year --;
            }
        else 
            {
             this.month --;   
            }
        
         loadMonth();
            
    }
    
     function loadNextMonth()
    {
         if (this.month == 12 )
            {
            this.month = 1
            this.year ++;
            }
        else 
            {
             this.month ++;   
            }
        
         loadMonth();
         
    }
    
    
    
    function loadMonth()
    {
 
       $.ajax({
		url: 'index.php?route=module/calendar/loadMonth&month=' + this.month+'&year='+this.year,
		dataType: 'json',
		beforeSend: function() {
			if(loading_icon == false)
                            {
                            $('#loading_area').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
                            loading_icon = true;
                            }
		},
		complete: function() {
			$('.wait').remove();
                        loading_icon  = false ;
		},			
		success: function(json) {
                    //alert(json['result']);
                    $( "#calForm" ).html(json['result']);
                    $( "#calHeader" ).html(
                            "<a href='?route=product/calendar&month="+month+"&year="+year+"'>"+
                            monthNames[month-1]+ " "+ year+
                            "</a>"         
                            );
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

    }
     
    
    
</script>   
