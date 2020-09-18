<?php
      //===========================================//
     // Advanced Shipping                         //
    // Author: Joel Reeds                        //
   // Company: OpenCart Addons                  //
  // Website: http://opencartaddons.com        //
 // Contact: webmaster@opencartaddons.com     //
//===========================================//

// Heading
$_['heading_title']    		= 'RNM Shipping';
$_['text_name']    			= 'RNM Shipping';
$_['text_shipping']    		= 'Shipping';

//Text
$_['text_min']     			= 'Min';
$_['text_max']     	 		= 'Max';
$_['text_add']     	 		= 'Add';
$_['text_select_all']     	= 'Select All';
$_['text_unselect_all']     = 'Unselect All';
$_['text_confirm_delete']   = 'Are you sure you want to delete this rate?';
$_['text_default'] 	 		= 'Default';
$_['text_guest_checkout']   = 'Guest Checkout';
$_['text_all_zones']     	= 'All Other Zones';
$_['text_all_categories']   = 'All Categories';

$_['text_contact']      	= '<span class="help">Copyright &copy;2013 RNM Addons - v%s</span>';

$_['text_general_settings']	   	= 'General Settings';
$_['text_general_information'] 	= 'General Information';
$_['text_rate']				   	= 'Rate >';
$_['text_help']				   	= 'Help Section';
$_['text_troubleshoot']			= 'Troubleshoot';
$_['text_rates']			   	= 'Shipping Rate';

$_['text_general']			= 'General';
$_['text_criteria']			= 'Criteria';
$_['text_parameters']		= 'Parameters';
$_['text_calculations']		= 'Calculations';
$_['text_additional']		= 'Additional';

//Options
$_['sort_quotes_0']			= 'Sort Order';
$_['sort_quotes_1']			= 'Cost';
$_['rate_types_0']			= 'Quantity';
$_['rate_types_1']			= 'Total';
$_['rate_types_2']			= 'Weight';
$_['rate_types_3']			= 'Volume';
$_['rate_types_4']			= 'Dimensional Weight';
$_['multirates_0']			= 'Single';
$_['multirates_1']			= 'Sum';
$_['multirates_2']			= 'Average';
$_['multirates_3']			= 'Lowest';
$_['multirates_4']			= 'Highest';
$_['cost_settings_0']		= 'All Categories';
$_['cost_settings_1']		= 'Only Selected Categories';
$_['category_settings_0']	= 'Only Selected Categories';
$_['category_settings_1']	= 'Any Selected Category';
$_['category_settings_2']	= 'None Of The Selected Categories';
$_['final_costs_0']			= 'Single';
$_['final_costs_1']			= 'Cumulative';
$_['postal_code_types_0']	= 'United Kingdom';
$_['postal_code_types_1']	= 'Other';

//Buttons
$_['button_apply']			= 'Apply';
$_['button_add_rate']	 	= 'Add Rate';
$_['button_remove_rate']	= 'Remove Rate';

//General Settings
$_['entry_status']			= '<span class="required">*</span> Status';
$_['entry_title'] 			= 'Title';
$_['entry_tax']        		= 'Tax Class';
$_['entry_sort_order'] 		= 'Sort Order';
$_['entry_sort_quotes'] 	= 'Sort Quotes';
$_['entry_display_weight'] 	= 'Display Weights';

//Rate Settings
$_['entry_rate_description']= 'Rate Description (Max 100 Chars):';
$_['entry_rate_status']  	= '<span class="required">*</span> Status';
$_['entry_name'] 			= 'Name';
$_['entry_multirate']		= 'Multiple-Rate Calculations';
$_['entry_rate_sort_order'] = 'Sort Order';
$_['entry_stores']			= '<span class="required">*</span> Stores';
$_['entry_customer_groups']	= '<span class="required">*</span> Customer Groups';
$_['entry_geo_zones']		= '<span class="required">*</span> Geo Zones';
$_['entry_postal_codes']	= 'Postal Code Ranges';
$_['entry_additional'] 		= 'Additional Factor';
$_['entry_cart_values']		= 'Cart Values';
$_['entry_total']			= 'Total (%s):';
$_['entry_quantity']   		= 'Quantity (%s):';
$_['entry_weight']   		= 'Weight (%s):';
$_['entry_volume']   		= 'Volume (%s&sup3;):';
$_['entry_product_dimensions'] = 'Product Dimensions';
$_['entry_length']   		= 'Length (%s):';
$_['entry_width']   		= 'Width (%s):';
$_['entry_height']   		= 'Height (%s):';
$_['entry_cost_setting']	= '<span class="required">*</span> Shipping Will Be Applied To:';
$_['entry_category_setting']= '<span class="required">*</span> Products In Cart Must Match:';
$_['entry_categories']		= '<span class="required">*</span> Categories';
$_['entry_rate_settings'] 	= 'Rate Settings';
$_['entry_rate_type'] 		= '<span class="required">*</span> Rate Type:';
$_['entry_final_cost']  	= '<span class="required">*</span> Final Cost:';
$_['entry_shipping_factor'] = '<span class="required">*</span> Shipping Factor:<br/><span class="help">(%s&sup3;/%s)</span>';
$_['entry_rates']  		 	= '<span class="required">*</span> Rates';
$_['entry_shipping_cost']	= 'Shipping Cost';
$_['entry_freight_fee']  	= 'Freight Fee';

