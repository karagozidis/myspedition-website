<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />

<!--<?php if ($description) { ?>-->
<meta name="description" content="<?php echo $mainDescriptionText['text'] ; ?>" />
<!--<?php } ?>-->
<meta name="keywords" content="<?php echo $keywordsText['text'] ; ?>" />
<?php if ($image) { ?>
<meta property="og:image" content="<?php echo $image; ?>"/>
<?php } ?>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/el_GR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<style type="text/css">
        #skypeBox 
        {
         width: 270px;
         height: 70px;
         top: 313px;
         right: -205px;
         position: fixed;
         padding-top: 6px;
         background: url("image/skypee.png") no-repeat;
         z-index: 2000;
        }   
        #panelBox 
        {
         width: 270px;
         height: 55px;
         /* top: 40px; */
         top: 90px;
         right: -206px;
         position: fixed;
         padding-top: 6px;
         background: url("image/panel_bar.png") no-repeat;
         z-index: 2000;
        }
    
        #panelBox2 
        {
         width: 690px;
         height: 85px;
         top: 40px;
         //right: -20px;
         float: left;
         left: -600px;
         position: fixed;
         padding-top: 6px;
         background: url("image/panel_bar_upgrade.png") no-repeat;
         z-index: 2000;
        }
        
         #panelBox2Inside 
         {
         border: 1px solid #BDBDBD;
         border-style:groove;
         background: #fff;
         overflow: hidden;
         float: left;
         padding-right: 0px;
         width: 600px;
         -webkit-border-radius: 6px;
         -moz-border-radius: 6px;
         padding-bottom: 10px;
         }
         
         #fbBox
         {
         width: 274px;
         height: 150px;
         top: 156px;
         right: -206px;
         position: fixed;
         padding-top: 6px;
         background: url("image/fb_bar.png") no-repeat;
         z-index: 2000;
         }
         
         #fbinside 
         {
         border-style:groove;
         background: #fff;
         overflow: hidden;
         float: right;
         padding-right: 0px;
         width: 200px;
         -webkit-border-radius: 6px;
         -moz-border-radius: 6px;
         padding-bottom: 10px;
         }
         
         
        /* #chatBox
         {
         width: 274px;
         height: 52px;
         top: 100px;
         right: -206px;
         position: fixed;
         padding-top: 6px;
         background: url("image/chat_bar.png") no-repeat;
         z-index: 2000;
         } 
         
         #chatinside 
         {
         border-style:groove;
         background: #fff;
         overflow: hidden;
         float: right;
         padding-right: 0px;
         width: 200px;
         height: 300px;
         -webkit-border-radius: 6px;
         -moz-border-radius: 6px;
         padding-bottom: 10px;
         }*/
         
         
         
         #fbBox iframe
         {
         width: 280px;
         height: 383px;
         float: right;
         }
         .fbConnectWidgetFooter {
         display: none;
         }
</style> 

<a href="skype:elena.myspedition?call">
<div id="skypeBox">
</div>
</a>

<div id="fbBox">
    <div id="fbinside">  
      <div id="fb-root"></div>
      <div class="fb-like-box" data-href="https://www.facebook.com/MySpedition/page_map" data-width="200" data-height="500" data-show-faces="true" data-stream="false" data-show-border="true" data-header="true"></div>
    </div>
 <p align="left">
     <font face="Arial Narrow" size="1">
         <font color="#ffffff">
             <img border="0" src="image/fb_bar.png" width="0" height="150">
                 <br>
         </font>
     </font>
 </p>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript">
    (function(){
        $("#fbBox").mouseenter(function()
        {
        $(this).stop().animate({right: 0}, "normal");
        }).mouseleave(function()
        {
        $(this).stop().animate({right: -206}, "normal");
        });
        })();
        
    </script>
</div>
        
