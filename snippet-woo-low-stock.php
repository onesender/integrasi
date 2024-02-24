add_action('init', function() {
    add_filter( 'woocommerce_email_recipient_low_stock', function( $email, $product, $ctx ) {

		$sender_id = 1; // Ganti dengan ID atau nomor urutan sender
		$phone_number = '6289508618321'; // Tujuan
		$message = "Produk Habis stoknya. 

ID: #{$product?->get_id()} 
Nama: {$product?->get_name()} 
Link: {$product?->get_permalink()}

";

		/* Jangan diubah */
		global $wpdb;
		$context = 'low-stock/' . $product?->get_id() . '/' . substr(wp_date('U'), 0, -1);
		$table = $wpdb->prefix . 'ocl_delivery';
		$data = array(
			'web_id' => 1,
			'sender_id' => $sender_id,
			'template_id' => 0,
			'recipient' => $phone_number,
			'message_type' => 'text',
			'message_tag' => '',
			'context' => (string) $context,
			'message_body' => $message,
			'media_file' => '',
			'media_id' => 0,
			'delivery_time' => wp_date('U'),
			'priority' => 50,
			'attempt' => 0,
			'delivery_status' => 'pending',
			'delivery_response' => '',
			'created_at' => current_time( 'mysql' ),
			'updated_at' => current_time( 'mysql' ),
		);

		// Insert the data into the table
		$wpdb->insert( $table, $data );

	});
});