// Error
$_['text_success']    		= 'Success: You have modified Advanced Shipping!';
$_['error_permission'] 	 	= 'Warning: You do not have permission to modify Advanced Shipping!';
$_['error_rates']       	= 'Warning: Shipping rates are required!';
$_['error_shippingfactor']  = 'Warning: Shipping factor is required when using dimensional shipping!';

//Help Section
$_['help_general_settings']		= '
	<div class="oca-entry">Status</div>
	<div class="oca-input">This determines the overall status of the shipping method. If this is set to disabled, the shipping method will not be displayed during checkout.</div>
	
	<div class="oca-entry">Title</div>
	<div class="oca-input">The shipping header can be customized for the entire extension. This is the title of the shipping method that wil be displayed to the customer during checkout. This field supports multiple languages.</div>
	
	<div class="oca-entry">Sort Order</div>
	<div class="oca-input">Customize the order in which the shipping methods are displayed.</div>
	
	<div class="oca-entry">Sort Quotes</div>
	<div class="oca-input">Select whether to sort quotes by the defined sort orders in each rate, or by cost (lowest to highest).</div>
	
	<div class="oca-entry">Display Weights</div>
	<div class="oca-input">Choose to display weights in the name of the shipping rate if using the rate type "Weight" or "Dimensional Weight".</div>
';
	
$_['help_rate_general']			= '
	<div class="oca-entry">Description</div>
	<div class="oca-input">Give the rate a description for future reference. This will only be displayed in the administrator area. (Max 100 chars)</div>
	
	<div class="oca-entry">Status</div>
	<div class="oca-input">Enable or Disable this rate.</div>
	
	<div class="oca-entry">Name</div>
	<div class="oca-input">Customize the rate name.</div>
	
	<div class="oca-entry">Multiple-Rate Calculations</div>
	<div class="oca-input">Select how the rates will be calculated:<br/>
	<table class="oca-table-help"><tbody>
	<tr><td class="left">Single</td><td class="right">A single shipping quote will be given to the customer.</td></tr>
	<tr><td class="left">Sum</td><td class="right">All rates set to "Sum" will be added together for a final shipping quote.</td></tr>
	<tr><td class="left">Average</td><td class="right">All rates set to "Average" will be averaged for a final shipping quote.</td></tr>
	<tr><td class="left">Lowest</td><td class="right">All rates set to "Lowest" will select the lowest shipping quote.</td></tr>
	<tr><td class="left">Highest</td><td class="right">All rates set to "Highest" will select the highest shipping quote.</td></tr>
	</tbody></table>
	Rates can be grouped using the Sort Order.
	</div>
	
	<div class="oca-entry">Sort Order</div>
	<div class="oca-input">Customize the order in which the rate is displayed. Assign matching sort orders for rates you wish to group together (When using Multiple-Rate Calculations).</div>
	
	<div class="oca-entry">Tax Class</div>
	<div class="oca-input">Select a tax class to charge taxes on the shipping cost.</div>
';
	
$_['help_rate_criteria'] 		= '
	<div class="oca-entry">Stores</div>
	<div class="oca-input">Select which stores are eligible for this shipping rate.</div>
	
	<div class="oca-entry">Customer Groups</div>
	<div class="oca-input">Select which customer groups are eligible for this shipping rate.</div>
	
	<div class="oca-entry">Geo Zones</div>
	<div class="oca-input">Select which geo zones are eligible for this shipping rate.</div>
	
	<div class="oca-entry">Postal Code Ranges</div>
	<div class="oca-input">First, select the type of PostCodes, then define postal code ranges:<br/>
	Example:<br/>
	102:109, 205:207, 901:902, 105:105<br/>
	A1A:A3B, H1F:H1F, L2A:L2S, F2S:F2S<br/>
	<span class="oca-tip">If a customer checks out with a postal code of H1G1A3, this rate would not be available</span>
	<span class="oca-tip">If a customer checks out with a postal code of 90210, this rate would be available</span>
	</div>