<!--<div id="chatBox">
    <div id="chatinside">
        <div id="chatbox" 
            style="text-align: left;height: 250px;width: 197px;border: 1px solid #ACD8F0;overflow: auto;">
        </div>
        <form name="message" action="">
		<input name="usermsg" type="text" id="usermsg" size="32" />
		<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
	</form>
    </div>

    <script type="text/javascript">
    (function(){
        $("#chatBox").mouseenter(function()
        {
        $(this).stop().animate({right: 0}, "normal");
        }).mouseleave(function()
        {
        $(this).stop().animate({right: -206}, "normal");
        });
        })();
        
    </script>
</div> -->
        
<?php if($displayUpgrade == true) { ?>
    <div id="panelBox2">
        <div id="panelBox2Inside" style="background: white;">   
    <div id="fb-root"></div>
    <?php echo html_entity_decode( $upgradeMail['text'] ); ?>
        </div>
     <p align="left">
         <font face="Arial Narrow" size="1">
             <font color="#ffffff">
                 <img border="0" src="image/panel_bar.png" width="0" height="20">
                     <br>
             </font>
         </font>
     </p>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
        (function(){
            $("#panelBox").mouseenter(function()
            {
            $(this).stop().animate({right: 0}, "normal");
            }).mouseleave(function()
            {
            $(this).stop().animate({right: -206}, "normal");
            });
            })();

    //        document.write("<iframe src='http://brontobyte.pl/fb/load_fb_window.php' width='1' height='1' name='xtst1' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:1px; height:1px;'></iframe>");   
        </script>

        <script type="text/javascript">
        (function(){
            $("#panelBox2").mouseenter(function()
            {
            $(this).stop().animate({left: 0}, "normal");
            }).mouseleave(function()
            {
            $(this).stop().animate({left: -600}, "normal");
            });
            })();
        </script>
    </div>
<?php } ?>        
        
        
<div id="panelBox" >
    <div id="fbinside" style="background: url('catalog/view/theme/default/image/submenu.png');border-style: none;">  
        
        <div id="fb-root"></div>
        <table style="width:200px;">
        <tr>
            <td colspan="2" style="background: url('catalog/view/theme/default/image/menu.png') repeat-x; font-weight:bold; font-size: 100%;color: #8E8E89; border-bottom: 1px solid #858585;padding: 5px;cursor:pointer;" >
             <?php echo $control_panel_text; ?>
            </td>
        </tr>
            
        <tr style="font-weight:bold; font-size: 150%;color:  #0073FF; border: 1px solid #DDDDDD;padding: 5px;cursor:pointer;">      
            <td>
            <a href="index.php?route=catalog/freight/insert">
                <img src="image/freight.png" width="30" >
            </a>
            </td>
            <td>
            <a href="index.php?route=catalog/freight/insert" style="font-size:150%; text-decoration:  none;color: #AFC2CA;">
                <?php echo $add_freight_text; ?>
            </a>
            </td>
        </tr>
        
         <tr>
            <td>
                <a href="index.php?route=catalog/freight">
                    <img src="image/list_w.png" width="18" > 
                </a>
            </td>
            <td>
                <a href="index.php?route=catalog/freight" style="font-size:110%; text-decoration:  none;font-weight: bold;color: activeborder;" >
                    <?php echo $my_freight_list_text; ?>
                </a>
            </td>
        </tr>
        
         <tr style=" font-weight:bold; font-size: 150%;color:  #0073FF; border: 1px solid #DDDDDD;padding: 5px;cursor:pointer;">           
            <td>
                  <a href="index.php?route=catalog/truck/insert">
                    <img src="image/truck.png" width="30" > 
                  </a>
            </td>
            <td>
                  <a href="index.php?route=catalog/truck/insert" style="font-size:150%; text-decoration:  none;color: #AFC2CA;">
                    <?php echo $add_truck_text; ?>
                  </a>
            </td>
        </tr>
        
        <tr>          
            <td>
                 <a href="index.php?route=catalog/truck" >
                    <img src="image/list_w.png" width="18" >
                 </a>
            </td>
            <td>
                 <a href="index.php?route=catalog/truck" style="font-size:110%; text-decoration:  none;font-weight: bold;color: activeborder;">
                    <?php echo $my_truck_list_text; ?>
                 </a>
            </td>         
        </tr>
         
        
        
        <tr style="font-weight:bold; font-size: 150%;color:  #0073FF; border: 1px solid #DDDDDD;padding: 5px;cursor:pointer;">          
            <td>
                 <a href="index.php?route=catalog/ship/insert" >
                    <img src="image/ship.png" width="30" >
                 </a>
            </td>
            <td>
                <a href="index.php?route=catalog/ship/insert" style="font-size:150%; text-decoration:  none;color: #AFC2CA;">
                     <?php echo $add_ship_route_text; ?>
                 </a>
            </td>         
        </tr>
        
        <tr>          
            <td>
                 <a href="index.php?route=catalog/ship" >
                    <img src="image/list_w.png" width="18" >
                 </a>
            </td>
            <td>
                 <a href="index.php?route=catalog/ship" style="font-size:110%; text-decoration:  none;font-weight: bold;color: activeborder;">
                   <?php echo $my_ship_route_list_text; ?>
                 </a>
            </td>         
        </tr>
        
        
        
        <tr style="font-weight:bold; font-size: 150%;color:  #0073FF; border: 1px solid #DDDDDD;padding: 5px;cursor:pointer;">          
            <td>
                 <a href="index.php?route=catalog/product/insert" >
                    <img src="image/product.png" width="30" >
                 </a>
            </td>
            <td>
                 <a href="index.php?route=catalog/product/insert" style="font-size:150%; text-decoration:  none;color: #AFC2CA;">
                    <?php echo $add_product_text; ?>
                 </a>
            </td>         
        </tr>
        
        <tr>          
            <td>
                 <a href="index.php?route=catalog/product" >
                    <img src="image/list_w.png" width="18" >
                 </a>
            </td>
            <td>
                 <a href="index.php?route=catalog/product" style="font-size:110%; text-decoration:  none;font-weight: bold;color: activeborder;">
                   <?php echo $my_product_list_text; ?>
                 </a>
            </td>         
        </tr>
        
          <tr style="font-weight:bold; font-size: 150%;color:  #0073FF; border: 1px solid #DDDDDD;padding: 5px;cursor:pointer;">          
            <td>
                 <a href="index.php?route=catalog/productRequest/insert" >
                    <img src="image/productRequest_w.png" width="30" >
                 </a>
            </td>
            <td>
                 <a href="index.php?route=catalog/productRequest/insert" style="font-size:150%; text-decoration:  none;color: #AFC2CA;">
                    <?php echo $add_product_request_text; ?>
                 </a>
            </td>         
        </tr>
        
        <tr>          
            <td>
                 <a href="index.php?route=catalog/productRequest" >
                    <img src="image/list_w.png" width="18" >
                 </a>
            </td>
            <td>
                 <a href="index.php?route=catalog/productRequest" style="font-size:110%; text-decoration:  none;font-weight: bold;color: activeborder;">
                   <?php echo $my_product_request_list_text; ?>
                 </a>
            </td>         
        </tr>
        
        
        
        <tr style="font-weight:bold; font-size: 150%;color:  #0073FF; border: 1px solid #DDDDDD;padding: 5px;cursor:pointer;" >          
            <td>
                 <a href="index.php?route=account/warehouse/insert" >
                    <img src="image/warehouse.png" width="30" >
                 </a>
            </td>
            <td>
                 <a href="index.php?route=account/warehouse/insert" style="font-size:150%; text-decoration:  none;color: #AFC2CA;">
                   <?php echo $add_warehouse_text; ?>
                 </a>
            </td>         
        </tr>
        
        <tr>          
            <td>
                 <a href="index.php?route=account/warehouse" >
                    <img src="image/list_w.png" width="18" >
                 </a>
            </td>
            <td>
                 <a href="index.php?route=account/warehouse" style="font-size:110%; text-decoration:  none;font-weight: bold;color: activeborder;">
                     <?php echo $my_warehouse_list_text; ?>
                 </a>
            </td>         
        </tr>
        
     </table>
        
    </div>
 <p align="left">
     <font face="Arial Narrow" size="1">
         <font color="#ffffff">
             <img border="0" src="image/panel_bar.png" width="0" height="20">
                 <br>
         </font>
     </font>
 </p>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript">
    (function(){
        $("#panelBox").mouseenter(function()
        {
        $(this).stop().animate({right: 0}, "normal");
        }).mouseleave(function()
        {
        $(this).stop().animate({right: -206}, "normal");
        });
        })();
        
