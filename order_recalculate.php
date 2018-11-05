<?php

function recalculate_order( WC_Order $order ) {
	// получаем id usera, если требуется
	$user_id = $order->get_user_id();
	// перебираем товары
	foreach ( $order->get_items() as $item_id => $item ) {


		$product = $item->get_product();
		// получаем id товара
		$product_id = $product->get_id();

		// новая цена на товар
		$new_product_price = 5555;
		// получаем количество ед. товара
		$product_quantity  = (int) $item->get_quantity();

		// считаем inline цену
		$new_line_item_price = $new_product_price * $product_quantity;

		// устанавливаем новую цену
		$item->set_subtotal( $new_line_item_price );
		$item->set_total( $new_line_item_price );

		// считаем налоги
		$item->calculate_taxes();
		// сохраняем
		$item->save(); // Save line item data


	}
	// cчитаем тотал
	$order->calculate_totals();
	// сохраняем ордер
	$order->save();

}