';

$_['help_rate_parameters']		= '	
	<div class="oca-entry">Cart Values</div>
	<div class="oca-input">
	<table class="oca-table-help"><tbody>
	<tr><td class="left">Quantiy</td><td class="right">Set the minimum or maximum quantity for the shipping method to be active. If the quantity of the cart falls outside of the min or max, the shipping method will not be available. Add can be a whole number or percentage and will be added to the total quantity value for calculations.</td></tr>
	<tr><td class="left">Total</td><td class="right">Set the minimum or maximum total for the shipping method to be active. If the total of the cart falls outside of the min or max, the shipping method will not be available. Add can be a whole number or percentage and will be added to the total for calculations.</td></tr>
	<tr><td class="left">Weight</td><td class="right">Set the minimum or maximum weight for the shipping method to be active. If the weight of the cart falls outside of the min or max, the shipping method will not be available. Add can be a whole number or percentage and will be added to the total weight value for calculations.</td></tr>
	<tr><td class="left">Volume</td><td class="right">Set the minimum or maximum volume for the shipping method to be active. If the volume of the cart falls outside of the min or max, the shipping method will not be available. Add can be a whole number or percentage and will be added to the total volume value for calculations.</td></tr>
	</tbody></table>
	</div>
	
	<div class="oca-entry">Product Dimensions</div>
	<div class="oca-input">Set the minimum or maximum product dimensions for the shipping method to be active. If any of the product dimensions within the cart falls outside of the min or max, the shipping method will not be available.  Add can be a whole number or percentage and will be added to each product dimension.</div>

	<div class="oca-entry">Categories > Products In Cart Must Match</div>
	<div class="oca-input">Choose how the shipping method will act when using product categories:
	<table class="oca-table-help"><tbody>
	<tr><td class="left">Only Selected Categories</td><td class="right">The shipping method will only be active if all products fall under the selected categories.</td></tr>
	<tr><td class="left">Any Selected Categories</td><td class="right">At least one product must match the selected categories for the shipping method to be active.</td></tr>
	<tr><td class="left">None Of The Selected Categories</td><td class="right">The shipping method will only be active if none of the products fall under the selected categories.</td></tr>
	</tbody></table>
	</div>
	
	<div class="oca-entry">Categories > Shipping Will Be Applied To:</div>
	<div class="oca-input">Choose how the shipping charge will be calculated when using product categories:
	<table class="oca-table-help"><tbody>
	<tr><td class="left">All Categories</td><td class="right">All products will be taken into account when calculating the shipping cost.</td></tr>
	<tr><td class="left">Only Selected Categories</td><td class="right">Only products that fall under the selected categories will be used to calculate the shipping cost.</td></tr>
	</tbody></table>
	</div>
	
	<div class="oca-entry">Categories > Categories</div>
	<div class="oca-input">Select which categories the shipping rate will apply to.  Select "All Categories" if you wish to ignore product categories.</div>
';