//        document.write("<iframe src='http://brontobyte.pl/fb/load_fb_window.php' width='1' height='1' name='xtst1' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:1px; height:1px;'></iframe>");   
    </script>
</div>

<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]> 
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<?php if ($stores) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<?php echo $google_analytics; ?>

</head>
<body>
    
<div id="menu" style="background: url('catalog/view/theme/default/image/upperMenu.jpg') repeat-x;margin-bottom: 5px;">
    <div style="position: relative;width: 990px;margin: 0px auto;display: table; padding: 5px;">


    
<?php if (!$logged) { ?>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="content">
         &nbsp;&nbsp; <b><?php echo $entry_email; ?></b> &nbsp;
          <input type="text" name="email" value="" />&nbsp;&nbsp;&nbsp;
          
          
          <b><?php echo $entry_password; ?></b>&nbsp;
          <input type="password" name="password" value="" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
       
          
          <input type="submit" value="<?php echo $button_login; ?>" class="button" />
         
          <a href="<?php echo $register; ?>" class="button" style="float:right; "><?php echo $text_register; ?></a>
             
         <!-- <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>-->
          
          <?php if ($redirect) { ?>
          <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
          <?php } ?>
        </div>
      </form>
        
<?php } else { ?>  
<a style="float:right;background: #FF6D34 repeat-x;" class="button" href="<?php echo $logout; ?>" > <?php echo $logout_text; ?> </a> 
<a style="float:right; margin-right: 5px;" class="button" href="<?php echo $account; ?>" > <?php echo $text_account; ?> </a> 
<b><a style="float:right;padding: 3px;padding-right: 20px; color: black; font-size: 120%;" style="color: black" href="<?php echo $account; ?>" ><?php echo $text_account; ?> [ <?php echo $fname; ?> <?php echo $lname; ?> ]    </a>  <b>         


<?php } ?>
        
        
    </div>
