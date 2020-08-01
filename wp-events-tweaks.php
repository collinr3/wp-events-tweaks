<?php
/**
 */
/*
Plugin Name: WP-Events Custom Tweaks
Plugin URI: https://github.com/collinr3/wp-events-tweaks
Description: Tweak to show Bookings Summary Page Booked Tickets as described by @angelo_nwl in response to a user question https://wordpress.org/support/topic/improvements-to-help-with-covid-19-regulation/
Version: 0.0.1
Author: Collinr3
Author URI: https://github.com/collinr3
License: GPLv2 or later
*/
/**
 *This snippet will let users display booked tickets under Events > Bookings > Recent Bookings > click the Gear or Cog Icon
 */
function my_em_bookings_table_cols_template_tickettypes($template, $EM_Bookings_Table){
	$template['book_tickets'] = 'Booked Tickets';
	return $template;
}
add_action('em_bookings_table_cols_template', 'my_em_bookings_table_cols_template_tickettypes',10,2);

function my_em_custom_booking_form_cols_ticket_types($val, $col, $EM_Booking, $EM_Bookings_Table, $csv){

	if( $col == 'book_tickets' ){

		$EM_Tickets_Bookings = $EM_Booking->get_tickets_bookings();
		$attendee_datas = EM_Attendees_Form::get_booking_attendees($EM_Booking);
		$attendee_list = "";
		foreach( $EM_Tickets_Bookings->tickets_bookings as $EM_Ticket_Booking ){

			//Display ticket info
			if( !empty($attendee_datas[$EM_Ticket_Booking->ticket_id]) ){
				$val .= "Ticket name: ".$EM_Ticket_Booking->get_ticket()->ticket_name."<br>";
			}


		}

	}

	return $val;
}
add_filter('em_bookings_table_rows_col','my_em_custom_booking_form_cols_ticket_types', 10, 5);

?>
