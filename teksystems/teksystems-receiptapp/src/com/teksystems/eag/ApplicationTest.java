package com.teksystems.eag;

import junit.framework.Assert;

import org.junit.Test;

/**
 * This unit test case provides coverage for all methods in Application class 
 * 
 * @author Mikhel Adun
 *
 */
public class ApplicationTest {

	@Test
	public void testRoundTax()
	{
		Item item = new Item();
		item.setPrice(11.25);
		Assert.assertEquals(0.60, Application.roundTax(item.getPrice() * Application.IMPORT_DUTY_TAX_RATE));
		Assert.assertEquals(1.15, Application.roundTax(item.getPrice() * Application.BASIC_SALES_TAX_RATE));
	}

	@Test
	public void testCalculateTax()
	{
		Item item = new Item(1, 14.99, true, false);
		double tax = Application.calculateTax(item);
		Assert.assertEquals(0.00, tax);
		item = new Item(1, 14.99, false, false);
		tax = Application.calculateTax(item);
		Assert.assertEquals(1.50, tax);
		item = new Item(1, 14.99, false, true);
		tax = Application.calculateTax(item);
		Assert.assertEquals(2.25, tax);
	}

	@Test
	public void testCreateReceipt() {
		Basket basket = new Basket();
		Receipt receipt = Application.createReceipt(basket);
		Assert.assertNotNull(receipt);
		Assert.assertEquals(0.00, receipt.getSalesTax());
		Assert.assertEquals(0.00, receipt.getTotalAmount());
		basket.addItem(new Item(1, 10.00, true, true));
		basket.addItem(new Item(1, 47.50, false, true));
		receipt = Application.createReceipt(basket);
		Assert.assertEquals(7.65, receipt.getSalesTax());
		Assert.assertEquals(65.15, receipt.getTotalAmount());

	}
}