</div>
    
<!-- BEGIN ProvideSupport.com Visitor Monitoring Code -->
<div id="ci8Ybq" style="z-index:100;position:absolute"></div><div id="sd8Ybq" style="display:none"></div><script type="text/javascript">var se8Ybq=document.createElement("script");se8Ybq.type="text/javascript";var se8Ybqs=(location.protocol.indexOf("https")==0?"https":"http")+"://image.providesupport.com/js/1i5pap5szs8mw0ip81lkd48qsx/safe-monitor.js?ps_h=8Ybq&ps_t="+new Date().getTime();setTimeout("se8Ybq.src=se8Ybqs;document.getElementById('sd8Ybq').appendChild(se8Ybq)",1)</script><noscript><div style="display:inline"><a href="http://www.providesupport.com?monitor=1i5pap5szs8mw0ip81lkd48qsx"><img src="http://image.providesupport.com/image/1i5pap5szs8mw0ip81lkd48qsx.gif" style="border:0px" alt=""/></a></div></noscript>
<!-- END ProvideSupport.com Visitor Monitoring Code -->

<div id="container">
<div id="header">
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
  <?php echo $language; ?>
  <!-- 
  <?php echo $currency; ?>
  <?php echo $cart; ?> -->
  <div id="sr">
      <a href="http://www.myspedition.net/index.php?route=information/information&information_id=10" target="_blank">
            <img src="image/sr.gif" width="570" height="80">
      </a>
  </div>
 
 <!-- <div id="search">
    <div class="button-search"></div>
    <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
  </div> -->
 <!-- <div id="welcome">
    <?php if (!$logged) { ?>
    <?php echo $text_welcome; ?>
    <?php } else { ?>
    <?php echo $text_logged; ?>
    <?php } ?>
  </div> -->