$_['help_rate_calculations']	= '
	<div class="oca-entry">Rate Settings > Rate Type</div>
	<div class="oca-input">Choose how to calculate your shipping. You can choose from:
	<table class="oca-table-help"><tbody>
	<tr><td class="left">Quantity</td><td class="right">Calculate shipping based on the quantity of items in the customer&#39;s cart.</td></tr>
	<tr><td class="left">Total</td><td class="right">Calculate shipping based on the total of all the items in the customer&#39;s cart.</td></tr>
	<tr><td class="left">Weight</td><td class="right">Calculate shipping based on the weight of all the items in the customer&#39;s cart.</td></tr>
	<tr><td class="left">Dimensional Weight</td><td class="right">Calculate shipping based on the dimensional weight of all the items in the customer&#39;s cart. Dimensional Weight is the theoretical weight an item would have based on the volume at a minimum density (Shipping Factor). If the Dimensional Weight is less than the actual weight, the actual weight will be used to calculate the shipping.</td></tr>
	<tr><td class="left">Volume</td><td class="right">Calculate shipping based on the volume of all the items in the customer&#39;s cart.</td></tr>
	</tbody></table>
	</div>
	
	<div class="oca-entry">Rate Settings > Final Cost</div>
	<div class="oca-input">Choose how the final cost is calculated:
	<table class="oca-table-help"><tbody>
	<tr><td class="left">Single</td><td class="right">A single bracket will be used to determine the shipping cost.</td></tr>
	<tr><td class="left">Cumulative</td><td class="right">The shipping cost will be based on the bracket, plus all lesser rate brackets.</td></tr>
	</tbody></table>
	</div>
	
	<div class="oca-entry">Rate Settings > Shipping Factor</div>
	<div class="oca-input">The shipping factor is required when using Dimensional Weight shipping. Example shipping factors are below:
	<table class="oca-table-help"><tbody>
	<tr><td class="left">Imperial</td><td class="right">166 in&sup3;/lb = 10.4 lb/ft&sup3; - common for IATA shipments<br/>194 in&sup3;/lb = 8.9 lb/ft&sup3; - common for domestic shipments<br/>216 in&sup3;/lb = 8.0 lb/ft&sup3;<br/>225 in&sup3;/lb = 7.7 lb/ft&sup3;<br/>250 in&sup3;/lb = 6.9 lb/ft&sup3;</td></tr>
	<tr><td class="left">Metric</td><td class="right">5000 cm&sup3;/kg = 200 kg/m&sup3;<br/>6000 cm&sup3;/kg = 166.667 kg/m&sup3;<br/>7000 cm&sup3;/kg = 142.857 kg/m&sup3;</td></tr>
	</tbody></table>
	</div>
	
	<div class="oca-entry">Rates</div>
	<div class="oca-input">Rates are used to determine the shipping cost. There are three different types of formulas that you can use for your rates.
	<table class="oca-table-help"><tbody>
	<tr><td class="left">Formulas</td><td class="right"><ol type="1"><li>Flat Rate (ex. a:b)</li><li>Percentage of Subtotal (ex. a:b%)</li><li>Calculation (ex. a:b/c)</li></ol></td></tr>
	</tbody></table>
	<table class="oca-table-help"><tbody>
	<tr>
		<td class="left">1. Flat Rate</td>
		<td class="right">
			<ol type="a">
				<li>Limit: The limit is the higher limit of each range. If your range is 10-20, the limit would be 20</li>
				<li>Cost: The cost is how much the shipping costs. If your cost is $1.50, the cost would be 1.50</li>
			</ol>
			<span class="oca-tip">The rate for the above flat rate would be 20:1.50</span>
		</td>
	</tr>
	<tr>
		<td class="left">2. Percentage of Total</td>
		<td class="right">
			<ol type="a">
				<li>Limit: The limit is the higher limit of each range. If your range is 10-20, the limit would be 20</li>
				<li>Cost(%): The cost is a percentage of the total. If your cost is 2% and you total is $100.00, your shipping cost would be $2.00</li>
			</ol>
			<span class="oca-tip">The rate for the above percentage of total would be 20:2%</span>
		</td>
	</tr>
	<tr>
		<td class="left">2. Calculations</td>
		<td class="right">This is the most complex type of rate out of the three. The formula used to calculate the shipping cost using the calculation method is cost=(d/c)*b
			<ol type="a">
				<li>Limit: The limit is the higher limit of each range. If your range is 10-20, the limit would be 20</li>
				<li>Cost: The cost is how much the shipping costs. This can be set to either a flat rate or percentage of total. This number will be multiplied by the multiplier (cart value divided by the denominator)</li>
				<li>Denominator: The cart value will be divided by this number to determine the multiplier for the cost</li>
				<li>Cart Value: This value varies depending on the "Rate Type" setting. If the rate type is set to total, this value would be the current total of the cart</li>
			</ol>
			<span class="oca-tip">The rate for the above percentage of total would be 20:2%</span>
			<div style="border: 1px solid #DDD; text-align: center; margin-top: 5px; width: 75%;">
				<p>Example:</p>
				<p>We are looking to calculate a shipping cost of $0.50 for every 1lb of weight in the cart, as long as the weight is less than 10.00lb. The customer currently has a cart weight of 6.00lb.<br/>
				Rate: 10:0.50/1<br/>
				<table><tr><td>Cost = (d/c)*b</td><td>&#187;</td><td>Cost = (6.00/1)*0.50</td><td>&#187;</td><td>Cost = $3.00</td></tr></table>
			</div>
			<p>Below are examples of how to use these rates</p>
			<p style="font-weight: bold;">Quantity</p>
			<p>Criteria:</p>
			<ul>
				<li>Shipping for less than 5 items cost $0.50 per item</li>
				<li>Shipping for 5 - 10 items cost $4.75</li>
				<li>Shipping for items from $25.00 - $50.00 cost $5.50</li>
				<li>Shipping for 10 - 20 items cost $10.00</li>
				<li>Shipping for more than 20 items is free</li>
			</ul>
			<span class="oca-tip">Rates: 5:0.50/1, 10:4.75, 20:10.00, 999999:0.00</span>
			<p style="font-weight: bold;">Total</p>
			<p>Criteria:</p>
			<ul>
				<li>Shipping from $0.00 - $10.00 cost $0.50 per $1.50</li>
				<li>Shipping from $10.00 - $25.00 cost $3.75</li>
				<li>Shipping from $25.00 - $50.00 cost $5.50</li>
				<li>Shipping from $50.00 - $100.00 cost $10.00</li>
				<li>Shipping from $100.00 - $200.00 is 10% of the total</li>
				<li>Shipping from $200.00 & up is free</li>
			</ul>
			<span class="oca-tip">Rates: 10:0.50/1.50, 25:3.75, 50:5.50, 100:10.00, 200:10%, 999999:0.00</span>
			<p style="font-weight: bold;">Weight / Dimensional Weight</p>
			<p>Criteria:</p>
			<ul>
				<li>Shipping under 10kg costs $5.25 per kg</li>
				<li>Shipping from 10kg - 15kg cost $64.25</li>
				<li>Shipping from 15kg - 20kg cost $75.50</li>
				<li>Shipping from 20kg - 30kg cost $100.00</li>
				<li>Shipping from 30kg & up is 10% of the total</li>
			</ul>
			<span class="oca-tip">Rates: 10:5.25/1, 15:64.25, 20:75.50, 30:100.00, 999999:10%</span>
			<p style="font-weight: bold;">Volume</p>
			<p>Criteria:</p>
			<ul>
				<li>Shipping under 100cm&sup3; costs $2.50</li>
				<li>Shipping from 100cm&sup3; - 1500cm&sup3; cost $10.00</li>
				<li>Shipping from 1500cm&sup3; - 20000cm&sup3; cost $25.50</li>
				<li>Shipping from 20000cm&sup3; - 30000cm&sup3; cost $31.75</li>
				<li>Shipping from 30000cm&sup3; & up is $0.001 / cm&sup3;</li>
			</ul>
			<span class="oca-tip">Rates: 100:2.50, 1500:10.00, 20000:25.50, 30000:31.75, 999999:0.001/1</span>
		</td>
	</tr>
	</tbody></table>
	</div>
	
	<div class="oca-entry">Shipping Cost</div>
	<div class="oca-input">You can set a minimum and maximum shipping cost. If the calculated shipping cost is above or below these values, it will automatically be set to the maximum or minimum shipping cost. Define the added cost to the shipping. Can be either flat fee (Ex. 5.00) or percentage of shipping cost (Ex. 5%).</div>
	
	<div class="oca-entry">Freight Fee</div>
	<div class="oca-input">Set a freight fee to be added to the total shipping cost. This fee is blended into the total shipping cost. Can be either flat fee (Ex. 5.00) or percentage of the total shipping cost (Ex. 5%).</div>
