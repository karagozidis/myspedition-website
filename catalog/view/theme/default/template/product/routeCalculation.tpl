<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
    <?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1>
      <img src="image/market.png" width=30 height=30>
      <?php echo $heading_title; ?>
  </h1>

  <div class="product-compare">
      <div style="font-size:150%"> <?php echo $welcome; ?> </div> <br><br>
  <?php echo $description; ?>
  </div>
    
   <div class="box1">
       <div class="heading">  
           <h1> Options  </h1> 
       </div>
       <div class="content1">
            <table> 
               <tr> 
                    <td> 
                        From
                        <input type="text" id="fromArea" value="">              
                    </td>
                    <td> 
                        Weather
                        <input type="checkbox" checked name="weather"  onclick="showweather(this)">&nbsp;&nbsp;
                        Clouds
                        <input type="checkbox" name="clouds"  onclick="showclouds(this)"> 
                    </td>
                    <td></td> 
                    <td></td>
                    <td></td>
                </tr>
                <tr>              
                    <td>
                        To
                        <input type="text" id="toArea" value=""> 
                    </td>
                    <td>
                      <input type="button" id="SbmBtn" value="Show" onclick="showDirections()"> 
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                <td>Via</td>
                <td colspan="4"></td>
                </tr>          
               <tr> 
                    <td> 
                        1.<input type="text" id="waypoint0" value="">              
                    </td>
                    <td> 
                        2.<input type="text" id="waypoint1" value="">   
                    </td>
                    <td>
                        3. <input type="text" id="waypoint2" value="">   
                    </td> 
                    <td>
                        4. <input type="text" id="waypoint3" value="">   
                    </td>
                    <td>
                        5. <input type="text" id="waypoint4" value="">   
                    </td>
                </tr>
                <tr> 
                    <td> 
                        6.<input type="text" id="waypoint5" value="">              
                    </td>
                    <td> 
                       7.<input type="text" id="waypoint6" value="">   
                    </td>
                    <td>
                        8.<input type="text" id="waypoint7" value="">   
                    </td> 
                    <td>
                        9.<input type="text" id="waypoint8" value="">   
                    </td>
                    <td>
                         10.<input type="text" id="waypoint9" value="">   
                    </td>
                </tr>
                <tr>
                    <td>Distance:</td>
                    <td><div id="distance"> </div> </td>
                    <td colspan="3"></td>
                </tr>
                 <tr>
                    <td>Duration:</td>
                    <td><div id="duration"> </div> </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid rgb(179, 179, 179);" colspan="5" align="top" valign="top">
                        <div id="map" style="width: 965px; height: 515px; "></div>
                    </td>  
                </tr>
            </table>
       </div>
    </div>
    
  <?php echo $content_bottom; ?>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src='http://maps.googleapis.com/maps/api/js?libraries=weather&amp;sensor=false' type='text/javascript'></script>
<script type="text/javascript" src="catalog/view/javascript/gmap/gMapRootCalculation.js"></script>
<?php echo $footer; ?>