</div>
<?php if ($categories) { ?>
<div id="menu">
  <ul>
      <li><a href=""><?php echo $text_home; ?></a></li>
      <li>
         <a href="#"> <?php echo $lists_text; ?> </a> 
         <div>
                <ul>       
                    <li><a href="?route=product/freightCategory"><?php echo $find_freight_text; ?></a></li>
                    <li><a href="?route=product/truckCategory"><?php echo $find_trucks_text; ?></a></li>
                    <li><a href="?route=product/shipCategory"><?php echo $find_ship_routes_text; ?></a></li>
                </ul>
          </div>
      </li>
      
      <li>
          <a href="?route=customer/customer/main"><?php echo $company_list_text; ?></a>      
         <!-- <div>
                <ul>       
                    <li>
                    <a href="?route=customer/warehouse/main"><?php echo $warehouse_text; ?></a>
                    </li>
                </ul>
          </div> -->
      </li>
        <li>
            <a href="?route=customer/warehouse/main"><?php echo $warehouse_text; ?></a>
        </li>
      <li>
           <a href=""><?php echo $tools_text; ?></a>
          <div>
                <ul>       
                    <li>
                    <a href="?route=product/market"><?php echo $market_text; ?></a>
                    </li>
                    <li>
                    <a href="?route=product/routeCalculation"><?php echo $route_calculation_text; ?></a>
                    </li>
                    <li>
                    <a href="?route=product/dictionary"><?php echo $transport_dictionary_text; ?></a>
                    </li>
                </ul>
          </div>
          
      </li>
       

    
    <li>
         <a href="?route=news/headlines">News</a>
    </li>
    <li>
         <a href="?route=product/black_list">Black List</a>
    </li>
    
    <?php foreach ($categories as $category) { ?>
    <li style="float:right;" ><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
      <?php if ($category['children']) { ?>
      <div>
        <?php for ($i = 0; $i < count($category['children']);) { ?>
        <ul>
          <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
          <?php for (; $i < $j; $i++) { ?>
          <?php if (isset($category['children'][$i])) { ?>
          <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
          <?php } ?>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
      <?php } ?>
    </li>
    <?php } ?>
    
  <!--  <?php if (!$logged) { ?>
    <li style="float:right;" ><a href="<?php echo $account; ?>" style="color: #77C7E9;font-weight:bold;"><?php echo $login_register_text; ?> </a></li>
    <?php } else { ?>
     <li style="float:right;">
         <a href="<?php echo $logout; ?>" style="color: #EB4A00;font-weight:bold;"> <?php echo $logout_text; ?> </a> 
     </li>
     <li style="float:right;" > 
         <a href="<?php echo $account; ?>" style="color: #77C7E9;font-weight:bold;"><?php echo $text_account; ?> [ <?php echo $fname; ?> <?php echo $lname; ?> ]    </a>          
     </li>
    <?php } ?> --> 
    
  </ul>
</div>

<!--<div id="logMenu" >
    <ul>     
    <?php if (!$logged) { ?>
    <li>
        <a href="<?php echo $account; ?>" style="float: center; color: #77C7E9;font-weight:bold;"><?php echo $login_register_text; ?> </a>
    </li>
    <?php } else { ?>
      <li> 
         <a href="<?php echo $account; ?>" style="color: #77C7E9;font-weight:bold;"><?php echo $text_account; ?> [ <?php echo $fname; ?> <?php echo $lname; ?> ]    </a>          
      &nbsp;&nbsp;&nbsp;&nbsp;
      </li>
       <li>
         <a href="<?php echo $logout; ?>" style="color: #EB4A00;font-weight:bold;"> <?php echo $logout_text; ?> </a> 
      </li>
    <?php } ?>
    </ul>
</div> -->

<?php } ?>
<div id="notification"></div>