';

$_['help_rate_troubleshoot']			= '
	<div class="oca-entry">Support</div>
	<div class="oca-input">You can contact me anytime for support. I can be reached through the following:<br/>
	<p style="font-weight: bold;">
		Email: <a  style="text-decoration: none;" href="mailto:kontakt@rheinneckar-media.de">kontakt@rheinneckar-media.de</a></span><br/>
	</p>
	</div>
	
	<div class="oca-entry">No Shipping Rates Available During Checkout</div>
	<div class="oca-input">If no shipping rates are available during checkout, try adjusting the rate parameters. Often times it is due to the customer\'s cart not meeting the parameters.</div>
	
	<div class="oca-entry">Some Settings Are Not Saving</div>
	<div class="oca-input">If you have created multiple rates and the last rate is missing some of the settings then you are exceeding your PHP max_input_vars setting. See below:<br/>
	<table class="oca-table-help"><tbody>
	<tr><td class="left">Cause</td><td class="right">The default max_input_vars setting is set to 1000 variables. This can be reached very quickly when creating a large amount of modules.</td></tr>
	<tr><td class="left">Solutions</td><td class="right">There is a way to increase your max_input_vars setting if you have access to your main php.ini file. To locate the file, you will need to contact your host.<br/><br/>
	If you have access to your php.ini file, perform these steps:
	<ol><li>Find your php.ini file</li><li>Find the setting max_input_vars and set it to 3000 (or more)</li><li>Find the settings suhosin.post.max_vars and suhosin.request.max_vars and set them to 3000 (or more) <i>(Note: Not all servers have Suhosin installed)</i></li></ol>
	If you do not have access to your php.ini file, there are ways to reduce the number of variables being passed to the server:
	<ul><li>Instead of selecting every category, just use "All Categories"</li><li>Create duplicates of the extension (Please contact me for more information)</li></ul>
	</td></tr>
	</tbody></table>
	</div>
';
?>
